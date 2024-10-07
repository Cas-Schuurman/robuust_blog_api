<?php
namespace App\Http\Controllers;
use App\Models\Author;
use App\Models\Blog;
use Error;
use Exception;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        $blogs = Blog::with('author')->paginate(10);
        $blogcount = self::BlogCount();
        return View('blogs.index', compact('blogs'), compact('blogcount'));
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

    // Find blog id and update the blog
    public function update(Request $request, $blogid = null){
        if($blogid == null){
            $blogid = $request->all()["blogid"];
        }

        try {
            $blog= Blog::find($blogid);
            $blog->update($request->all());
        } catch (Error $e) {
            return response()->json([
                'message' => "cannot update blog because blog is not in database"
            ]);
        }  
        return redirect("/blogs");
    }
    
    // Find blog id and delete the blog
    //overload this function
    public static function delete(Request $request, $blogid = null){
        if($blogid == null){
            $blogid = $request->all()["blogid"];
        }
            try {
                Blog::find($blogid)->delete();
            } catch (Error $e) {
                return response()->json([
                    'message' => "cannot delete blog because blog is not in database"
                ]);
            }       
        return redirect("/blogs");
    }

    public static function BlogCount(bool $test = false) {

        //engels A bit crooked, but I don’t know the solution otherwise without breaking the function
        if($test){
            $year = 0;
        }else{
            $year = date("Y");
        }
        $blogcounts = Blog::select(Blog::raw('COUNT(*) as blogspermonth, MONTH(created_at) as month'))
        ->whereYear('created_at', $year)
        ->groupby('month')
        ->get();
        //create new object
        $newBlogCounts = [];

        for ($i = 1; $i < 13; $i++) { // Loop through months 1 to 12 (12 months)
            // Initialize the new object
            $newBlogCounts[$i] = (object) ['blogspermonth' => 0, 'month' => $i];
        
            // Check if the month exists in the original blogcounts
            foreach ($blogcounts as $count) {
                if ($count->month == $i) {
                    // If the month exists, use its blogspermonth value
                    $newBlogCounts[$i]->blogspermonth = $count->blogspermonth;
                    break;
                }
            }
        }

        $jsonnewBlogCount = json_encode($newBlogCounts);
        //return is an json otherwhise the return view gives error
        return $jsonnewBlogCount
;
    }

}
