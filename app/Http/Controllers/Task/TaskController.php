<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function __construct(protected TaskService $taskService){}

    public function getTasks(){
        return $this->taskService->getTasks();
    }

    public function createTask(Request $request){
        return $this->taskService->createTask($request);
    }

    public function getTaskById($id){
        return $this->taskService->getTaskById($id);
    }

    public function updateTask(Request $request , $id){
        return $this->taskService->updateTask($request , $id);
    }

    public function deleteTask($id){
        return $this->taskService->deleteTask($id);
    }

    public function restore($id){
        return $this->taskService->restore($id);
    }

    public function getDeletedTasks(){
        return $this->taskService->getDeletedTasks();
    }

    public function forceDelete($id){
        return $this->taskService->forceDelete($id);
    }

    public function changeTaskStatus($id){
        return $this->taskService->changeTaskStatus($id);
    }
}
