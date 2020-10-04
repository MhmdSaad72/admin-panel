<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Review;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    /*=====================================
       Display a listing of the resource.
    =======================================*/
    public function index(Request $request)
    {
      $keyword = $request->get('search');
      $perPage = 10;

      if (!empty($keyword)) {
          $reviews = Review::where('name', 'LIKE', "%$keyword%")
              ->orWhere('description', 'LIKE', "%$keyword%")
              ->orWhereHas('client', function ($query) use ($keyword){
                $query->where('name', 'LIKE', "%$keyword%");
              })
              ->latest()->paginate($perPage);
      } else {
          $reviews = Review::latest()->paginate($perPage);
      }

      return view('admin.reviews.index', compact('reviews'));
    }


    /*============================================
      Remove the specified resource from storage.
    =============================================*/
    public function destroy($id)
    {
        Review::destroy($id);

        return redirect('admin/reviews')->with('flash_message', 'Review deleted!');
    }

}
