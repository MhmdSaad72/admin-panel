<?php

namespace App\Http\Controllers\API;

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
      $lang = $request->input('lang') ?? '';
      $perPage = $request->input('perPage') ?? 10;
      if (strtolower($lang) == 'ar') {
        $projects = Project::select('id' , 'lang_title as title' , 'album' )->latest()->paginate($perPage);
        foreach ($projects as $key => $value) {
          if (json_decode($value->album)) {
            $value->album =  asset('storage/' . json_decode($value->album)[0]);
          }
        }
        if (count($projects) > 0) {
          return response()->json([
            'projects' => $projects,
            'code' => 200
            ] , 200);
          }else {
            return response()->json([
              'message' => 'no projects exist',
              'code' => 404
              ] , 404);
            }
      }elseif (strtolower($lang) == 'en') {
        $projects = Project::select('id' , 'title' , 'album' )->latest()->paginate($perPage);
        foreach ($projects as $key => $value) {
          if (json_decode($value->album)) {
            $value->album =  asset('storage/' . json_decode($value->album)[0]);
          }
        }
        if (count($projects) > 0) {
          return response()->json([
            'projects' => $projects,
            'code' => 200
            ] , 200);
          }else {
            return response()->json([
              'message' => 'no projects exist',
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
        $project = Project::find($id);
        $lang = $request->input('lang') ?? '';
        if (!$project) {
          return response()->json([
            'message' => 'no project esixt for this id',
            'code' => 404
          ],404);
        }

        if (strtolower($lang) == 'ar') {
          $project = Project::where('id' , $id)->select('id' , 'lang_title as title', 'lang_description as description', 'album')->get();
            if (json_decode($project[0]->album)) {
              $albums =  json_decode($project[0]->album);
              foreach ($albums as $key => $value) {
                $album[] =  asset('storage/' . $value);
              }

            }
          $project[0]->album  = $album;
          return response()->json([
            'project' => $project,
            'code' => 200
            ] , 200);
      }elseif (strtolower($lang) == 'en') {
        $project = Project::where('id' , $id)->select('id' , 'title', 'description', 'album')->get();
        if (json_decode($project[0]->album)) {
          $albums =  json_decode($project[0]->album);
          foreach ($albums as $key => $value) {
            $album[] =  asset('storage/' . $value);
          }
        }
        $project[0]->album  = $album;
        return response()->json([
          'project' => $project,
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
