<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UpdateProjectRequest;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Controllers\Controller;
use App\Models\Technology;
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
    $technologies = Technology::all();
    $selectedTechnologies = [];

    return view('admin.projects.create', compact('technologies', 'selectedTechnologies'));
}



    public function store(StoreProjectRequest $request, Project $projects)
    {

        $val_data = $request->validated();

        $slug = Project::generateSlug($val_data['title']);

        $val_data['slug'] = $slug;

        $project = Project::create($val_data);

        $technologies = $request->input('technologies', []);

        if (!empty($technologies)) {
            $project->technologies()->attach($technologies);
        }
    

        return to_route('admin.projects.index')->with('message', 'Project Created Successfully');
    }


    public function show(Project $projects)
    {
        $technologies = $projects->technologies;
        return view('admin.projects.show', compact('projects', 'technologies'));
    }


    public function edit(Project $project)
    {
        $types = Type::orderByDesc('id')->get();
        $technologies = Technology::all();
        $selectedTechnologies = $project->technologies()->pluck('id')->toArray();

        return view('admin.projects.edit', compact('project', 'types', 'technologies', 'selectedTechnologies'));
    }

    public function update(UpdateProjectRequest $request, Project $projects)
    {
        $val_data = $request->validated();

        $slug = Project::generateSlug($val_data['title']);

        $val_data['slug'] = $slug;

        $projects->update($val_data);

        $technologies = $request->input('technologies', []);

        $projects->technologies()->sync($technologies);

        return to_route('admin.projects.index')->with('message', 'Project: ' . $projects->title . 'Updated');
    }


    public function destroy(Project $projects)
    {

        $projects->delete();
        return to_route('admin.projects.index')->with('message', 'project:' . $projects->title . 'Deleted');
    }
}