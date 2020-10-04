<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\NewsLetter;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class NewsLetterController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\View\View
   */
  public function index(Request $request)
  {
    $lang = $request->input('lang') ?? '';
    $perPage = $request->input('perPage') ?? 10;
    if (strtolower($lang) == 'ar') {
      $newsletter = NewsLetter::select('id' , 'lang_title as title',  'lang_image as image' )->latest()->paginate($perPage);
      if (count($newsletter) > 0) {
        foreach ($newsletter as $value) {
          $value->image = asset('storage/' . $value->image);
        }
        return response()->json([
          'news' => $newsletter,
          'code' => 200
          ] , 200);
        }else {
          return response()->json([
            'message' => 'no newsletter exist',
            'code' => 404
            ] , 404);
          }
    }elseif (strtolower($lang) == 'en') {
      $newsletter = NewsLetter::select('id' , 'title',  'image' )->latest()->paginate($perPage);
      if (count($newsletter) > 0) {
        foreach ($newsletter as $value) {
          $value->image = asset('storage/' . $value->image);
        }
        return response()->json([
          'news' => $newsletter,
          'code' => 200
          ] , 200);
        }else {
          return response()->json([
            'message' => 'no newsletter exist',
            'code' => 404
            ] , 404);
          }

    }else{
      return response()->json([
        'message' => 'please enter language',
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
  public function show(Request $request,$id)
  {
      $newsletter = NewsLetter::find($id);
      $lang = $request->input('lang') ?? '';
      if (!$newsletter) {
        return response()->json([
          'message' => 'no newsletter esixt for this id',
          'code' => 404
        ],404);
      }

      if (strtolower($lang) == 'ar') {
        $newsletter = NewsLetter::where('id' , $id)->select('id' , 'lang_title as title', 'lang_body as body' , 'lang_image as image')->first();
        $newsletter->image = asset('storage/' . $newsletter->image);

        return response()->json([
          'news' => $newsletter,
          'code' => 200
          ] , 200);
    }elseif (strtolower($lang) == 'en') {
      $newsletter = NewsLetter::where('id' , $id)->select('id' , 'title', 'body' , 'image' )->first();
      $newsletter->image = asset('storage/' . $newsletter->image);

      return response()->json([
        'news' => $newsletter,
        'code' => 200
        ] , 200);
    }else {
      return response()->json([
        'message' => 'please enter language',
        'code' => 404
        ] , 404);
    }
  }
}
