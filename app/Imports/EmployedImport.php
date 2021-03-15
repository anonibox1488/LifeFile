<?php

namespace App\Imports;

use App\User;
use Exception;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployedImport implements ToModel, WithHeadingRow
{

    public $department_id;

    public function __construct($department_id)
    {
        $this->department_id = $department_id;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $code = substr($row['name'], 0, 1) . substr($row['last_name'], 0, 1) . time();

        return new User([
            'name' => $row['name'],
            'middle_name' => $row['middle_name'],
            'last_name' => $row['last_name'],
            'email' => $row['email'],
            'code' => $code,
            'department_id' => $this->department_id,
            'access_room_911' => ($row['access_room_911'] == 'yes') ? true : false,
        ]);
    }
}
