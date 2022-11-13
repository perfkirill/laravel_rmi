<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($project)
    {

        $project_info = Project::where("user_id",Auth::user()->id)->where("id",$project)->get();
        $projectTask = Project::find($project)->projectTasks;



        return view('tasks',['project_tasks' => $projectTask,'project_info' => $project_info]);
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
    public function store(Request $request, $project_id)
    {

        $validated = $request->validate([
            'title' => 'required',
            'deadline_date' => 'date'
        ],[
            'title.required' => 'Название задачи обязательно!',
        ]);







        $task = new Task();
        $user_id = Auth::user()->id;
        $task->title = $request->title;
        $task->project_id = $project_id;
        $task->user_id = $user_id;
        $task->status = 1;
        $task->deadline_date = $request->deadline_date;;


        $task->save();

        return redirect()->route('tasks',$project_id);


    }


    public function deadline(){

        $today = date("Y-m-d");

        $tasks = Task::where("deadline_date",$today)->where("status",1)->get();


        if(count($tasks)){

            $i = 0;
            foreach ($tasks as $task){

                $mailer_arr[$task->getUser['email']][$i]['task'] = $task->title;
                $mailer_arr[$task->getUser['email']][$i]['project'] = $task->getProject['name'];
                $i++;
            }


            foreach($mailer_arr as $to_email=>$tasks_info) {
                $to_name = 'TO_NAME';
                Mail::send('email_view', ['tasks_info' => $tasks_info], function($message) use ($to_name, $to_email) {
                    $message->from('perfkirill@yandex.ru', 'Sender');
                    $message->to($to_email, $to_name)->subject('Задания на сегодня');
                });

            }

            echo "<pre>";
            print_r($mailer_arr);




        }
        else{
            echo "Просроченных задач нет";
        }








    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $project_id, Task $task)
    {
        //

        $task->status = 0;
        $task->save();

        return redirect()->route('tasks',$project_id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
