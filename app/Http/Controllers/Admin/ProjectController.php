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
        $types = $request->input('types', []);

        if (!empty($types)) {
            $project->types()->attach($types);
        }
    

        return to_route('admin.projects.index')->with('message', 'Project Created Successfully');
    }


    public function show(Project $projects)
    {   $types = $projects->type;
        $technologies = $projects->technologies;
        return view('admin.projects.show', compact('projects', 'technologies','types'));
    }


    public function edit(Project $projects)
    {
        $types = Type::orderByDesc('id')->get();
        $technologies = Technology::all();
        $selectedTechnologies = $projects->technologies()->pluck('id')->toArray();

        return view('admin.projects.edit', compact('projects', 'types', 'technologies', 'selectedTechnologies'));
    }

    public function update(UpdateProjectRequest $request, Project $projects)
    {
        $val_data = $request->validated();

        $slug = Project::generateSlug($val_data['title']);

        $val_data['slug'] = $slug;

        $projects->update($val_data);

        $technologies = $request->input('technologies', []);

        $projects->technologies()->sync($technologies);
        
        $types = $request->input('types', []);

        $projects->type()->associate($types);

        return to_route('admin.projects.index')->with('message', 'Project: ' . $projects->title . 'Updated');
    }


    public function destroy(Project $projects)
    {

        $projects->delete();
        return to_route('admin.projects.index')->with('message', 'project:' . $projects->title . 'Deleted');
    }
}