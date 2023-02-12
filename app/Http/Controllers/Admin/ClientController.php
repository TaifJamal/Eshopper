<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients=Client::all();
        return view('admin.client.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image'=>'required',
        ]);

        $img_name=time().rand(). $request->image->getClientOriginalName();
        $request->image->move(public_path('image/client'), $img_name);

        Client::create([
            'image'=> $img_name,
        ]);

        // Redirect
        return redirect()->route('admin.clients.index')->with('msg', 'Client added successfully')->with('type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client=Client::find($id);
        return view('admin.client.edit',compact('client'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $client=Client::find($id);

        $image_name=$client->image;
        if( $request->image){
            $image_name=time().rand(). $request->image->getClientOriginalName();
            $request->image->move(public_path('image/client'), $image_name);
        }

        $client->update([
            'image'=> $image_name,
        ]);

        // Redirect
        return redirect()->route('admin.clients.index')->with('msg', 'Client updated successfully')->with('type', 'info');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client=Client::find($id);
        $client->delete();
        File::delete(public_path('image/client/'). $client->image);
        // Redirect
        return redirect()->route('admin.clients.index')->with('msg', 'Client deleted successfully')->with('type', 'danger');

    }


}
