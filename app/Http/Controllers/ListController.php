<?php

namespace App\Http\Controllers;

use App\Models\ListTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists=ListTask::all();
        return view('list-task.index',compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('list-task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'list_name' => 'string|max:100|min:3|unique:list_tasks',

        ])->validate();

        $list = new ListTask();
        $list->list_name = $request->get('listname');
        $list->list_description=$request->get('description');
        $list->save();

        return redirect()->route('list-task.index')->with('success', 'List Task has been successfully saved!!');
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
        $lists=ListTask::find($id);
        return view ('list-task.edit',compact('lists'));
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
        Validator::make($request->all(), [
            'list_name' => 'string|max:100|min:3|unique:list_tasks',

        ])->validate();

        $list =  ListTask::find($id);
        $list->list_name = $request->get('listname');
        $list->list_description=$request->get('description');
        $list->save();

        return redirect()->route('list-task.index')->with('success', 'List Task has been successfully updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ListTask::destroy($id);
        return redirect()->route('list-task.index')->with('success','User has been successfully deleted!!');
    }
}
