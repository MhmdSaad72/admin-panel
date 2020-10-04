<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage') ?? 10;
        $client = Client::select('id' , 'name',  'logo' )->latest()->paginate($perPage);
        if (count($client) > 0) {
          foreach ($client as $value) {
            $value->logo = asset('storage/' . $value->logo);
          }
          return response()->json([
            'clients' => $client,
            'code' => 200
            ] , 200);
          }else {
            return response()->json([
              'message' => 'no clients exist',
              'code' => 404
              ] , 404);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $client = Client::where('id', $id)->select('id' , 'name' , 'logo')->first();
        if (!$client) {
          return response()->json([
            'message' => 'no client found',
            'code' => 404
            ] , 404);
        }

        $client->logo = asset('storage/' . $client->logo);
        
        return response()->json([
          'client' => $client,
          'code' => 200
          ] , 200);

    }

}
