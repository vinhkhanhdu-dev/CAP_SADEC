<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use App\Traits\CommonHelper;
use App\Models\Modules;
use Illuminate\Support\Facades\Schema;

class GenTableController extends Controller
{
    use CommonHelper;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function genCode(){
        $lastCode = Modules::orderBy('id', 'desc')->first(); // lấy mã cuối cùng trong database

        if (!$lastCode) {
            $number = 1;
        } else {
            $number = intval(substr($lastCode->code, -3)) + 1; // lấy số cuối cùng của mã và tăng giá trị lên 1
        }
    
        $newCode = 'MD' . str_pad($number, 4, '0', STR_PAD_LEFT); // tạo mã mới dựa trên số đó và định dạng "ABCXXX"
        return $newCode;
    }
    //Function generater
    public function gennerateMigrateFn($tableName, $fields){   
     // Tạo nội dung migration
        $migrationName = 'create_' . $tableName . '_table';
        $migrationFiles = glob(database_path('migrations/*.php')); // Lấy danh sách tất cả file migration
        $existingMigration = null;
        foreach ($migrationFiles as $file) {           
            if (str_contains($file, $migrationName)) {
                $existingMigration = $file;
                break;
            }
        }
        $migrationContent = self::genMargationContent($tableName, $fields);
        if ($existingMigration) {
            // Nếu migration đã tồn tại, cập nhật nội dung
            file_put_contents($existingMigration, $migrationContent);
            // Lấy đường dẫn tương đối từ thư mục dự án
            $relativePath = str_replace(database_path() . DIRECTORY_SEPARATOR, '/database/', $existingMigration);    
            Artisan::call('migrate:refresh', ['--path' => $relativePath]);
        } else {
            // Nếu chưa tồn tại, tạo migration mới
            $migrationFileName = date('Y_m_d_His') . '_' . $migrationName . '.php';
            $migrationPath = database_path("migrations/$migrationFileName");
            file_put_contents($migrationPath, $migrationContent);
            Artisan::call('migrate');
        }
        return true;
    }

    public function generateModelsFn($modelName, $tableName, $fields){         
        // Tạo nội dung model
        $modelPath = app_path("Models/admin/{$modelName}.php");
        $modelContent = $this->generateModelContent($modelName, $tableName, $fields);
        // Ghi file
        File::ensureDirectoryExists(app_path("Models/admin"));
        File::put($modelPath, $modelContent);
        return true;
    }

    public function generateControllerFn($controllerName, $model_name, $pathController, $feildNameGenCode, $textGenCode){       
        $controllerPath = app_path("Http/Controllers/admin/{$controllerName}.php");
        if(@$pathController){
            $controllerPath = app_path("Http/Controllers/admin/{$controllerName}.php");
        }        
        // 1. Tạo Controller bằng Artisan
        Artisan::call("make:controller admin/{$controllerName}");              
        // 2. Kiểm tra xem file đã được tạo chưa    
        if (File::exists($controllerPath)) {
            // Nội dung muốn chèn vào controller
            $content = self::genControllerContent($controllerName, $model_name, $pathController, $feildNameGenCode, $textGenCode);          
            
            // 3. Ghi nội dung vào file
            File::put($controllerPath, $content);
        }
        return true;
    }

    public function pushRouterFn($model_name, $controllerName, $componentName){        
        $newRoute = self::genListRouter($model_name, $controllerName, $componentName);
        // Đường dẫn file api.php
        $routePath = base_path('routes/api.php');    
        // Đọc nội dung file
        $fileContent = File::get($routePath);    
        // Xác định vị trí nhóm Route::prefix('admin')->namespace('admin')->group(function () {
        $pattern = "/Route::prefix\('admin'\)->namespace\('admin'\)->group\(function\s*\(\)\s*{/";
        preg_match($pattern, $fileContent, $matches, PREG_OFFSET_CAPTURE);
    
        if (!empty($matches)) {
            // Kiểm tra xem route đã tồn tại chưa
            if (str_contains($fileContent, $newRoute)) {
                return; // Route đã có, không cần thêm
            }    
            // Vị trí chèn route vào bên trong nhóm admin
            $insertPosition = $matches[0][1] + strlen($matches[0][0]);    
            // Chèn hoặc cập nhật route mới
            $fileContent = substr_replace($fileContent, "\n    $newRoute", $insertPosition, 0);    
            // Ghi lại file
            File::put($routePath, $fileContent);
        } 
        return true;
    }
    public function generateVueTableFn($componentName,$titleTable, $pathApi, $fieldsTable, $componentPath){      
        $vuePath = resource_path("js/backend/components/{$componentPath}/index.vue");
        // Nội dung mặc định của file Vue
        $content =self::generateVueTemplateTable($componentName,$titleTable,$pathApi,$fieldsTable);
        // Kiểm tra thư mục components, nếu chưa có thì tạo
        if (!File::isDirectory(resource_path("js/backend/components/{$componentName}"))) {
            File::makeDirectory(resource_path("js/backend/components/{$componentName}"), 0777, true);
        }
        // Ghi nội dung vào file .vue
        File::put($vuePath, $content);
        return true;
    }
    public function generateVueFormFn($componentName, $titleTable, $pathApi, $fieldsTable, $titleForm, $feildNameGenCode, $componentPath){
        //VUE FORM
        $vueFormPath = resource_path("js/backend/components/{$componentPath}/form.vue");

        // Nội dung mặc định của file Vue
        $content =self::generateVueTemplateForm($componentName, $titleTable, $pathApi, $fieldsTable, $titleForm, $feildNameGenCode);

        // Kiểm tra thư mục components, nếu chưa có thì tạo
        if (!File::isDirectory(resource_path("js/backend/components/{$componentName}"))) {
            File::makeDirectory(resource_path("js/backend/components/{$componentName}"), 0777, true);
        }

        // Ghi nội dung vào file .vue
        File::put($vueFormPath, $content);
        return true;
    }
    public function pushRouterVueFn($componentName, $titleTable, $pathApi, $fieldsTable, $titleForm, $feildNameGenCode, $componentPath){     
        $routerPath = resource_path('js/backend/router/routes.js');
        if (!file_exists($routerPath)) {
            return response()->json(['error' => 'Không tìm thấy file routes.js'], 400);
        }    
        $routerContent = file_get_contents($routerPath);    
        // Xác định vị trí của `children` trong `/dashboard`
        $dashboardPattern = '/path: \'\/dashboard\',[\s\S]*?children: \[/';
        preg_match($dashboardPattern, $routerContent, $matches, PREG_OFFSET_CAPTURE);    
        if (!$matches) {
            return response()->json(['error' => 'Không tìm thấy /dashboard trong file router'], 400);
        }    
        // Tạo route mới
        $vueRoute = self::generateVueRouter($componentPath, $componentName);    
        // Kiểm tra xem route đã tồn tại chưa
        if (str_contains($routerContent, "path: '$componentPath'")) {
            // Cập nhật route đã có
            $routePattern = "/\s*{\s*path:\s*'$componentPath',[\s\S]*?},?/";
            $routerContent = preg_replace($routePattern, $vueRoute, $routerContent);
        } else {
            // Thêm route vào `children`
            $insertPosition = $matches[0][1] + strlen($matches[0][0]);
            $routerContent = substr_replace($routerContent, "\n    $vueRoute,", $insertPosition, 0);
        }    
        // Ghi lại file router
        file_put_contents($routerPath, $routerContent);
        return true;
    }

    public function generateCode(Request $request){
        $request->validate([
            'component_name' => 'required|string',
            'component_path' => 'required|string',
            'model_name' => 'required|string',
            'title_table' => 'required|string',
            'title_form' => 'required|string',
            'fields' => 'required|string',
            'feild_name_gencode' => 'required|string',
            'disabled' => 'required|string',
            'table_name' => 'required|string',
            'fields' => 'required|string',
            'fieldsTable' => 'required|string',
        ]);
        $componentName = $request->input('component_name');
        $componentPath = $request->input('component_path');
        $feildNameGenCode = $request->input('feild_name_gencode');
        $pathApi = $request->input('model_name');
        $titleTable = $request->input('title_table');
        $model_name = $request->input('model_name');
        $titleForm = $request->input('title_form');
        $tableName = $request->input('table_name');    
        $controllerName = $request->input('controller_name');
        $pathController = $request->input('pathController','admin');        
        $textGenCode = ($request->input('text_gencode'));   
        $fields = $request->input('fields');
        $routeName = $request->input('route_name'); // Ví dụ: 'custom-route'
        if($fields){
            $fields = json_decode($fields, true);
        }     
        $fieldsTable = $request->input('fieldsTable');
        if($fieldsTable){
            $fieldsTable = json_decode($fieldsTable, true);
        }         
        self::gennerateMigrateFn($tableName, $fields);
        self::generateModelsFn($model_name, $tableName, $fields);
        self::generateControllerFn($controllerName, $model_name, $pathController, $feildNameGenCode, $textGenCode);
        self::pushRouterFn($model_name, $controllerName, $componentName);
        self::generateVueTableFn($componentName, $titleTable, $pathApi, $fieldsTable, $componentPath);
        self::generateVueFormFn($componentName, $titleTable, $pathApi, $fieldsTable, $titleForm, $feildNameGenCode, $componentPath);
        self::pushRouterVueFn($componentName, $titleTable, $pathApi, $fieldsTable, $titleForm, $feildNameGenCode, $componentPath);
        // ADD NEW ITEM MODULE
        $form=  [
            "code"=>self::genCode(),
            "name"=>$titleTable,
            "id_parent"=>null,
            "index"=>null,
            "alias"=>'/'.$componentPath.'/*',
            "class"=>'#',
            "icon"=>null,
            "path"=>'/'.$componentPath,
            "type"=>null,
            "status"=>'1',
        ];                   
        $res = Modules::create($form);
        if($res){
            return response()->json(['success'=>true, 'mess'=>'Thêm mới thành công!']);
        }else{
            return response()->json(['success'=>false, 'mess'=>'Thêm mới thất bại!']);
        }
    
    }
    //Migration
    public function genContentMigrate(Request $request){
       
        $request->validate([
            'table_name' => 'required|string',
            'fields' => 'required|string'
        ]);
        $tableName = $request->input('table_name');
        $fields = $request->input('fields');
        if($fields){
            $fields = json_decode($fields, true);
        }      
        return self::genMargationContent($tableName, $fields);
    }

    public function generateTable(Request $request)
    {
        $request->validate([
            'table_name' => 'required|string',
            'fields' => 'required|array'
        ]);

        $tableName = $request->input('table_name');
        $fields = $request->input('fields');

        // Tạo nội dung migration
        $migrationName = 'create_' . $tableName . '_table';
        $migrationFileName = date('Y_m_d_His') . '_' . $migrationName . '.php';
        $migrationPath = database_path("migrations/$migrationFileName");

        $migrationContent = $this->generateMigrationContent($tableName, $fields);
        file_put_contents($migrationPath, $migrationContent);

        // Chạy migrate để tạo bảng
        Artisan::call('migrate');

        return response()->json(['message' => 'Table created successfully', 'table' => $tableName]);
    }
    //End migration

    //Models

    public function genContentModel(Request $request){
       
        $request->validate([
            'model_name' => 'required|string',
            'table_name' => 'required|string',
            'fields' => 'required|string'
        ]);
        $tableName = $request->input('table_name');
        $fields = $request->input('fields');
        $model_name = $request->input('model_name');
        if($fields){
            $fields = json_decode($fields, true);
        }     
         
        return self::generateModelContent($model_name,$tableName, $fields);
    }

    public function generateModel(Request $request)
    {
        $request->validate([
            'model_name' => 'required|string',
            'table_name' => 'required|string',
            'fields' => 'required|string'
        ]);

        $modelName = ucfirst($request->input('model_name'));
        $tableName = $request->input('table_name');
        $fields = $request->input('fields');

        // Tạo nội dung model
        $modelPath = app_path("Models/admin/{$modelName}.php");
        $modelContent = $this->generateModelContent($modelName, $tableName, $fields);

        // Ghi file
        File::ensureDirectoryExists(app_path("Models/admin"));
        File::put($modelPath, $modelContent);

        return response()->json(['message' => 'Model created successfully', 'model' => $modelName]);
    }
    //End models
    //Controller
    public function genContentController(Request $request){     
        $request->validate([
            'controller_name' => 'required|string',
            'model_name' => 'required|string',       
            'controller_path'     
        ]);
        $modelName = ucfirst($request->input('model_name'));
        $controllerName = ucfirst($request->input('controller_name'));
        $controllerPath = ucfirst($request->input('controller_path','admin'));
        $feildNameGenCode = ($request->input('feild_name_gencode'));
        $textGenCode = ($request->input('text_gencode'));
        $content = self::genControllerContent($controllerName, $modelName, $controllerPath, $feildNameGenCode, $textGenCode);  
        return $content;
    } 

    public function generateController(Request $request)
    {
        {
            $controllerName = $request->input('nameController');
            $modelName = $request->input('nameModel');
            $pathController = $request->input('pathController');            
            $controllerPath = app_path("Http/Controllers/{$controllerName}.php");
            if(@$pathController){
                $controllerPath = app_path("Http/Controllers/{$pathController}.php");
            }
    
            // 1. Tạo Controller bằng Artisan
            Artisan::call("make:controller {$controllerName}");
      
            // 2. Kiểm tra xem file đã được tạo chưa
            if (File::exists($controllerPath)) {
                // Nội dung muốn chèn vào controller
                $content = self::genControllerContent($controllerName, $modelName, $pathController);              
                // 3. Ghi nội dung vào file
                File::put($controllerPath, $content);
    
                return response()->json(['message' => "Controller {$controllerName} created and updated successfully!"]);
            }
    
            return response()->json(['error' => 'Failed to create controller'], 500);
        }
        
    }
    //End controller
    //Router api
    public function genContentRouter(Request $request){
        $request->validate([
            'model_name' => 'required|string',
        ]);
        $model_name = $request->input('model_name');
        $controllerName = $request->input('controller_name');
        return self::genListRouter($model_name, $controllerName);
    }
    public function addAdminRoute(Request $request)
    {
        $controllerName = ucfirst($request->input('controller_name')); // Ví dụ: 'CustomController'
        $routeName = $request->input('route_name'); // Ví dụ: 'custom-route'

        $newRoute = "    Route::get('$routeName', '$controllerName@index');\n";

        // Đường dẫn file api.php
        $routePath = base_path('routes/api.php');

        // Đọc nội dung file
        $fileContent = File::get($routePath);

        // Xác định vị trí của Route::prefix('admin')->namespace('admin')->group(function () {
        $pattern = "/Route::prefix\('admin'\)->namespace\('admin'\)->group\(function\s*\(\)\s*{/";
        preg_match($pattern, $fileContent, $matches, PREG_OFFSET_CAPTURE);

        if (!empty($matches)) {
            // Vị trí cần chèn
            $insertPosition = $matches[0][1] + strlen($matches[0][0]);

            // Chèn route vào bên trong nhóm admin
            $fileContent = substr_replace($fileContent, "\n$newRoute", $insertPosition, 0);

            // Ghi lại file
            File::put($routePath, $fileContent);

            return response()->json(['message' => 'Route added successfully']);
        }

        return response()->json(['error' => 'Admin route group not found'], 400);
    }
    //End router api
    //Vue file
    public function genContentVueTable(Request $request){
        $request->validate([
            'component_name' => 'required|string',
            'component_path' => 'required|string',
            'model_name' => 'required|string',
            'title_table' => 'required|string',
            'fieldsTable' => 'required|string'
        ]);
        $fields = $request->input('fieldsTable');
        if($fields){
            $fields = json_decode($fields, true);
        }     
        $componentName = $request->input('component_name');
        $componentPath = $request->input('component_path');
        $pathApi = $request->input('model_name');
        $titleTable = $request->input('title_table');
        return self::generateVueTemplateTable($componentName,$titleTable,$pathApi,$fields);

    }
    public function generateVueTable(Request $request)
    {
        $request->validate([
            'component_name' => 'required|string',
            'component_path' => 'required|string',
            'model_name' => 'required|string',
            'title_table' => 'required|string',
            'fields' => 'required|string'
        ]);
        $fields = $request->input('fields');
        if($fields){
            $fields = json_decode($fields, true);
        }     
        $componentName = $request->input('component_name');
        $componentPath = $request->input('component_path');
        $pathApi = $request->input('model_name');
        $titleTable = $request->input('title_table');       
        $vuePath = resource_path("js/backend/components/{$componentPath}/index.vue");

        // Nội dung mặc định của file Vue
        $content =self::generateVueTemplateTable($componentName,$titleTable,$pathApi,$fields);

        // Kiểm tra thư mục components, nếu chưa có thì tạo
        if (!File::isDirectory(resource_path('js/components'))) {
            File::makeDirectory(resource_path('js/components'), 0755, true);
        }

        // Ghi nội dung vào file .vue
        File::put($vuePath, $content);

        return response()->json(['message' => "Vue file {$componentName}.vue created successfully!"]);
    }

    public function genContentVueForm(Request $request){
        $request->validate([
            'component_name' => 'required|string',
            'component_path' => 'required|string',
            'model_name' => 'required|string',
            'title_table' => 'required|string',
            'title_form' => 'required|string',
            'fieldsTable' => 'required|string',
            'feild_name_gencode' => 'required|string',
            'disabled' => 'required|string',
        ]);
        $fields = $request->input('fieldsTable');
        if($fields){
            $fields = json_decode($fields, true);
        }     
        $componentName = $request->input('component_name');
        $componentPath = $request->input('component_path');
        $feildNameGenCode = $request->input('feild_name_gencode');
        $pathApi = $request->input('model_name');
        $titleTable = $request->input('title_table');
        $titleForm = $request->input('title_form');
        return self::generateVueTemplateForm($componentName, $titleTable, $pathApi, $fields, $titleForm, $feildNameGenCode);
    }

    public function genContentVueRouter(Request $request){
        $request->validate([
            'component_name' => 'required|string',
            'component_path' => 'required|string',
            'model_name' => 'required|string',
            'title_table' => 'required|string',
            'title_form' => 'required|string',
            'fieldsTable' => 'required|string',
            'feild_name_gencode' => 'required|string',
            'disabled' => 'required|string',
        ]);
        $fields = $request->input('fieldsTable');
        if($fields){
            $fields = json_decode($fields, true);
        }     
        $componentName = $request->input('component_name');
        $componentPath = $request->input('component_path');
        $feildNameGenCode = $request->input('feild_name_gencode');
        $pathApi = $request->input('model_name');
        $titleTable = $request->input('title_table');
        $titleForm = $request->input('title_form');
        return self::generateVueRouter($componentPath, $componentName);
    }
    
    public function generateRouter(Request $request){
        $request->validate([
            'component_name' => 'required|string',
            'component_path' => 'required|string',           
        ]);
        $componentName = $request->input('component_name');
        $componentPath = $request->input('component_path');

        // Đọc file router Vue hiện tại
        $routerPath = resource_path('js/backend/router/routes.js');        
        $routerContent = file_get_contents($routerPath);    
        // Xác định vị trí của `children` trong `/dashboard`
        $dashboardPattern = '/path: \'\/dashboard\',[\s\S]*?children: \[/';
        preg_match($dashboardPattern, $routerContent, $matches);

        if (!$matches) {
            return response()->json(['error' => 'Không tìm thấy /dashboard trong file router'], 400);
        }

        $vueRoutes = self::generateVueRouter($componentPath, $componentName);       

        // Chèn vào `children` của `/dashboard`
        if (!str_contains($routerContent, "path: $componentPath")) {
            $routerContent = preg_replace($dashboardPattern, "$0{$vueRoutes}", $routerContent);

            // Ghi lại file router
            file_put_contents($routerPath, $routerContent);
        }

        return response()->json(['message' => 'Router Vue đã được cập nhật vào /dashboard!']);

    }
}
