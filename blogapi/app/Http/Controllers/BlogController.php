<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Blog;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class BlogController extends Controller
{
    public function index(){
        $blogs = Blog::with('author')->paginate(5);
        return View('blogs.index', compact('blogs'));
    }

    public function show(Blog $blog){
        return $blog;
    }

    public function store(Request $request){
        //Check if author is in author table otherwise return with error else continue to put blog into the database
        if (!Author::where('author_ID', $request->all()["author_ID"])->exists()) {
            return response()->json([
                'message' => "cannot add blog because author is not in database"
            ]);
        }
        // Put blog into the database
        $blog = Blog::create($request->all());

        //Send confirm message to confirm the blog has been added
        return response()->json([
            'message' => "succesfully added the blog to the database!",
            'blog' => $blog,
        ], 201);
    }

    public function update(Request $request, Blog $blog){
        $blog->update($request->all());
    }

    public function delete(Blog $blog){
        $blog->delete();
    }

}
