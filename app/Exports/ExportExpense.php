<?php

namespace App\Exports;

use App\Expense;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportExpense implements FromCollection , WithHeadings 
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Expense::select('date',
        'title',
        'description',
        'amount')->get();
    }

    public function headings(): array
    {
        return [
            'date',
            'title',
            'description',
            'amount'
        ];
    }
}
