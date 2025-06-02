<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $applications = Application::latest()->get();
        return view('admin.applications.index', compact('applications'));
    }

    public function show($id)
    {
        $application = Application::findOrFail($id);
        return view('admin.applications.show', compact('application'));
    }
}
