<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ExcelImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'اسماء المدرسين' => new InstructorsImport(),
            'الجدول الشامل' => new SchedulesImport(),
        ];
    }
}
