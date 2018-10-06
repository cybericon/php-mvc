<?php

namespace App\Controllers;

use Core\App;
use App\Models\Task;
use Core\Base\Controller;

class TasksController extends Controller
{

    public function index()
    {
        $tasks = Task::get();
        $this->view('tasks/index', compact('tasks'));
    }

    public function store()
    {
        $this->escape_html($_POST);

        Task::add($_POST);

        $this->redirect('/tasks');
    }

    public function show($args = [])
    {
        if (isset($args[0])) {
            $task = Task::find($args[0]);
            $this->view('tasks/show', compact('task'));
        } else {
            throw new \Exception("not found");
        }
    }

    public function delete()
    {
        Task::remove($_POST['id']);
        $this->redirect('/tasks');
    }

    public function update()
    {
        Task::edit(
            [
                "completed" => (int) $_POST['completed'],
                "id" => (int) $_POST['id'],
            ]
        );
        $this->redirect('/tasks');
    }
}
