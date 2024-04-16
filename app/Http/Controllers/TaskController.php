<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    function getTasks(Request $request) {
        $tasks = Task::where("user_id", auth()->user()->id)->get();
        return response()->json($tasks, 200, [], JSON_PRETTY_PRINT);
    }

    function getTask($id) {
        $task = Task::where("id", $id)->first();
        return response()->json($task, 200, [], JSON_PRETTY_PRINT);
    }

    function setTask(Request $request) {
        $fields = $request->validate([
            "title" => "required",
            "description" => "required"
        ]);

        $task = Task::create([
            "title" => $fields["title"],
            "description" => $fields["description"],
            "user_id" => auth()->user()->id
        ]);

        return response()->json([
            "message" => "Task has been created",
            "data" => $task
        ], 201, [], JSON_PRETTY_PRINT);
    }

    function updateTask(Request $request, $id) {
        $task = Task::where("id", $id)->first();

        if (!$task) {
            return response()->json([
                "message" => "Task does not exist"
            ], 404, [], JSON_PRETTY_PRINT);
        }
        
        $fields = $request->validate([
            "title" => "required",
            "description" => "required",
            "status" => "required"
        ]);

        $task->title = $fields["title"];
        $task->description = $fields["description"];
        $task->status = $fields["status"];
        $task->save();

        return response()->json([
            "message" => "Task has been updated",
            "data" => $task
        ], 200, [], JSON_PRETTY_PRINT);
    }

    function deleteTask($id) {
        $task = Task::where("id", $id)->first();

        if (!$task) {
            return response()->json([
                "message" => "Task does not exist"
            ], 404, [], JSON_PRETTY_PRINT);
        }

        $task->delete();
        return response()->json([
            "message" => "Task has been deleted"
        ], 200, [], JSON_PRETTY_PRINT);
    }
}
