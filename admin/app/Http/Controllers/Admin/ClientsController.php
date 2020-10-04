<?php

namespace App\Http\Controllers\Admin;

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
        $keyword = $request->get('search');
        $perPage = 10;

        if (!empty($keyword)) {
            $clients = Client::where('name', 'LIKE', "%$keyword%")
                ->orWhere('logo', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $clients = Client::latest()->paginate($perPage);
        }

        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.clients.create');
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
    			'name' => 'required|min:2|max:30',
          'logo' => 'required|file|image|mimes:jpeg,png,jpg,gif,svg',
    		]);
        $requestData = $request->all();
        $requestData['logo'] = $request->file('logo')
                                        ->store('uploads', 'public');

        Client::create($requestData);

        return redirect('admin/clients')->with('flash_message', 'Client added!');
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
        $client = Client::findOrFail($id);

        return view('admin.clients.show', compact('client'));
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
        $client = Client::findOrFail($id);

        return view('admin.clients.edit', compact('client'));
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
        $this->validate($request, [
    			'name' => 'required|min:2|max:30',
          'logo' => 'file|image|mimes:jpeg,png,jpg,gif,svg',
    		]);
        $requestData = $request->all();
        if ($request->hasFile('logo') ) {
              $requestData['logo'] = $request->file('logo')
                                              ->store('uploads', 'public');
        }

        $client = Client::findOrFail($id);
        $client->update($requestData);

        return redirect('admin/clients')->with('flash_message', 'Client updated!');
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
        Client::destroy($id);

        return redirect('admin/clients')->with('flash_message', 'Client deleted!');
    }
}
