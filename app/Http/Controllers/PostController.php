<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    //s
    public function index(){
        $allpost= Post::all();
        return view('posts.view', ['data'=>$allpost]);
  }

  public function AddPost(Request $request){


    
    $post = new Post;
    $post->title = $request->title;
    $post->content = $request->content;
    if($post->save()){
        return response()->json([
            'result'=>'Added Succssfuly',
        ]);
    }

  }

  public function edit_post(Request $request){
    $post = Post::find($request->id);
    return response()->json([
      'result'=>$post
    ]);
  }

  
  public function update_post(Request $request){
        
    $post =Post::find($request->id);
    $post->title = $request->title;
    $post->content = $request->content;
    $result = $post->save();

    if($result){
        return response()->json([
            'result'=>'Updated Successfuly'
        ]);
    }
}


public function delete_post(Request $request){
 
  $post = Post::find($request->post_id);
  $result = $post->delete();
  if($result){
    return response()->json([
      'result'=>'Post Deleted Successfuly'
    ]);
  }


}

}
