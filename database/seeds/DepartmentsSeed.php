<?php

use Illuminate\Database\Seeder;

class DepartmentsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
			['name'=>'Management'],
			['name'=>'Room_911'],
			['name'=>'Systems']
        ];
        DB::table('departments')->insert($data);
    }
}
