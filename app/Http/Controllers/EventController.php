<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = Event::latest()->get();
        return view('settings.events',compact('results'));
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
        $this->validate($request,['title' => 'required','event_date' => 'required']);
        $row = new Event();
        $row->title = $request->title;
        $row->event_date = $request->event_date;
        if($request->hasFile('images')) {
            $file_name = [];
            foreach($request->file('images') as $key => $file){
                $imageName = time().$file->getClientOriginalName();
                $image_resize = Image::make($file->getRealPath());
                $image_resize->save('assets/files/' .$imageName);
                $file_name[] = 'assets/files/'.$imageName;
            }
            $row->images = implode(',',$file_name);
        }
        $row->save();
        return redirect()->route('events.index')->with(successMessage());
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Event::findOrFail($id);
        if($row->images != Null) {
            foreach (explode(',',$row->images) as $image) {
                if(file_exists($image)) {
                    unlink($image);
                }
            }
        }
        $row->delete();
        return redirect()->route('events.index')->with(deleteMessage());
    }
}
