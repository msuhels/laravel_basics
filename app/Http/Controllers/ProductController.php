<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helpers;
use Illuminate\Routing\UrlGenerator;
use Response;
use Headers;
use DB;
use File;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Models\ProductModel;

class ProductController extends Controller
{
    public function __construct()
    {
        
    }

    public function list(Request $request)
    {   
        // $productD  = ProductModel::find(1);
        // echo"<pre>";print_r($productD->toArray());
        // $product  = ProductModel::find(1)->category;
        // echo"<pre>";print_r($productD->category->toArray()); die;

        $data['listData'] = ProductModel::
                where("is_deleted","0")
                ->paginate(10)
                ->appends(request()->except('page'));
        // Helpers::pp($all);
        $data['page_name']  = "Product-List";
        return view('pages.product.list', $data);
    }

    public function getList(Request $request)
    {   
        $data['table_name'] = "products";
        $data['input'] = $request->all();
        //$responce = Helpers::GetRecordList($data);

        $searchParameters = array();

        if (isset($request->search) || isset($request->status))
         {
        
            $searchParameters['status'] = $request->status;
            $searchParameters['search'] = $request->search;

        }

        $is_deleted = isset($request->status)?$request->status:0;

        $data['listData'] = ProductModel::
                where("is_deleted",$is_deleted)
                ->where(function($query) use ($searchParameters)
                    {   
                        if ( isset($searchParameters['search']) && ($searchParameters['search'] != '' ))
                        {
                            $columns = \Config::get('databaseTableConfig.'.'products');
                            foreach ($columns as $key => $value) {
                                $query->orWhere($value, 'LIKE', "%{$searchParameters['search']}%");
                            }
                        }
                    })
                ->paginate(2)
                ->appends(request()->except('page'));
        
        $data['page_name']  = "Product-List";
        return view('pages.product.product-table', $data);
    }

    public function add(Request $request) 
    {   

        //echo "<pre>";print_r($request->all());die;
        $data['table_name'] = "products";
        $data['input'] = $request->all();

        $responce = Helpers::AddRecored($data);
        
        if ($responce == true) {
            $a = json_encode(['message' => 'Recored Insert successfully', 'status' => 200]);
            return response($a, 200)->header('Content-Type', 'application/json');
        } else {
            $a = json_encode(['Error' => 'Something went wrong please check', 'status' => 500]);
            return response($a, 500)
                    ->header('Content-Type', 'application/json');
        }
    }

    public function getRecoredByID(Request $request)
    {
        $data['data'] = ProductModel::
            where("is_deleted","0")
            ->where("id",$request->id)
            ->first();
            return $a = view('pages/product/popup/edit-form', $data);
    }

    public function update(Request $request)
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
        }

        $data['table_name'] = "products";
        $data['where_col']  = "id";
        $data['input']      = $request->all();
        
        $responce = Helpers::UpdateRecored($data);
        // Helpers::pp($responce); 

        if ($responce == true) {
            $a = json_encode(['message' => 'Recored Updated successfully', 'status' => 200]);
            return response($a, 200)->header('Content-Type', 'application/json');
        } else {
            $a = json_encode(['Error' => 'Something went wrong please check', 'status' => 500]);
            return response($a, 500)
                    ->header('Content-Type', 'application/json');
        }

    }

    public function delete(Request $request)
    {
        $data['table_name']         = "products";
        $data['recored_id']         = $request->id;
        $data['column_name']        = 'id';
        // $data['delete_type']     = "hard";

        $data['delete_type']        = "soft";
        $data['soft_column_name']   = "is_deleted";
        
        $responce = Helpers::DeleteRecored($data);
        
        if ($responce == true) {

            $a = json_encode(['message' => 'Recored delete successfully', 'status' => 200]);
            return response($a, 200)
                    ->header('Content-Type', 'application/json');
        } else {
            $a = json_encode(['Error' => 'Something went wrong please check', 'status' => 500]);
            return response($a, 500)
                    ->header('Content-Type', 'application/json');
        }
     }
}
