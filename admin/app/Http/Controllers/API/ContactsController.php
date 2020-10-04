<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ContactsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
          'name'=>'required|max:30',
          'object'=>'required',
          'phone'=>'required||regex:/(01)[0-9]{9}/|size:11',
      ]);

        if ($validator->fails()) {
            return response()->json([
              'message' => $validator->errors(),
              'code' => 404
            ] , 404);
        }
        $requestData = $request->all();
        $contact = Contact::create($requestData);

        return response()->json([
          'message' => 'contact created successfully',
          'code' => 200
        ] , 200);
    }


}
