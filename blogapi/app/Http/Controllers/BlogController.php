<?php
namespace App\Http\Controllers;
use App\Models\Author;
use App\Models\Blog;
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
    public function update(Request $request, Blog $blog){
        $blog = Blog::find($request->all()["blogid"]);
        $blog->update($request->all());

        return redirect("/blogs?page=" . $request->all()["page"]);
    }
    
    // Find blog id and delete the blog
    public static function delete(Blog $blog, Request $request){
        Blog::find($request->all()["blogid"])->delete();
        return redirect("/blogs?page=" . $request->all()["page"]);
    }

    public function BlogCount(){
        $year = date("Y");
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

        $object = json_encode($newBlogCounts);
        //return is an object otherwhise the return view gives error
        return $object;
    }

}
