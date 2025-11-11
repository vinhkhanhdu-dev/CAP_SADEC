<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Modules;
use App\Models\Actions;


class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        
        $list_modules=array_map(function ($role) {                   
            return json_decode($role['ListModule'],true);
        }, $this->role->toArray());
        $privatekey = @file_get_contents('../nodejs/pem/private_key_'.$this->id.'.pem');
        if($privatekey){
             $privatekey = str_replace(["\n", "\r", "-----BEGIN PRIVATE KEY-----", "-----END PRIVATE KEY-----"], '', $privatekey);
        }
       
        $publickey = @file_get_contents('../nodejs/pem/public_key_'.$this->id.'.pem');       
        if($publickey){
             $publickey = str_replace(["\n", "\r", "-----BEGIN PUBLIC KEY-----", "-----END PUBLIC KEY-----"], '', $publickey);
        }

        $modules = Modules::whereIn('code', $list_modules[0])->get()->toArray();      
        // $action = Actions::whereIn('module_code', $list_modules[0])->get()->toArray();   
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'privatekey' => $privatekey,
            'publickey' => $publickey,
            'signature' => $this->signature,
            'hinhanhchuky' => $this->hinhanhchuky,
            // 'avatar' => $this->avatar,
            //    'roles' => array_map(function ($role) {
            //        return $role['name'];
            //    }, $this->roles->toArray()),
            //    'permissions' => array_map(function ($permission) {
            //        return $permission['name'];
            //    }, $this->getAllPermissions()->toArray()),
              'roles' => ['admin'],
              'ListModule'=>array_map(function ($role) {                
                            return json_decode($role['ListModule'],true);
                        }, $this->role->toArray()),
              'ListAction'=>array_map(function ($role) {                
                            return json_decode($role['ListAction'],true);
                        }, $this->role->toArray()),
              'ModuleDefault'=>$this->moduleDefault,
              'ArrayModule'=>$modules        
        ];
    }
}
