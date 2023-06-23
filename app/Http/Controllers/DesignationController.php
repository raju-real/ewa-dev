<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = Designation::latest()->get();
        return view('settings.designations',compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['title' => 'required|max:100']);
        $row = new Designation();
        $row->title = $request->title;
        $row->description = $request->description;
        $row->created_by = Auth::id();
        $row->save();
        return redirect()->route('designations.index')->with(successMessage());
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
        //
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
        $this->validate($request,['title' => 'required|max:100']);
        $row = Designation::find($id);
        $row->title = $request->title;
        $row->description = $request->description;
        $row->save();
        return redirect()->route('designations.index')->with(successMessage());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Designation::find($id)->delete()) {
            return redirect()->route('designations.index')->with(deleteMessage());
        } else {
            return redirect()->route('designations.index')->with(warningMessage());
        }
    }
}
