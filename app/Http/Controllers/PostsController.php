<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use Storage;

class PostsController extends Controller
{
  public function add()
  {
      return view('posts.create');
  }
  
  public function create(Request $request)
  {
      $post = new Post;
      $form = $request->all();
      
    //s3アップロード
    $image = $request->file('image');
    // バケットの`yukio1`フォルダへアップロード
    $path = Storage::disk('s3')->putFile('yukio1', $image, 'public');
    // アップロード下画像のフルパスを取得
    $post->image_path = Storage::disk('s3')->url($path);
    
    $post->save();
    
    return redirect('posts/create');
    
  }
}
