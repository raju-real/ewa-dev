<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = Faq::latest()->get();
        return view('settings.faqs',compact('results'));
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
        $this->validate($request,['question' => 'required|max:191','answer' => 'required|max:5000']);
        $row = new Faq();
        $row->question = $request->question;
        $row->answer = $request->answer;
        $row->created_by = Auth::id();
        $row->save();
        return redirect()->route('faqs.index')->with(successMessage());
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
        $this->validate($request,['question' => 'required|max:191','answer' => 'required|max:5000']);
        $row = Faq::findOrFail($id);
        $row->question = $request->question;
        $row->answer = $request->answer;
        $row->created_by = Auth::id();
        $row->save();
        return redirect()->route('faqs.index')->with(successMessage());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Faq::findOrFail($id)->delete()) {
            return redirect()->route('faqs.index')->with(deleteMessage());
        } else {
            return redirect()->route('faqs.index')->with(warningMessage());
        }
    }
}
