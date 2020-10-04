<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Review;
use App\Client;
use Illuminate\Support\Facades\Validator;


class ReviewController extends Controller
{

    /*========================================
      Store a newly created review in storage.
    ========================================*/
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
          'name'=>'required|max:30',
          'description'=>'required',
          'image'=>'required|file|image|mimes:jpeg,png,jpg,gif,svg',
          'client_id' => 'required',
      ]);

        if ($validator->fails()) {
            return response()->json([
              'message' => $validator->errors(),
              'code' => 404
            ] , 404);
        }
      $requestData = $request->all();
      $requestData['image'] = $request->file('image')
                                      ->store('uploads', 'public');

      $client_id  = $request->client_id ;
      $client = Client::find($client_id);

      if (!$client_id) {
        return response()->json([
          'message' => 'no client found',
          'code' => 404
          ] , 404);
      }

     Review::create($requestData);

      return response()->json([
        'message' => 'Review created successfully',
        'code' => 200
      ] , 200);
    }
}
