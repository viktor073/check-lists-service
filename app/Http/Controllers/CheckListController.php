<?php

namespace App\Http\Controllers;

use App\CheckList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckListController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->authorizeResource(CheckList::class, 'checkList');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $checkLists = CheckList::with('itemCheckLists', 'user')
                    ->paginate(5);
        return view('checkLists.index', compact('checkLists'));
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
        $checkList = CheckList::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'user_id' => Auth::id(),
        ]);

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
        $checkList = $checkList->fill([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

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
