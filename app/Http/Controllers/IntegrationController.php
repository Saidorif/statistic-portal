<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IntegrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tender()
    {
        // $client = new \GuzzleHttp\Client();
        // $response = $client->post('http://tender.loc/login', [
        //     'auth' => [
        //         'mirxan@mail.ru', 
        //         'secret'
        //     ]
        // ]);

        // return response()->json($response->getBody()->getContents());

        // $query = json_encode($body);
        // $client = new \GuzzleHttp\Client();
        // $response = $client->post('http://tender.loc/login', [
        //     'auth' => [
        //         'mintrans', 
        //         'qP7N1_gEc6'
        //     ],
        //     'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
        //     'body' => $query
        // ]);
    }

}
