<?php

namespace App\Exports;

use App\Models\Sales;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $sales = Sales::with('user', 'customer', 'salesDetail.product')->get();
        $salesData = [];

        foreach ($sales as $sale) {
            foreach ($sale->salesDetail as $data) {
                $salesData[] = [
                    'Sale ID' => $sale->id,
                    'Total Price' => $sale->total_price,
                    'User Name' => $sale->user->name,
                    'Customer Name' => $sale->customer->name,
                    'Product Name' => $data->product->name,
                    'Quantity' => $data->amount,
                    'Subtotal' => $data->subtotal,
                ];
            }
        }

        return collect($salesData);
    }

    public function headings(): array
    {
        return [
            'Sale ID',
            'Total Price',
            'User Name',
            'Customer Name',
            'Product Name',
            'Quantity',
            'Subtotal',
        ];
    }
}
