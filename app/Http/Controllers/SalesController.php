<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Models\SalesDetail;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\SalesExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;



class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sales::with('user', 'customer')->get();
        return view('selling.selling-data', compact('sales'));
    }


    public function exportSales(){
        return Excel::download(new SalesExport, 'Sales.xlsx');
    }
    public function staffSales()
    {
        $sales = Sales::with('user', 'customer')->where('user_id', Auth::user()->id)->get();
        return view('selling.selling-data', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = Product::whereNotIn('stock', [0])->get();
        return view('selling.selling', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $customer = Customer::create([
            'name' => $data['customer_name'],
            'address' => $data['customer_address'],
            'phone_number' => $data['customer_phone_number']
        ]);

        $total_price = 0;
        $products = Product::whereIn('id', $data['productCheck'])->get();
        foreach($products as $key => $product){

            $quantity = $data['quantity'][$key];
            $total_stock = $product->stock - $quantity;

            Product::where('id', $product->id)->update([
                'stock' => $total_stock
            ]);

            if($quantity > 0){
                $total_price += $product->price * $quantity;
            }
        }

        $sales = Sales::create([
            'user_id' => Auth::user()->id,
            'customer_id' => $customer->id,
            'total_price' => $total_price
        ]);


        foreach($products as $key => $product){

            $quantity = $data['quantity'][$key];
            $subtotal = $quantity * $product->price;
            if($data['productCheck'][$key] && $quantity != 0){
                SalesDetail::create([
                    'product_id' => $product->id,
                    'sales_id' => $sales->id,
                    'subtotal' => $subtotal,
                    'amount' => $quantity
                ]);
            }

        }

        return redirect("/selling/detail/{$sales->id}");
    }

    /**
     * Display the specified resource.
     */
    public function show(Sales $sales, $id)
    {
        $sellingData = Sales::with('salesDetail', 'salesDetail.product', 'user', 'customer')->where('id', $id)->first();
        return view('selling.payment-details', compact('sellingData'));
    }

    /**
     * Show the form for editing the specified resource.
     */

     public function download($id){
        $sellingData = Sales::with('salesDetail', 'salesDetail.product', 'user', 'customer')->find($id);
        if (!$sellingData) {
            return response()->json(['message' => 'Data penjualan tidak ditemukan'], 404);
        }


        $pdf = PDF::loadView('selling.invoice-download', compact('sellingData'));
        return $pdf->download('invoice_' . $sellingData->id . '.pdf');
    }

    public function edit(Sales $sales)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sales $sales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sales $sales, $id)
    {
        Sales::where('id', $id)->delete();
        return back()->with('success', 'Success');
    }
}
