<?php
namespace App\Services;

use App\Http\Resources\Task\TaskResource;
use App\Models\Task\Task;

class TaskService{
    public function getTasks(){
        $tasks =  Task::orderByDesc('id')->get();
        return TaskResource::collection($tasks);
    }

    public function createTask($request){
        $task = Task::create(
            ['title' => $request->title ?? '',
            'description' => $request->description ?? '',
            'status' => 0 ?? '',
            'catogry_id' => $request->catogry_id ?? '',
            ]
        );
        return response()->json(['message' => 'Task created successfully',
         'task' => $task],
          200);
    }

    public function getTaskById($id){
        $task = Task::find($id);
        return new TaskResource($task);
    }

    public function updateTask($request , $id){
        $task = Task::find($id);
        $task->update(
            ['title' => $request->title ?? '',
            'description' => $request->description ?? '',
            'catogry_id' => $request->catogry_id ?? '',]
        );
        return response()->json(['message' => 'Task updated successfully',
         'task' => $task],
          200);
    }

    public function deleteTask($id){
        $task = Task::find($id);
        if(!$task){
            return response()->json(['message' => 'Task not found'],
             404);
        }
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully',
         'task' => $task],
          200);
    }

    public function restore($id)
    {
        $task = Task::withTrashed()->findOrFail($id);  // Ensure it fetches even soft-deleted categories
        if ($task) {
            $task->restore();
            return response()->json([
                'message' => 'Task restored successfully'
            ], 200);
        }

        return response()->json([
            'message' => 'Task not found'
        ], 404);
    }

    public function getDeletedTasks(){
        $deletedTasks = Task::onlyTrashed()->get();
        return TaskResource::collection($deletedTasks);
    }

    public function forceDelete($id){
        $task = Task::withTrashed()->findOrFail($id);
        $task->forceDelete();
        return response()->json([
            'message' => 'Task deleted permanently'
        ], 200);
    }

    public function changeTaskStatus($id){
        $task = Task::find($id);
        $task->status = $task->status == 0 ? 1 : ($task->status == 1 ? 2 : 0);
        $task->save();
        return response()->json(['message' => 'Task status updated successfully',
         'task' => $task],
          200);
    }
}
