<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
/*
    - Khi go mot url, laravel se nhan biet url do thong qua cac cau truc sau
        - Route::get("duongdanao",function(){}); -> GET
        - Route::post("duongdanao",function(){}); -> POST
        - Route::any("duongdanao",function(){}); -> GET, POST
*/
//url: public/hello
Route::get('hello',function(){
    echo "<h1>Hello world</h1>";
});
/*
    Truyen bien len url
    Route::get("duongdanao/{bien1}/{bien2}",function($bien1,$bien2){});
*/
//url: public/truyenbien/hello/2021
Route::get("truyenbien/{bien1}/{bien2}",function($bien1,$bien2){
    echo "<h1>$bien1 $bien2</h1>";
});
/*
Khi url co tag chung thi co the nhom theo tac chung do
Route::group(["prifix"=>"tentagchung"],function(){ cac duong dan ao khac });
*/
//group theo tag chung co the la admin
//admin/users  admin/news...
Route::group(["prefix"=>"admin"],function(){
    //cac duong dan ao khac
    Route::get("users",function(){
        echo "<h1>Trang user</h1>";
    });
    Route::get("news",function(){
        echo "<h1>Trang tin tức</h1>";
    });
});
/*
    goi view
    return view("tenthucmuc.tenview",truyen_bien_ra_view_neu_co);
*/
//url: public/goiview1
Route::get("goiview1",function(){
    return view("php57.view1");
});
/*
    Truyen bien ra view
    return view("tenthumuc/tenview",bientruyenra);
    Chu y: bientruyenra phai la mot array
*/
//url: public/goiview2
Route::get('goiview2',function(){
    //array("tenkey"=>"tenvalue") <=> ["tenkey"=>"tenvalue"]
    return view("php57.view2",["hoten"=>"Nguyễn Văn A","email"=>"nva@gmail.com"]);
});
/*
    - Cac cau truc trong view (balde engine)
        - Xuat bien, chuoi <=> echo trong php
            {{ "chuoi" }} <=> <?php echo "chuoi"; ?>
            {{ $bien }} <=> <?php echo $bien; ?>
            {!! "chuoi" !!} <=> <?php echo "chuoi"; ?>
            {!! $bien !!} <=> <?php echo $bien; ?>
        - khoi lenh if
            @if(ket qua so sanh tra ve true)
                html + code
            @else if(ket qua so sanh tra ve true)
                html + code
            @else
                html + code
            @endif
        - Khoi lenh for
            @for(batdau; ketthuc; lamsaodeketthuc)
                html + code
            @endfor
        - Khoi lenh foreach
            @foreach(array as $key=>$value)
                html + code
            @endforeach
*/
//url: public/goiview3
Route::get("goiview3",function(){
    return view("php57.view3");
});
/*
    - Form trong laravel
        - Trong the form phai co lenh sau thi moi bat du lieu duoc sau khi submit
            @csrf
        - Trang thai ban dau cua trang la GET -> trong file web.php se thuc hien Route::get
        - Sau khi an nut submit thi trang thai trang se la POST -> trong file web.php se thuc hien Route::post
        - Doi tuong Request::get("tentheform") se lay du lieu theo kieu POST, GET
*/
//url: public/goiform1
//trang thai ban dau cua trang la GET -> Route::get
Route::get("goiform1",function(){
    return view("php57.form1");
});
//sau khi an nut submit thi trang thai cua trang se la POST -> Route::post
Route::post("goiform1",function(){
    //lay du lieu
    $txt = Request::get("txt");
    return view("php57.form1",["txt"=>$txt]);
});
//url: public/cong2so -> GET
Route::get("cong2so",function(){
    return view("php57.form2");
});
//url: public/cong2so -> sau khi an nut submit
Route::post("cong2so",function(){
    return view("php57.form2");
});
//-------
//load trang layout.blade.php
Route::get("trangchu",function(){
    return view("php57.trangchu");
});
Route::get("gioithieu",function(){
    return view("php57.gioithieu");
});
/*
    - Tim hieu middleware
        - Cac file middleware nam tai duong dan: app\Http\Middleware\cac file
        - Tao middleware bang cau lenh: php artisan make:middleware Hello
        - Chu y: cac cau lenh cmd dung de tao controller, view, middelware... thi cmd do phai co duong dan nam trong thu muc php57_laravel
        - Sau khi tao file Hello.php xong thi phai dang ky middleware nay vao he thong thi moi su dung duoc
*/
Route::get("php57/hello",function(){
    echo "<h1>Trieu goi middleware Hello</h1>";
})->Middleware("hello");
//---
//Tim hieu controller
//muon su dung controller thi phai tao, khai bao no
//tao controller: php artisan make:controller tenController
//phai khai bao duong dan controller o day thi moi co the tac dong duoc vao file controller
use App\Http\Controllers\HelloController;
//goi ham index trong class HelloController
Route::get('goicontroller1',[HelloController::class,'index']);
/*
    - Truyen bien tuurl vao controller
    VD: public/goicontroller2/Hello/2021 -> goi ham hello, truyen vao 2 tham so    
*/
Route::get('goicontroller2/{bien1}/{bien2}',[HelloController::class,'hello']);
/*
    - Thao tac csdl
        - Ket noi csdl: open file .env, thay doi thong so ket noi o dong 12,13,14
        - Laravel co cau lenh de tu dong tao mot so bang. Trong cmd chay lenh: php artisan migrate
*/
/*
    - Mot so cach truy van csdl
        - Su dung query builder: doi tuong DB::....
            - Tac dong vao bang: DB::table("tenbang")->where()->orderBy->...
            - Lay nhieu ban ghi
               DB::table("tenbang")->where("tenbang","sosanh","tencot")->get();
            - Lay mot ban ghi
               DB::table("tenbang")->where("tenbang","sosanh","tencot")->first();
            - Phan trang
                DB::table("tenbang")->where("tenbang","sosanh","tencot")->paginate(sobanghitrenmottrang);
            - Order by
                DB::table("tenbang")->where("tenbang","sosanh","tencot")->orderBy("tencot","asc/desc");
            ...
        - Su dung Model
*/        
Route::get("pwd",function(){
    echo Hash::make("123");
});        
//url: public/csdl1
Route::get('csdl1',function(){
    //truy an lay tat cac cac ban ghi trong table users
    $users = DB::table("users")->orderBy("id","desc")->get();
    foreach($users as $rows){
        echo "<div>$rows->name - $rows->email</div>";
    }
});