<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    function index() {
        $categories = Category::all();
        $users = User::all();
        $roles = Role::all();
        return view('pages.back_office.dashboard', [
            "categories" => $categories,
            "users" => $users,
            "roles" => $roles,
        ]);
    }
}
