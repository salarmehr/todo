<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return Task::all();
    }

    public function show(Task $task)
    {
        return $task;
    }

    public function store(Request $request)
    {
        $data = $request->json();
        if ($data->get('title')) {
            return Task::create([
                'title' => $data->get('title'),
            ]);
        }
        return response(['success' => false, 'error' => 'title of the new task is not provide.'] , 401);
    }

    public function update(Task $task, Request $request)
    {
        $data = $request->json();
        if ($data->get('title')) {
            $task->title =$data->get('title');
            $task->save();
            return $task;
        }
        return response(['success' => false, 'error' => 'title of the new task is not provide.'] , 401);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return [
            'success' => true
        ];
    }
}
