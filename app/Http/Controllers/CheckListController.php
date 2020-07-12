<?php

namespace App\Http\Controllers;

use App\CheckList;
use Illuminate\Http\Request;

class CheckListController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(CheckList::class, 'checkList');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $checkLists = CheckList::with('itemCheckLists')
                    ->with('user')
                    ->get();
        return view('checkLists.index', ['checkLists' => $checkLists]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('checkLists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $checkList = new CheckList;
        $checkList->name = $request->name;
        $checkList->slug = $request->slug;
        $checkList->user_id = auth()->user()->id;

        $checkList->save();

        return redirect()->route('checkLists.show', [$checkList])->with('status', 'Check List create!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CheckList  $checkList
     * @return \Illuminate\Http\Response
     */
    public function show(CheckList $checkList)
    {
        return view('checkLists.show', ['checkList' => $checkList]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CheckList  $checkList
     * @return \Illuminate\Http\Response
     */
    public function edit(CheckList $checkList)
    {
        return view('checkLists.edit', ['checkList' => $checkList]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CheckList  $checkList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CheckList $checkList)
    {
        $checkList->name = $request->name;
        $checkList->slug = $request->slug;

        $checkList->save();

        return redirect()->route('checkLists.show', [$checkList])->with('status', 'Profile updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CheckList  $checkList
     * @return \Illuminate\Http\Response
     */
    public function destroy(CheckList $checkList)
    {
        $checkList->delete();

        $message = 'Check List "'. $checkList->name . '" delete!';
        return redirect()->route('checkLists.index')->with('status', $message);
    }
}
