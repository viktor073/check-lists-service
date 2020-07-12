<?php

namespace App\Http\Controllers;

use App\ItemCheckList;
use App\CheckList;
use Illuminate\Http\Request;

class ItemCheckListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort(404);
    }

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->authorizeResource(User::class, 'users');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CheckList $checkList)
    {
        return view('itemCheckLists.create', ['checkList' => $checkList]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CheckList $checkList)
    {
        $itemCheckList = new ItemCheckList;
        $itemCheckList->name = $request->name;
        $itemCheckList->slug = $request->slug;
        $checkList->itemCheckLists()->save($itemCheckList);



        return redirect()->route('checkLists.show', [$checkList])->with('status', 'Item create!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ItemCheckList  $itemCheckList
     * @return \Illuminate\Http\Response
     */
    public function show(ItemCheckList $itemCheckList)
    {
        return view('itemCheckLists.show', ['itemCheckList' => $itemCheckList]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ItemCheckList  $itemCheckList
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemCheckList $itemCheckList)
    {
        return view('itemCheckLists.edit', ['itemCheckList' => $itemCheckList]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItemCheckList  $itemCheckList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemCheckList $itemCheckList)
    {
        if ($request->done != NULL){
            $itemCheckList->done = $request->done;
            $itemCheckList->save();

            $status = 'itemCheckList update';
            return redirect()->route('checkLists.show', [$itemCheckList->check_list_id])->with('status', $status);
        }

        $itemCheckList->name = $request->name;
        $itemCheckList->slug = $request->slug;
        $itemCheckList->save();

        $status = 'itemCheckList update';
        return redirect()->route('itemCheckLists.show', [$itemCheckList])->with('status', $status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ItemCheckList  $itemCheckList
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemCheckList $itemCheckList)
    {
        $itemCheckList->delete();

        $checkList = CheckList::find($itemCheckList->check_list_id);

        $message = 'Check List "'. $itemCheckList->name . '" delete!';
        return redirect()->route('checkLists.show', [$checkList])->with('status', $message);
    }
}
