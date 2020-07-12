<?php

namespace App\Http\Controllers\API;

use App\CheckList;
use App\ItemCheckList;

use Illuminate\Http\Request;

class CheckListController extends BaseController
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(CheckList::class, 'checkList');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checkLists = CheckList::with('user')
                    ->get();

        return $this->sendResponse($checkLists->toArray(), 'CheckLists retrieved successfully.');
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

            return $this->sendResponse($checkList->toArray(), 'CheckList added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CheckList  $checkList
     * @return \Illuminate\Http\Response
     */
    public function show(CheckList $checkList)
    {
        $itemCheckLists = $checkList->itemCheckLists;

        return $this->sendResponse($itemCheckLists->toArray(), 'itemCheckLists retrieved successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CheckList  $checkList
     * @return \Illuminate\Http\Response
     */
    public function destroy(CheckList $checkList)
    {
        $itemCheckLists =  $itemCheckLists = $checkList->itemCheckLists->modelKeys();

        ItemCheckList::destroy($itemCheckLists);

        $checkList->delete();

        return $this->sendResponse([], 'CheckList delete successfully.');
    }
}
