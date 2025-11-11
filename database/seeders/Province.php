<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\admin\Provinces;

class Province extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Provinces::truncate();
        $res = json_decode(file_get_contents(public_path(). "/common/province.json"), true);
        $province = $res['province'];
        $district = $res['district'];
        $commune = $res['commune'];
        $total = count($province)+count($district)+count($commune);
        $success=0;
        foreach ($province as $index =>$value){
            $data =[
                'ProvinceCode'=>$value['idProvince'],
                'ProvinceName'=> $value['name'],
                'Level'=>1
            ];
            $check =Provinces::where('ProvinceCode',$value['idProvince'])->first();
            if(!$check){
                Provinces::insert($data);
                $success++;
                dump('Province add database: '. (($success*100)/$total).'%');
            }

        }
        foreach ($district as $index =>$value){
            $data=[
                'ProvinceCode'=>$value['idDistrict'],
                'ProvinceName'=> $value['name'],
                'ProvinceParent'=>$value['idProvince'],
                'Level'=>2
            ];
            $check =Provinces::where('ProvinceCode',$value['idDistrict'])->first();

            if(!$check){
                Provinces::insert($data);
                $success++;
                dump('Province add database: '. (($success*100)/$total).'%');


            }
        }
        foreach ($commune as $index =>$value){
            $data=[
                'ProvinceCode'=>$value['idCommune'],
                'ProvinceName'=> $value['name'],
                'ProvinceParent'=>$value['idDistrict'],
                'Level'=>3
            ];
            $check =Provinces::where('ProvinceCode',$value['idCommune'])->first();
            if(!$check){
                Provinces::insert($data);
                $success++;
                dump('Province add database: '. (($success*100)/$total).'%');

            }
        }

    }
}
