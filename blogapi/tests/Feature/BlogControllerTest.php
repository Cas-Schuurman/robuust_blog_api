<?php

namespace Tests\Feature;

use App\Http\Controllers\BlogController;
use Tests\TestCase;

class BlogControllerTest extends TestCase
{

    public function test_if_blogs_are_created_and_saved_in_database(): void
    {
        //create blog
        $blog = $this->postJson('api/blogs', [
            'title' => 'new_blog_test',
            'body' => 'Test',
            'author_ID' => 1
        ]);
        //fetch blog->id from $blog attributes
        $blogid = $blog->json()["blog"]["id"]; 
        
        //check if id is in database
        $this->assertDatabaseHas('blogs', [
            'id' => $blogid
        ]);

        //eventually delete the blog because otherwhise the database will be filled with testdata
        $this->deleteJson('api/blogs/' . $blogid);
    }

    public function test_if_a_specific_blog_is_deleted_from_database(): void
    {

        //Create blog in order to remove blog
        $blog = $this->postJson('api/blogs', [
            'title' => 'Test',
            'body' => 'Test',
            'author_ID' => 1
        ]);
        //fetch blog->id from $blog attributes
        $blogid = $blog->json()["blog"]["id"];

        //delete specific blog
        $this->deleteJson('api/blogs/' . $blogid);

        //check if blog is not in database
        $this->assertDatabaseMissing('blogs', [
            'id' => $blogid
        ]);
    }

    public function test_if_blog_is_updated_with_correct_values(): void
    {

        //Create blog in order to remove blog
        $oldblog = $this->postJson('api/blogs', [
            'title' => 'Test',
            'body' => 'Test',
            'author_ID' => 1
        ]);
        //fetch blog->id from $blog attributes
        $blogid = $oldblog->json()["blog"]["id"];

        //update specific blog with $blogid
        $this->putJson('api/blogs/' . $blogid, [
            'title' => 'This is a long title to test if it is the same test_if_blog_is_updated_with_correct_values',
            'body' => 'This is a short body to test if it is updated the same body test_if_blog_is_updated_with_correct_values',
            'author_ID' => 1
        ]);

        //check if blog is updated
        $this->assertDatabaseHas('blogs', [
            'id' => $blogid,
            'title' => 'This is a long title to test if it is the same test_if_blog_is_updated_with_correct_values',
            'body' => 'This is a short body to test if it is updated the same body test_if_blog_is_updated_with_correct_values',
            'author_ID' => 1
        ]);

        //eventually delete the blog because otherwhise the database will be filled with testdata
        $this->deleteJson('api/blogs/' . $blogid);
    }

    public function test_check_if_specific_blog_is_shown(){
        $blog = $this->postJson('api/blogs', [
            'title' => 'check_if_specific_blog_is_shown',
            'body' => 'check_if_specific_blog_is_shown',
            'author_ID' => 1
        ]);
        //fetch blog->id from $blog attributes
        $blogid = $blog->json()["blog"]["id"];
        
        //fetch the blog
        $blog = $this->get('api/blogs/' . $blogid);
        //check if blog is shown
        $blog->assertJson([
            'title' => 'check_if_specific_blog_is_shown',
            'body' => 'check_if_specific_blog_is_shown',
            'author_ID' => 1
        ]);

        //eventually delete the blog because otherwhise the database will be filled with testdata
        $this->deleteJson('api/blogs/' . $blogid);
    }


    //test if function blogcount works and returns correct values
    public function test_if_the_function_blogcount_works_and_returns_correct_values(){
        $blogcount = BlogController::BlogCount(true);
        $expected = [
            "1" => ["blogspermonth" => 0, "month" => 1],
            "2" => ["blogspermonth" => 0, "month" => 2],
            "3" => ["blogspermonth" => 0, "month" => 3],
            "4" => ["blogspermonth" => 0, "month" => 4],
            "5" => ["blogspermonth" => 0, "month" => 5],
            "6" => ["blogspermonth" => 0, "month" => 6],
            "7" => ["blogspermonth" => 0, "month" => 7],
            "8" => ["blogspermonth" => 0, "month" => 8],
            "9" => ["blogspermonth" => 0, "month" => 9],
            "10" => ["blogspermonth" => 0, "month" => 10],
            "11" => ["blogspermonth" => 0, "month" => 11],
            "12" => ["blogspermonth" => 0, "month" => 12],
        ];

        $this->assertEquals(json_encode($expected), $blogcount);
    }
}
