<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
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
            $projects = Project::where('title', 'LIKE', "%$keyword%")
                ->orWhere('lang_title', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('lang_description', 'LIKE', "%$keyword%")
                ->orWhere('album', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $projects = Project::latest()->paginate($perPage);
        }

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.projects.create');
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
          'title' => 'required|max:100|unique:projects,title,NULL,id,deleted_at,NULL',
          'description' => 'required|max:500',
          'lang_title' => 'required|max:100|unique:projects,lang_title,NULL,id,deleted_at,NULL',
          'lang_description' => 'required|max:500',
          'album' => 'required',
          'album.*' => 'file|image|mimes:jpeg,png,jpg,gif,svg',
    		]);
        $requestData = $request->all();
        if($request->hasfile('album'))
         {
            foreach($request->file('album') as $file)
            {
                $name=$file->store('uploads', 'public');
                $data[] = $name;
            }
         }

         $collection = json_encode($data);

        Project::create([
          'title' =>$requestData['title'],
          'description' =>$requestData['description'],
          'lang_title' =>$requestData['lang_title'],
          'lang_description' =>$requestData['lang_description'],
          'album' =>$collection,
        ]);


        return redirect('admin/projects')->with('flash_message', 'Project added!');
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
        $project = Project::findOrFail($id);

        return view('admin.projects.show', compact('project'));
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
        $project = Project::findOrFail($id);

        return view('admin.projects.edit', compact('project'));
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
      $project = Project::findOrFail($id);
      $this->validate($request, [
        'title' => 'required|max:100|unique:projects,title,'. $project->id . ',id,deleted_at,NULL',
        'description' => 'required',
        'lang_title' => 'required|max:100|unique:projects,lang_title,'. $project->id . ',id,deleted_at,NULL',
        'lang_description' => 'required',
        'album' => 'sometimes',
        'album.*' => 'file|image|mimes:jpeg,png,jpg,gif,svg',
      ]);
      $requestData = $request->all();

      if($request->hasfile('album'))
       {
          foreach($request->file('album') as $file)
          {
              $name=$file->store('uploads', 'public');
              $data[] = $name;
          }
          $collection = json_encode($data);
          $project->update([
            'album' =>$collection,
          ]);
       }


      $project->update([
        'title' =>$requestData['title'],
        'description' =>$requestData['description'],
        'lang_title' =>$requestData['lang_title'],
        'lang_description' =>$requestData['lang_description'],
      ]);

        return redirect('admin/projects')->with('flash_message', 'Project updated!');
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
        Project::destroy($id);

        return redirect('admin/projects')->with('flash_message', 'Project deleted!');
    }
}
