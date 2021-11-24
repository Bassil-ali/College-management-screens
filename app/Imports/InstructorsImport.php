<?php

namespace App\Imports;

use App\Instructor;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\{
    WithHeadingRow,
    WithValidation,
    ToModel
};
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Illuminate\Support\Str;
use App\Schedule;

class InstructorsImport implements ToModel, WithHeadingRow
{
    public function __construct()
    {
        HeadingRowFormatter::default('none');
    }

 
    public function model(array $row)
    {
           
            Instructor::create([
                'computer_id' => $row['رقم المدرب'],
                'name' => $row['اسم المدرب'],
               //  'section' => $section,
            ]);
        
    }
}
