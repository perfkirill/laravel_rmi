<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\SemanticCore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SemanticCoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($project)
    {
        $project_info = Project::where("user_id",Auth::user()->id)->where("id",$project)->get();
        $semantic_cores = SemanticCore::where("project_id",$project)->with('seokeys')->get();



        return view('semantic_cores',['semantic_cores' => $semantic_cores,'project_info' => $project_info]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($project)
    {
           $project_info = Project::where("user_id",Auth::user()->id)->where("id",$project)->get();

        return view("semantic_core_create",['project_info' => $project_info]);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $project)
    {
        $validated = $request->validate([
            'category_name' => 'required'
        ],[
            'category_name.required' => 'Название проекта обязательно',
        ]);

        $semanticCore = new SemanticCore();

        $semanticCore->project_id = $project;
        $semanticCore->category_name = $request->category_name;

        $semanticCore->save();

        return Redirect::back()->withErrors(['msg' => 'Кластер создан']);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\semanticCore  $semanticCore
     * @return \Illuminate\Http\Response
     */
    public function show(semanticCore $semanticCore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\semanticCore  $semanticCore
     * @return \Illuminate\Http\Response
     */
    public function edit(semanticCore $semanticCore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\semanticCore  $semanticCore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, semanticCore $semanticCore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\semanticCore  $semanticCore
     * @return \Illuminate\Http\Response
     */
    public function destroy(semanticCore $semanticCore)
    {
        //
    }
}
