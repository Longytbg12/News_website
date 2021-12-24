<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//su dung eloquent
class Categories extends Model
{
    //khai bao ten table de su dung
    protected $table = "categories";
    //neu trong table categories k cos 2 cot create_at va update_at thif phai khai bao dong been duoi
    public $timestamps = false;
}
