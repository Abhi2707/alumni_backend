<?php

namespace App\Imports;

use App\Models\Core\School\Ref_school;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportSchool implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        return new Ref_school([
            'district' => @$row[1],
            'school_name' => @$row[2],
            'address' => @$row[3],
        ]);
        /*return new Ref_school([
            'id' => @$row[0],
            'district' => @$row[1],
            'school_name' => @$row[2],
            'address' => @$row[3],
        ]);*/
    }
}
