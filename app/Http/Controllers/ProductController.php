<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
        return view('product.index', compact('product'));
    }


    public function search(Request $request)
    {
        $query = $request->input('query');
        $product = Product::where('name', 'LIKE', "%$query%")->get();

        return view('product.index', compact('product'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required',
                'price' => 'required',
                'stock' => 'required',
                'image' => 'required'
            ]);


            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('/Image'), $filename);

            $product = Product::create([
                'name' => $data['name'],
                'price' => $data['price'],
                'stock' => $data['stock'],
                'image' => $filename
            ]);
            return redirect('/product')->with('success', 'Success');

        } catch (\Throwable $th) {
            return back()->withInput()->with('fail', "Fail");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product, $id)
    {
        $product = Product::where('id', $id)->first();
        return view('product.update', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product, $id)
    {
        try {
            $data = $request->validate([
                'name' => 'required',
                'price' => 'required',
                'stock' => 'required'
            ]);

            Product::where('id', $id)->update($data);

            return redirect('/product')->with('success', 'Success');
        } catch (\Throwable $th) {

            return back()->withInput()->with('fail', 'Failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, $id)
    {
        Product::where('id', $id)->delete();
        return back()->with('success', 'Success');
    }
}
