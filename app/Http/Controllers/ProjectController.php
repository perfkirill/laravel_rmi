<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_projects = Project::where("user_id",Auth::user()->id)->get();

        return view('projects',['user_projects' => $user_projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('project_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required'
        ],[
            'name.required' => 'Название проекта обязательно!',
        ]);





        $project = new Project();

        $project->name = $request->name;
        $project->user_id = $request->user_id;
        $project->status = 1;


        $project->save();

        return redirect()->route('projects');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {



        $project_info = Project::where("user_id",Auth::user()->id)->where("id",$project->id)->get();


        return view('project',['project_info' => $project_info]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {

        $project = Project::find($project->id);

        return view("project_edit",['project_info' => $project]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {

        $validated = $request->validate([
            'name' => 'required'
        ],[
            'name.required' => 'Название проекта обязательно!',
        ]);

        $project_edit = Project::find($project->id);

        $project_edit->name = $request->name;

        $project_edit->save();

        return view('project',['project_info' => array($project_edit)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $projectDelete = Project::find($project->id);
        $projectDelete->delete();
        return Redirect::route("projects");

    }
}
