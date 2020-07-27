<?php

namespace App\Http\Controllers\API;

use App\ItemCheckList;
use App\CheckList;
use Illuminate\Http\Request;

class ItemCheckListController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(ItemCheckList::class, 'itemCheckList');
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

        return $this->sendResponse($itemCheckList->toArray(), 'itemCheckList added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ItemCheckList  $itemCheckList
     * @return \Illuminate\Http\Response
     */
    public function show(ItemCheckList $itemCheckList)
    {
        //
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
        $itemCheckList->done = $request->done;
        $itemCheckList->save();

        return $this->sendResponse($itemCheckList->toArray(), 'itemCheckList update.');

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

        return $this->sendResponse([], 'ItemCheckList delete successfully.');
    }
}
