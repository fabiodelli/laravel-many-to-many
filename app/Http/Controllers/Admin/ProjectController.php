<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UpdateProjectRequest;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderByDesc('id')->paginate(8);

        return view('admin.projects.index', compact('projects'));
    }


    public function create()
    {
        return view('admin.projects.create');
    }


    public function store(StoreProjectRequest $request)
    {

        $val_data = $request->validated();

        $slug = Project::generateSlug($val_data['title']);

        $val_data['slug'] = $slug;

        Project::create($val_data);

        return to_route('admin.projects.index')->with('message', 'Project Created Successfully');
    }


    public function show(Project $projects)
    {
        //dd($projects->slug);
        return view('admin.projects.show', compact('projects'));
    }


    public function edit(Project $project)
    {
        $types = Type::orderByDesc('id')->get();
        return view('admin.projects.edit',compact('project','types'));
    }


    public function update(UpdateProjectRequest $request, Project $project)
    {
        $val_data = $request->validated();

        $slug = Project::generateSlug($val_data['title']);
        
        $val_data['slug'] = $slug;
        
        $project->update($val_data);

        return to_route('admin.projects.index')->with('message', 'Project: ' . $project->title . 'Updated');
    }


    public function destroy(Project $project)
    {
        $project -> delete();
        return to_route('admin.projects.index')->with('message','project:' . $project -> title. 'Deleted');
    }
}