<?php

namespace App\Http\Controllers;

class TasksController extends Controller
{
    public function show()
    {
        return view('screens.tasks.show');
    }
}
