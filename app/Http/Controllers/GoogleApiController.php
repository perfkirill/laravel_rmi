<?php

namespace App\Http\Controllers;

use App\Models\GoogleApi;
use App\Models\Project;
use App\Models\SemanticCore;
use App\Models\SemanticCoreKey;
use Google_Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class GoogleApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($project)
    {
        $project_info = Project::where("user_id",Auth::user()->id)->where("id",$project)->get();
        $urls = GoogleApi::where("project_id",$project)->get();



        $urls_counter = count($urls);

        return view("google_api",['project_info' => $project_info, 'urls' => $urls,'urls_counter'=>$urls_counter]);




    }


    public function massindex(Request $request)
    {

        if($request->url) {

            $data = [
                'result' => 'success',
                'url_to_response' => $request->url
            ];

            $url = $request->url;
            $action = "update";
            $type = $action == 'update' ? 'URL_UPDATED' : 'URL_DELETED';

            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                $data['result'] = 'error';
                $data['error'] = 'URL не является корректным.';
                echo json_encode($data);
                exit();
            }

            $client = new Google_Client();
            // api-project-696409.json - секретный ключ для доступа к API Google
            $client->setAuthConfig('google-index-service/php/api-project-696409.json');
            $client->addScope('https://www.googleapis.com/auth/indexing');
            $httpClient = $client->authorize();
            $endpoint = 'https://indexing.googleapis.com/v3/urlNotifications:publish';
            if ($action == 'get') {
                $response = $httpClient->get('https://indexing.googleapis.com/v3/urlNotifications/metadata?url=' . urlencode($url));
            } else {
                $content = json_encode([
                    'url' => $url,
                    'type' => $type
                ]);
                $response = $httpClient->post($endpoint, ['body' => $content]);
            }

            $data['body'] = (string)$response->getBody();

            if ($data['body']) {
                $result = json_decode($data['body'], true);

                if (!isset($result['error'])) {
                    $urlModel = GoogleApi::where('url', $url)->first();
                    $urlModel->delete();
                }
            }

            print_r($data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function print_arr($arr){
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }

    public function store(Request $request, $project)
    {
        $validated = $request->validate([
            'urls_to_db' => 'required'
        ],[
            'urls_to_db.required' => 'Вы не указали ссылки',
        ]);



        $arr_keys = explode("\r\n", $request->urls_to_db);

        $this->print_arr($arr_keys);

        foreach ($arr_keys as $arr_url){
            echo $arr_url;
            $googleApiProject = new GoogleApi();

            $googleApiProject->project_id = $project;
            $googleApiProject->url = $arr_url;

            $existurl = GoogleApi::where('url', $arr_url)->first();
            if(!$existurl){
            $googleApiProject->save();
            }


        }

        return Redirect::back()->withErrors(['msg' => 'URL добавлены']);

        /*
---
        $googleApiProject = new GoogleApi();

        $googleApiProject->project_id = $project;
        $googleApiProject->url = $request->category_name;

        $googleApiProject->save();

        return Redirect::back()->withErrors(['msg' => 'Кластер создан']);
*/

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GoogleApi  $googleApi
     * @return \Illuminate\Http\Response
     */
    public function show(GoogleApi $googleApi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GoogleApi  $googleApi
     * @return \Illuminate\Http\Response
     */
    public function edit(GoogleApi $googleApi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GoogleApi  $googleApi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GoogleApi $googleApi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GoogleApi  $googleApi
     * @return \Illuminate\Http\Response
     */
    public function destroy(GoogleApi $googleApi)
    {
        //
    }
}
