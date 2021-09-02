<?php

namespace App\Http\Controllers;

use App\Models\ListTask;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $listId = $request->get('list');
        if($listId)
            $tasks=Task::selectRaw("*, datediff(deadline, ?) as remaining_days", [Date('y-m-d')])->where('list_id', $listId);
        else
            $tasks=Task::selectRaw("*, datediff(deadline, ?) as remaining_days", [Date('y-m-d')])->where('id', '!=', 0);
        
        $tasks = $tasks->orderByRaw("
                    case
                        when priority = 'High' then 1
                        when priority = 'Medium' then 2
                        when priority = 'Low' then 3
                    end asc
                ")->get();

        return view('tasks.index',compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lists=ListTask::all();
        return view('tasks.create',compact('lists'));
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
            'taskname' => 'string|required',
            'priority' => 'required',
            'deadline' => 'required',
            'listname' => 'required'

        ])->validate();

        $task = new Task();
        $task->task_name = $request->get('taskname');
        $task->list_id = $request->get('listname');
        $task->task_description = $request->get('description');
        $task->priority = $request->get('priority');
        $task->deadline = $request->get('deadline');
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task has been successfuly saved!');
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
        $task = Task::find($id);
        $lists=ListTask::all();
        return view('tasks.edit', compact('task','lists'));
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
            'taskname' => 'string|required',
            'priority' => 'required',
            'deadline' => 'required',
            'listname' => 'required'

        ])->validate();

        $task =  Task::find($id);
        $task->task_name = $request->get('taskname');
        $task->list_id = $request->get('listname');
        $task->task_description = $request->get('description');
        $task->priority = $request->get('priority');
        $task->deadline = $request->get('deadline');
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task has been successfuly updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::destroy($id);
        return redirect()->route('tasks.index')->with('success','Task has been successfully deleted!!');
    }
}
