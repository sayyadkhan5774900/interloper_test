<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    //


    public function index(){

        $data = Comment::all();
        return view('admin.comments',['data'=>$data]);
    }
    public function addComments(Request $request){
        
         // Retrieve the current user's ID
    $userId = Auth::id();

    // Retrieve the current user's name
    $userName = Auth::user()->name;
 

        $comments = new Comment();
        $comments->post_id = $request->id;
        $comments->author_name=$userName;
        $comments->content= $request->comments;
        $result = $comments->save();
        
        $all_comments = Comment::all();
        if($result){
            return response()->json([
                'result' =>$all_comments
            ]);
        }

    }

    public function delete_comment(Request $request){

        $comment= Comment::find($request->comment_id);
        $result = $comment->delete();
        if($result){
            return response()->json([
                'result'=>'Comments Deleted Successfuly'
            ]);
        }
    }


}
