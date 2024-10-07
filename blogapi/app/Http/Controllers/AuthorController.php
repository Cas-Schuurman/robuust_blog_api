<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Error;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
        public function index(){
            return Author::all();
        }
    
        public function show(Author $author){
            return $author;
        }
    
        public function store(Request $request){
            // Put author into the database
            $author = Author::create($request->all());
    
            //Send confirm message to confirm the author has been added
            return response()->json([
                'message' => "succesfully added the author to the database!",
                'author' => $author,
            ], 201);
        }
    
        public function update(Request $request, Author $author){
            $author->update($request->all());
        }
    
        //Delete author but because it is cascade all the blogs will be removed from this author
        public function delete($authorid){
            

            try {
                Author::find($authorid)->delete();
            } catch (Error $e) {
                return response()->json([
                    'message' => "cannot delete author because author is not in database"
                ]);
            }       
        }
    
}
