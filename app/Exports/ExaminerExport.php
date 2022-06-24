<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class ExaminerExport implements FromCollection
{
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function collection()
    {
        return collect($this->data);
    }
    public function headings() :array
    {
        return [
            'ID',
            'Name',
            'Email',
        ];
    }
}
