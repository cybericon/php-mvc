<?php

namespace App\Models;

use Core\App;
use Core\Database\Model;

class Task extends Model
{
    protected static $table = 'tasks';
    public $description;
    public $details;
    public $completed;
    public $id;

    public function addTask()
    {
        $details = $this->details;
        $description = $this->description;
        $this->add(compact('description', 'details'));
    }

    public static function allTasks()
    {
        return static::get();
    }

    public function isComplete($id)
    {
        //
    }

    public function showTask($id)
    {
        return static::find($id);
    }
}
