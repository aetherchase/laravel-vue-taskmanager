<?php

namespace App\Http\Controllers;

use Debugbar;
use App\Task;
use Illuminate\Http\Request;


class TasksController extends Controller
{
    public function index(){
        $tasks = Task::all();

        return $tasks;
    }

    public function store(Request $request)
    {
        Task::create($request->all());
    }

    /*public function edit(Task $task)
    {
        return true;
    }*/

    public function update(Task $task, Request $request)
    {
        $task->content = $request->input('content');
        $task->is_complete = $request->input('is_complete');
        Debugbar::info($request->input('is_complete'));
        $task->save();
    }
    
    public function destroy(Task $task)
    {
        $task->delete();
    }
}
