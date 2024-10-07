<?php

namespace Tests\Feature;
use Tests\TestCase;

class AuthorControllerTest extends TestCase
{
    public function test_if_author_is_created_and_saved_in_database(): void
    {
        //create author
        $author = $this->postJson('api/authors', [
            'firstname' => 'test_if_authors_are_created_and_saved_in_database',
            'lastname' => 'test_if_authors_are_created_and_saved_in_database',
        ]);
        //fetch author->id from $author attributes
        $authorid = $author->json()["author"]["author_ID"]; 
        
        //check if id is in database
        $this->assertDatabaseHas('author', [
            'author_ID' => $authorid
        ]);

        //eventually delete the author because otherwhise the database will be filled with testdata
        $this->deleteJson('api/authors/' . $authorid);
    }

    public function test_if_a_specific_author_is_deleted_from_database(): void
    {

        //create author
        $author = $this->postJson('api/authors', [
            'firstname' => 'test_if_a_specific_author_is_deleted_from_database',
            'lastname' => 'test_if_a_specific_author_is_deleted_from_database',
        ]);
        //fetch author->id from $author attributes
        $authorid = $author->json()["author"]["author_ID"]; 
    

        //eventually delete the author because otherwhise the database will be filled with testdata
        $this->deleteJson('api/authors/' . $authorid);

        //check if id is in database
        $this->assertDatabaseMissing('author', [
            'author_ID' => $authorid
        ]);
    }


    public function test_check_if_specific_author_is_shown(){
        $author = $this->postJson('api/authors', [
            'firstname' => 'test_if_a_specific_author_is_shown',
            'lastname' => 'test_if_a_specific_author_is_shown',
        ]);
        //fetch authors->id from $authors attributes
        $authorid = $author->json()["author"]["author_ID"];
        
        //fetch the authors
        $author = $this->get('api/authors/' . $authorid);
        //check if author is shown
        $author->assertJson([
            'firstname' => 'test_if_a_specific_author_is_shown',
            'lastname' => 'test_if_a_specific_author_is_shown',
        ]);

        //eventually delete the author because otherwhise the database will be filled with testdata
        $this->deleteJson('api/authors/' . $authorid);
    }


    public function test_if_author_is_updated_with_correct_values(): void
    {

        //Create author in order to update author
        $oldauthor = $this->postJson('api/authors', [
            'firstname' => 'test_if_author_is_updated_with_correct_values',
            'lastname' => 'test_if_author_is_updated_with_correct_values',
        ]);

        //fetch author->id from $author attributes
        $authorid = $oldauthor->json()["author"]["author_ID"];

        //update specific author with $authorid
        $this->putJson('api/authors/' . $authorid, [
            'firstname' => 'This is the updated firstname from author to test_if_author_is_updated_with_correct_values',
            'lastname' => 'This is the updated lastname from author to test_if_author_is_updated_with_correct_values',
        ]);

        //check if author is updated
        $this->assertDatabaseHas('author', [
            'author_ID' => $authorid,
            'firstname' => 'This is the updated firstname from author to test_if_author_is_updated_with_correct_values',
            'lastname' => 'This is the updated lastname from author to test_if_author_is_updated_with_correct_values',
        ]);

        //eventually delete the author because otherwhise the database will be filled with testdata
        $this->deleteJson('api/author/' . $authorid);
    }
}
