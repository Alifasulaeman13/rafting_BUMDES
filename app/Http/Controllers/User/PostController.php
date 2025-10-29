<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        return response()->json(Post::where('publish_status','published')->orderBy('order_index')->get());
    }
}