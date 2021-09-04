<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Book;

class BookController extends Controller
{

    /**
     * Create api.
     *
     * @return \Illuminate\Http\Response
     */
    public function createBook(Request $request)
    {
      $validator = Validator::make($request->all(), [
          'name' => 'required',
          'isbn' => 'required',
          'authors' => 'required',
          'country' => 'required',
          'number_of_pages' => 'required',
          'publisher' => 'required',
          'release_date' => 'required',
      ]);
      if ($validator->fails()) {
        return response()->json([
          'success' => false,
          'message' => $validator->errors(),
        ], 401);
      }

      $input = $request->all();
      
      Book::create($input);

      $books =  DB::table('books')->first();

          $data = [
            'name' => $books->name,
            'isbn' => $books->isbn,
            'authors' => [$books->authors],
            'number_of_pages' => $books->number_of_pages,
            'publisher' => $books->publisher,
            'country' => $books->country,
            'release_date' => $books->release_date,
        ];

          return response()->json([
            'status_code' => 201,
            'status' => "success",
            'data' => ["book"=>$data]
        ]);
    }

    /**
     * List Books api.
     *
     * @return \Illuminate\Http\Response
     */
    public function listBooks()
    {

          $books =  DB::table('books')->get();

        if($books != '[]'){
          $data = [
            'id' => $books[0]->id,
            'name' => $books[0]->name,
            'isbn' => $books[0]->isbn,
            'authors' => [$books[0]->authors],
            'number_of_pages' => $books[0]->number_of_pages,
            'publisher' => $books[0]->publisher,
            'country' => $books[0]->country,
            'release_date' => $books[0]->release_date,
        ];
    

          return response()->json([
            'status_code' => 200,
            'status' => "success",
            'data' => $data,
            'books' => $books,
        ]);
    }else{
        return response()->json([
            'status_code' => 200,
            'status' => "success",
            'data' => [],
        ]);
        }
    }

    /**
     * Update api.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateBook(Request $request, $id)
    {

      $input = $request->all();
      
        DB::table('books')->where('id', $id)->update($input);

        $books =  DB::table('books')->where('id', $id)->first();

          $data = [
            'name' => $books->name,
            'isbn' => $books->isbn,
            'authors' => [$books->authors],
            'number_of_pages' => $books->number_of_pages,
            'publisher' => $books->publisher,
            'country' => $books->country,
            'release_date' => $books->release_date,
        ];

          return response()->json([
            'status_code' => 201,
            'status' => "success",
            "message" => "The book $books->name was updated successfully",
            'data' => ["book"=>$data]
        ]);
    }

     /**
     * Delete api.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteBook($id)
    {
        
        $books =  DB::table('books')->where('id', $id)->first();
        
        DB::table('books')->where('id', $id)->truncate();

          return response()->json([
            'status_code' => 201,
            'status' => "success",
            "message" => "The book $books->name was deleted successfully",
            'data' => []
        ]);
    }
  
}
