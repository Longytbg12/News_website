<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//su dung mo hinh MVC
//load class Model de su dung o day
use App\News;

//su dung mo hinh MVC: lay giu lieu tu model

class NewsController extends Controller
{
    //tao bien $model (la mot bien ben trong class NewsController)
    public $model;
    //ham tao
    public function __construct(){
        //gan bien $model tro thanh bien object cua class News
        $this->model = new News();
    }
    //lay danh sach cac ban ghi
    public function read(){
        //lay du lieu tuham modelRead cua class News
        $data = $this->model->modelRead();
        //goi view, truyen du lieu ra view
        return view("backend.news_read",["data"=>$data]);
    }
    //update
    public function update($id){
        //tao mot action de dua vao thuoc tinh action cua the form
        $action = url("admin/news/update/$id");
        //lay mot ban ghi
        $record = $this->model->modelGetRecord($id);
        return view("backend.news_create_update",["record"=>$record,"action"=>$action]);
    }
    //update post
    public function updatePost($id){
        $this->model->modelUpdate($id);
        return redirect(url('admin/news'));
    }
    //create
    public function create(Request $request){
        //tao mot action de dua vao thuoc tinh action cua the form
        $action = url("admin/news/create");
        return view("backend.news_create_update",["action"=>$action]);
    }
    //create post
    public function createPost(Request $request){
        $this->model->modelCreate();
        return redirect(url('admin/news'));
    }
    //delete
    public function delete(Request $request,$id){
        $this->model->modelDelete($id);
        return redirect(url('admin/news'));
    }
}
