<?php

namespace App\Imports;

use App\Schedule;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\{
    WithHeadingRow,
    WithValidation,
    ToModel
};
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Illuminate\Support\Str;

class SchedulesImport implements ToModel, WithHeadingRow, WithValidation
{
    public function __construct()
    {
        HeadingRowFormatter::default('none');
    }

    public function model(array $row)
    {
        // dd($row);
        if (isset($row['أوقات'])) {
            $row_10 = trim($row['أوقات']);
            $start = '00:00';
            $end = '00:00';
            $time_text = str_replace(' ', '', $row_10);
            $times = explode('-', $time_text);

            if (isset($times[1])) {
                $start = sprintf('%s:%s', substr($times[1], 0, 2),substr($times[1], 2, 2));
            }

            if (isset($times[0])) {
                $end = sprintf('%s:%s', substr($times[0], 0, 2),substr($times[0], 2, 2));
            }

            if (isset($row['أيام'])) {
                foreach (__('schedules.days') as $day_index => $day) {
                    $days = trim($row['أيام']);
                    $contains = Str::contains($days, $day);
                    if ($contains) {
                        $this->createSchedule($row, $day_index, $start, $end);
                    }
                }
            }
        }
    }

    public function rules(): array
    {
        return __('excel.rules');
    }

    private function createSchedule($row, $day_index, $start, $end)
    {
        $fields = [];
        foreach (__('excel.fields') as $key => $value) {
            $fields[$key] = trim($row[$value]);
        }
        $fields['day_index'] = $day_index;
        $fields['start'] = $start;
        $fields['end'] = $end;

        Schedule::create($fields);
    }
}
