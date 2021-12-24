<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//chu y: trong controller muon su dung doi tuong nao thi phai khai bao doi tuong do bang tu khoa use
use DB; // Doi tuong thao tac csdl
use Hash; // doi tuong ma hoa csdl

class HelloController extends Controller
{
    //tao mot action trong controller <=> tao mot ham trong lop
    public function index(){
        echo "<h1>Hàm index trong controller có tên: HelloController</h1>";
    }
    //truyen bien tu url vao action
    public function hello($bien1,$bien2){
        echo "<h1>$bien1 $bien2</h1>";
    }
}
