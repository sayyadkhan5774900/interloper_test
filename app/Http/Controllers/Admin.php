<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
class Admin extends Controller
{
    //


    public function index(){
        $all_post = Post::all();
        return view('admin.admin',['data'=>$all_post]);
    }

    



}
