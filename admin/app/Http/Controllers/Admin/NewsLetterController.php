<?php

namespace App\Http\Controllers\Admin;

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
        $keyword = $request->get('search');
        $perPage = 10;

        if (!empty($keyword)) {
            $newsletter = NewsLetter::where('title', 'LIKE', "%$keyword%")
                ->orWhere('lang_title', 'LIKE', "%$keyword%")
                ->orWhere('body', 'LIKE', "%$keyword%")
                ->orWhere('lang_body', 'LIKE', "%$keyword%")
                ->orWhere('image', 'LIKE', "%$keyword%")
                ->orWhere('lang_image', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $newsletter = NewsLetter::latest()->paginate($perPage);
        }

        return view('admin.news-letter.index', compact('newsletter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.news-letter.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
          'title' => 'required|max:100|unique:news_letters,title,NULL,id,deleted_at,NULL',
          'body' => 'required',
          'image' => 'required|file|image|mimes:jpeg,png,jpg,gif,svg',
          'lang_title' => 'required|max:100|unique:news_letters,lang_title,NULL,id,deleted_at,NULL',
          'lang_body' => 'required',
          'lang_image' => 'required|file|image|mimes:jpeg,png,jpg,gif,svg',

        ]);
        $requestData = $request->all();
        $requestData['image'] = $request->file('image')
                                        ->store('uploads', 'public');
        $requestData['lang_image'] = $request->file('lang_image')
                                        ->store('uploads', 'public');

        $newsletter = NewsLetter::create($requestData);
        $image = Image::make(public_path('storage/' . $newsletter->image))->fit(750,500);
        $lang_image = Image::make(public_path('storage/' . $newsletter->lang_image))->fit(750,500);
        $image->save();
        $lang_image->save();


        return redirect('admin/news-letter')->with('flash_message', 'NewsLetter added!');
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
        $newsletter = NewsLetter::findOrFail($id);

        return view('admin.news-letter.show', compact('newsletter'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $newsletter = NewsLetter::findOrFail($id);

        return view('admin.news-letter.edit', compact('newsletter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $newsletter = NewsLetter::findOrFail($id);
        $this->validate($request, [
          'title' => 'required|max:100|unique:news_letters,title,'. $id . ',id,deleted_at,NULL',
          'image' => 'file|image|mimes:jpeg,png,jpg,gif,svg',
          'body' =>'required',
          'arabic_title' => 'required|max:100|unique:news_letters,arabic_title,'. $id . ',id,deleted_at,NULL',
          'arabic_image' => 'file|image|mimes:jpeg,png,jpg,gif,svg',
          'arabic_body' =>'required',
        ]);
        $requestData = $request->all();
        if ($request->hasFile('image') ) {
              $requestData['image'] = $request->file('image')
                                              ->store('uploads', 'public');
              $newsletter->update([
                'image' => $requestData['image'],
              ]);
              $image = Image::make(public_path('storage/' . $newsletter->image))->fit(750,500);
              $image->save();
        }
        if ($request->hasFile('arabic_image') ) {
              $requestData['arabic_image'] = $request->file('arabic_image')
                                              ->store('uploads', 'public');
              $newsletter->update([
                'arabic_image' => $requestData['arabic_image'],
              ]);
              $arabicImage = Image::make(public_path('storage/' . $newsletter->arabic_image))->fit(750,500);
              $arabicImage->save();
        }

        $newsletter->update($requestData);

        return redirect('admin/news-letter')->with('flash_message', 'NewsLetter updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        NewsLetter::destroy($id);

        return redirect('admin/news-letter')->with('flash_message', 'NewsLetter deleted!');
    }
}
