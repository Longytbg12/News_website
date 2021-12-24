<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//trong controller muon su dung doi tuong nao thi phai khai bao o day
//doi tuong thao tac csdl
use DB;
//doi tuong ma hoa password
use Hash;

//thuc hien Query Builder: su dung doi tuong DB

class UsersController extends Controller
{
    //url: public/admin/users
    public function read(){
        //paginate(4) -> phan 4 ban ghi tren mot trang
        $data = DB::table("users")->orderBy("id","desc")->paginate(4);
        //goi view
        return view("backend.users_read",["data"=>$data]);
    }
    //update - GET
    public function update($id){
        //tao mot action de dua vao thuoc tinh action cua the form
        $action = url("admin/users/update/$id");
        //lay mot ban ghi
        //first() -> lay mot ban ghi
        $record = DB::table("users")->where("id","=",$id)->first();
        return view("backend.users_create_update",["record"=>$record,"action"=>$action]);
    }
    //update - POST
    public function updatePost($id){
        $name = request("name");
        $password = request("password");
        //update name
        DB::Table("users")->where("id","=",$id)->update(["name"=>$name]);
        //neu password khong rong thi update password
        if($password != ""){
            //ma hoa password
            $password = Hash::make($password);
            DB::Table("users")->where("id","=",$id)->update(["password"=>$password]);
        }
        //di chuyen den mot url khac
        return redirect(url("admin/users"));
    }
    //create - GET
    public function create(){
        //tao mot action de dua vao thuoc tinh action cua the form
        $action = url("admin/users/create");
        return view("backend.users_create_update",["action"=>$action]);
    }
    //create - POST
    public function createPost(){
        $email = request("email");
        $name = request("name");
        $password = request("password");
        //ma hoa password
        $password = Hash::make($password);
        //kiem tra xem email da ton tai chua, nua chua ton tai thi moi cho insert
        //Count() -> tra ve so luong ban ghi truy van
        $countEmail = DB::Table("users")->where("email","=",$email)->Count();
        if($countEmail == 0){
            //update name
            DB::Table("users")->insert(["name"=>$name,"email"=>$email,"password"=>$password]);
            //di chuyen den mot url khac
            return redirect(url("admin/users"));
        }else
            return redirect(url("admin/users/create?notify=emailExists"));
        
    }
    //delete
    public function delete($id){
        //lay mot ban ghi
        //first() -> lay mot ban ghi
        DB::table("users")->where("id","=",$id)->delete();
        //di chuyen den mot url khac
        return redirect(url("admin/users"));
    }
}
