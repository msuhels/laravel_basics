<?php
namespace App\Helpers;
use Response;
use Redirect;
use Session;
use Carbon\Carbon;
use DB;
class Helpers {

    public static function DeleteRecored($data)
    {   
        try {
            if ($data['delete_type'] == 'hard') {
                DB::table($data['table_name'])
                    ->where($data['column_name'], $data['recored_id'])
                    ->delete();
                    return true;
                
            } else {
                    DB::table($data['table_name'])
                    ->where($data['column_name'], $data['recored_id'])
                    ->update(
                            array(
                                $data['soft_column_name'] => 1,
                            )
                    );
                return true;
            }
        } catch (\Throwable $th) {
            return "this is catch please check DeleteRecored function in helper";
        }
    }


    public static function AddRecored($data)
    {   
        try {
            // $columns = \Config::get('project_config.'.$data['table_name']);    
            // Self::pp($column); die;
            $columns = array(
                //form_input_name       => "database_column_name"
                "id"            => "id",
                "title"         => "title",
                "description"   => "description",
                "image"         => "image",
            );

            $insertArray = [];
            foreach ($columns as $key => $col) {
                if (isset($data['input'][$key])) {
                    $insertArray[$col] = $data['input'][$key];
                }
            }
            // echo"<pre>";print_r($insertArray); die;
            DB::table($data['table_name'])->insert($insertArray);
            return true;
            
        } catch (\Throwable $th) {
            return "this is catch please check AddRecored function in helper";
        }
    }

    public static function UpdateRecored($data)
    {   

        try {
            $columns = \Config::get('databaseTableConfig.'.$data['table_name']); 
            // self::pp($columns);
            $columns = array(
                //form_input_name       => "database_column_name"
                "id"            => "id",
                "title"         => "title",
                "description"   => "description",
                "image"         => "image",
            );  
            $updateArray = [];
            
            foreach ($columns as $key => $col) {
                if (isset($data['input'][$key])) {
                    $updateArray[$col] = $data['input'][$key];
                }
            }

            DB::table($data['table_name'])
                    ->where($data['where_col'],$data['input'][$data['where_col']])
                    ->update($updateArray);
            return true;
        } catch (\Throwable $th) {
            return "this is catch please check UpdateRecored function in helper";
        }
    }

        public static function GetRecordList($data)
    {   
        try {
            $columns = \Config::get('databaseTableConfig.'.$data['table_name']);    
            // Self::pp($column); die;
            $columns = array(
                //form_input_name       => "database_column_name"
                "id"            => "id",
                "title"         => "title",
                "description"   => "description",
                "image"         => "image",
            );

            $searchParameters = array();

            if (isset($data['input']['search']) || isset($data['input']['status']))
             {
                $searchParameters['status'] = $data['input']['status'];
                $searchParameters['search'] = $data['input']['search'];
            }

            $is_deleted = isset($data['input']['status'])?$data['input']['status']:0;
            
            $listData = DB::table($data['table_name'])
                ->where("is_deleted",$is_deleted)
                ->where(function($query) use ($searchParameters)
                    {   
                        if ( isset($searchParameters['search']) && ($searchParameters['search'] != '' ))
                        {
                            foreach ($columns as $key => $value) {
                                $query->orWhere($value, 'LIKE', "%{$searchParameters['search']}%");
                            }
                        }
                    })
                ->paginate(2)
                ->appends(request()->except('page'));
                echo "<pre>";print_r($listData);die;
            return $listData;
            
        } catch (\Throwable $th) {
            return "this is catch please check GetRecordList function in helper";
        }
    }

    public static function AddRecored_old($data)
    {   
        try {
            DB::table($data['table_name'])->insert($data['input']);
            return true;
        } catch (\Throwable $th) {
            return "this is catch please check DeleteRecored function in helper";
        }
    }
    
    public static function pp($data,$die=0)
    {
        echo "<pre>";
            print_r($data);
        echo "</pre>";
        if($die ==0){
            die(" pp ");    
        }
        
    }

}