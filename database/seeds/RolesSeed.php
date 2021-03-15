<?php

use Illuminate\Database\Seeder;

class RolesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
			['name'=>'admin'],
			['name'=>'admin_room_911'],
			['name'=>'employee']
        ];
        DB::table('roles')->insert($data);
    }
}
