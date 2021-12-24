<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//doi tuong thao tac csdl
use DB;

use App\Categories;
//doi tuong kien=m tra du lieu
use Validator;

class CategoriesController extends Controller
{
    public function read(){
        $data = Categories::orderBy("id","desc")->paginate(10);
        return view("backend.categories_read",["data"=>$data]);
    }
    //update
    //trong table cua controller co the truyen hoac k truyen vao doi tuong request
    public function update(Request $request,$id){
        $record = Categories::where("id","=",$id)->first();
        return view("backend.categories_create_update",["record"=>$record]);
    }

    public function updatePost(Request $request,$id){
        $name = $request->get("name");
        $description = $request->get("description");
        //su dung validation de rang buoc du lieu
        $rules = [
            'description' => 'required'
        ];
        $message = [
            'description.required' => 'phải nhập thông tin chi tiết'
        ];
        $validator = Validator::make($request->all(),$rules,$message);
        //kiem tra du lieu
        if($validator->fails()){
            $record = Categories::where("id","=",$id)->first();
            return view("backend.categories_create_update",["record"=>$record]);
        }else{
            //update du lieu
            Categories::where("id","=",$id)->update(['name'=>$name,'description'=>$description]);
            return redirect(url('admin/categories'));
        }
    }
    public function create(Request $request){
        return view("backend.categories_create_update");
    }
    public function createPost(Request $request){
        $name = $request->get("name");
        $description = $request->get("description");
        //them ban ghi
        Categories::insert(['name'=>$name,'description'=>$description]);
        return redirect(url('admin/categories'));
    }
    public function delete(Request $request,$id){
        Categories::where("id","=",$id)->delete();
        return redirect(url('admin/categories'));
    }
}
