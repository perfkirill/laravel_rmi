<?php

namespace App\Http\Controllers;

use App\Exports\SemanticCoreKeysExport;
use App\Models\Project;
use App\Models\SemanticCore;
use App\Models\SemanticCoreKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;


class SemanticCoreKeyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($project,$score)
    {
        $project_info = Project::where("user_id",Auth::user()->id)->where("id",$project)->get();

        $score_arr = SemanticCore::find($score);

        $semantic_core_keys = SemanticCoreKey::where("semantic_core_id",$score)->get();



        return view('semantic_core_keys',['semantic_core_keys' => $semantic_core_keys,'project_info' => $project_info,'semantic_core_id' => $score, 'semantic_core_info'=> $score_arr]);

    }

    public function export($semantic_core_id)
    {

        return Excel::download(new SemanticCoreKeysExport($semantic_core_id), 'SemanticCoreKeysExport.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $project_id, $semntic_core_id)
    {
        $validated = $request->validate([
            'keys' => 'required'
        ],[
            'keys.required' => 'Введите ключи',
        ]);

        $arr_keys = explode(PHP_EOL, $request->keys);
        foreach ($arr_keys as $arr_key){

            $semanticKey = new SemanticCoreKey();

            $semanticKey->semantic_core_id = $semntic_core_id;
            $semanticKey->name = $arr_key;
            $semanticKey->type = $request->type;


            $semanticKey->save();

        }

        return Redirect::back()->withErrors(['msg' => 'Ключи добавлены']);



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SemanticCoreKey  $semanticCoreKey
     * @return \Illuminate\Http\Response
     */
    public function show(SemanticCoreKey $semanticCoreKey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SemanticCoreKey  $semanticCoreKey
     * @return \Illuminate\Http\Response
     */
    public function edit(SemanticCoreKey $semanticCoreKey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SemanticCoreKey  $semanticCoreKey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SemanticCoreKey $semanticCoreKey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SemanticCoreKey  $semanticCoreKey
     * @return \Illuminate\Http\Response
     */
    public function destroy(SemanticCoreKey $semanticCoreKey, $project, $score, $keyid)
    {
        $semanticCoreKeymodel = SemanticCoreKey::find($keyid);
        SemanticCoreKey::destroy($keyid);
        return Redirect::back()->withErrors(['msg' => "Ключ ".$semanticCoreKeymodel->name." удален"]);
    }
}
