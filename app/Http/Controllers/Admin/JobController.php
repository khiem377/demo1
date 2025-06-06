<?php
namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::paginate(10);
        return view('admin.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('admin.jobs.create');
    }
    public function show($id)
{
    $job = Job::findOrFail($id);
    return view('admin.jobs.show', compact('job'));
}


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'type' => 'required|in:fulltime,parttime',
            'description' => 'nullable|string',
            'salary' => 'nullable|string|max:255',
            'deadline' => 'nullable|date',
        ]);

        Job::create($request->all());

        return redirect()->route('admin.jobs.index')->with('success', 'Job created successfully');
    }

    public function edit(Job $job)
    {
        return view('admin.jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'type' => 'required|in:fulltime,parttime',
            'description' => 'nullable|string',
            'salary' => 'nullable|string|max:255',
            'deadline' => 'nullable|date',
        ]);

        $job->update($request->all());

        return redirect()->route('admin.jobs.index')->with('success', 'Job updated successfully');
    }

    public function destroy(Job $job)
    {
        $job->delete();

        return redirect()->route('admin.jobs.index')->with('success', 'Job deleted successfully');
    }
}
