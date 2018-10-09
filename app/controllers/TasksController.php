<?php

namespace App\Controllers;

use Core\App;
use App\Models\Task;
use Core\Base\Request;
use Core\Base\Controller;

class TasksController extends Controller
{

    public function index()
    {
        $tasks = Task::allTasks();
        $this->view('tasks/index', compact('tasks'));
    }

    public function store()
    {
        $task = new Task();

        $task->addProperties(
            [
                'description' => Request::get('description'),
                'details' => Request::get('details'),
            ]
        );

        $task->addTask();

        $this->redirect('/tasks');
    }

    public function show($id)
    {
        $task = new Task();
        $task = $task->showTask($id);

        $this->view('tasks/show', compact('task'));
    }

    public function delete()
    {
        Task::remove(Request::get('id'));
        $this->redirect('/tasks');
    }

    public function update()
    {
        $fillable = ["description", "details", "completed"];

        Task::edit($fillable);
        $this->redirect('/tasks');
    }
}
