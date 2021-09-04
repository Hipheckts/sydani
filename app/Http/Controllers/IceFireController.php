<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IceFireController extends Controller
{
    /**
     * List all Books
     *
     * @return \Illuminate\Http\Response
     */
    public function listAllBooks()
        {

            $allBooks = curl_init();

                curl_setopt_array($allBooks, array(
                CURLOPT_URL => 'https://www.anapioficeandfire.com/api/books',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Cookie: ARRAffinity=7206c7cd945961f7b9c40b79999fffae3e224139cdf3b08415b45fc38993dba9; ARRAffinitySameSite=7206c7cd945961f7b9c40b79999fffae3e224139cdf3b08415b45fc38993dba9'
                ),
                ));

                $response = curl_exec($allBooks);

                curl_close($allBooks);

                // echo $response;

            return response()->json([
                'success' => true,
                'allBooks' => $response,
                'message' => 'All Books Listed Successfully',
            ]);
    }

    /**
     * Requirement 1
     *
     * @return \Illuminate\Http\Response
     */
    public function reqOne(Request $request)
        {
            $allBooks = curl_init();

                curl_setopt_array($allBooks, array(
                CURLOPT_URL => 'https://www.anapioficeandfire.com/api/books?name='.$request->name,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Cookie: ARRAffinity=7206c7cd945961f7b9c40b79999fffae3e224139cdf3b08415b45fc38993dba9; ARRAffinitySameSite=7206c7cd945961f7b9c40b79999fffae3e224139cdf3b08415b45fc38993dba9'
                ),
                ));

                $response = curl_exec($allBooks);

                curl_close($allBooks);

                $json = json_decode($response,true);
                // echo $response;
                
            if($response != '[]') {

                $data = [
                    'name' => $json[0]['name'],
                    'isbn' => $json[0]['isbn'],
                    'authors' => $json[0]['authors'],
                    'number_of_pages' => $json[0]['numberOfPages'],
                    'publisher' => $json[0]['publisher'],
                    'country' => $json[0]['country'],
                    'release_date' => $json[0]['released'],
                ];

                return response()->json([
                    'status_code' => 200,
                    'success' => true,
                    'data' => $data
                ]);

            } else{
                $data = [];
                return response()->json([
                    'status_code' => 200,
                    'success' => true,
                    'data' => $data
                ]);
        }
    }
}
