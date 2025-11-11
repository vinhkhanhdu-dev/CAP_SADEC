<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Roles;
use DB;

class Role extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listTypeTask=[
            [
                "code"=>'R0001',
                "name"=>'Admin',
                "id_parent"=>null,
                "ListAction"=>'[]',
                "ListModule"=>'["MD0001","MD0002","MD0003","MD0004","MD0005","MD0006","MD0007","MD0008","MD0009","MD0010","MD0011","MD0012","MD0013","MD0014"]',
            ],
            [
                "code"=>'R0002',
                "name"=>'User',
                "id_parent"=>null,
                "ListAction"=>'[]',
                "ListModule"=>'[]',
            ],
        ];
        // Disable foreign key checks to prevent issues during truncation
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // Truncate the table
        DB::table('roles')->truncate();
        // Enable foreign key checks again
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        foreach ($listTypeTask as $index =>$value){
            $data =$value;
            Roles::insert($data);
        }
        dump('Add list module success');
    }
}
