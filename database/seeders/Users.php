<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password_default=123456;
        $listTypeTask=[
            [
                "name"=>'admin',
                "chucvu"=>'dev',
                "donvicongtac"=>'dev',
                "phone_number"=>'0868350978',
                "note"=>'123',
                "email"=>'admin@gmail.com',
                "password"=>Hash::make($password_default),
                "id_module_default"=>'4',
                "role_code"=>'R0001',             
            ] ,
            [
                "name"=>'user',
                "chucvu"=>'dev',
                "donvicongtac"=>'dev',
                "phone_number"=>'0868350978',
                "note"=>'123',
                "email"=>'user@gmail.com',
                "password"=>Hash::make($password_default),
                "id_module_default"=>'7',
                "role_code"=>'R0002',              
            ] ,
        ];
        foreach ($listTypeTask as $index =>$value){
            $data =$value;
            User::insert($data);
        }
        dump('Add data user success');
    }
}
