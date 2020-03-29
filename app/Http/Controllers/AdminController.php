<?php

namespace App\Http\Controllers;

use App\Item;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
//        echo 'admin page';

        return view('admin.index');
    }

    public function users()
    {
        $users = User::all()->where('id', '!=', auth()->id());
        return view('admin.users', [
            'users' => $users,
        ]);
    }

    public function showTasks($user_id)
    {
        $tasks = Item::withTrashed()
            ->where('user_id', $user_id)
            ->orderBy('deleted_at', 'asc')
            ->orderBy('status', 'asc')
            ->get();

        return view('admin.tasks', [
            'tasks' => $tasks,
        ]);
    }
}
