<?php

namespace App\Imports;

use App\Sale;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SalesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Sale([
            'name'          => $row['name'],
            'address'        => $row['address'],
            'email'         => $row['email'],
            'phone'       => $row['phone']
        ]);
    }
}
