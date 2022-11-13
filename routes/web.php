<?php

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('/dashboard/projects', [\App\Http\Controllers\ProjectController::class,'index'])->middleware(['auth'])->name("projects");
Route::get('/dashboard/projects/new', [\App\Http\Controllers\ProjectController::class,'create'])->middleware(['auth'])->name("createProjects");
Route::post('/dashboard/projects/new/store', [\App\Http\Controllers\ProjectController::class,'store'])->middleware(['auth'])->name("storeProjects");
Route::get('/dashboard/project/{project}', [\App\Http\Controllers\ProjectController::class,'show'])->middleware(['auth'])->name("showProjects");
Route::get('/dashboard/projects/{project}/edit', [\App\Http\Controllers\ProjectController::class,'edit'])->middleware(['auth'])->name("editProject");
Route::post('/dashboard/projects/{project}', [\App\Http\Controllers\ProjectController::class,'update'])->middleware(['auth'])->name("updateProject");
Route::get('/dashboard/projects/{project}/delete', [\App\Http\Controllers\ProjectController::class,'destroy'])->middleware(['auth'])->name("deleteProject");

Route::get('/dashboard/project/{project}/tasks', [\App\Http\Controllers\TaskController::class,'index'])->middleware(['premium'])->name("tasks");

Route::post('/dashboard/project/{project}/tasks/store', [\App\Http\Controllers\TaskController::class,'store'])->middleware(['auth'])->name("storeTask");
Route::put('/dashboard/project/{project}/tasks/edit/{task}', [\App\Http\Controllers\TaskController::class,'update'])->middleware(['auth'])->name("TaskComplete");

Route::get('/dashboard/project/{project}/semantic_cores', [\App\Http\Controllers\SemanticCoreController::class,'index'])->middleware(['auth'])->name("semanticСores");
Route::get('/dashboard/project/{project}/semantic_cores/create', [\App\Http\Controllers\SemanticCoreController::class,'create'])->middleware(['auth'])->name("semanticСoresCreate");
Route::post('/dashboard/project/{project}/semantic_cores/store', [\App\Http\Controllers\SemanticCoreController::class,'store'])->middleware(['auth'])->name("semanticСoresStore");
Route::get('/dashboard/project/{project}/semantic_cores/{score}', [\App\Http\Controllers\SemanticCoreKeyController::class,'index'])->middleware(['auth'])->name("semanticСoreKeys");
Route::get('/dashboard/project/semantic_cores/{score}/export', [\App\Http\Controllers\SemanticCoreKeyController::class,'export'])->middleware(['auth'])->name("semanticСoreKeysExport");

Route::get('/dashboard/project/{project}/semantic_cores/{score}/deletekey-{keyid}', [\App\Http\Controllers\SemanticCoreKeyController::class,'destroy'])->middleware(['auth'])->name("semanticСoreKeyDelete");
Route::post('/dashboard/project/{project}/semantic_cores/{score}/store', [\App\Http\Controllers\SemanticCoreKeyController::class,'store'])->middleware(['auth'])->name("storeSemanticKeys");

Route::get('/dashboard/project/{project}/google-api', [\App\Http\Controllers\GoogleApiController::class,'index'])->middleware(['auth'])->name("googleapi");
Route::post('/dashboard/project/{project}/google-api/massindex', [\App\Http\Controllers\GoogleApiController::class,'massindex'])->middleware(['auth'])->name("googleapimassindex");
Route::post('/dashboard/project/{project}/google-api/store', [\App\Http\Controllers\GoogleApiController::class,'store'])->middleware(['auth'])->name("googleapistore");


Route::get('/dashboard/minus-generator', [\App\Http\Controllers\minusGenerator::class,'index'])->middleware(['auth'])->name("minusGenerator");
Route::post('/dashboard/minus-generator', [\App\Http\Controllers\minusGenerator::class,'generate'])->middleware(['auth'])->name("minusGeneratorProcess");

Route::get('/test', function () {

    // Сохранить часть данных в сессию ...
    session(['redbe' => 'redbe_agency']);
    $data = session()->all();

    print_r( $data);

});

Route::get('invoice', function (){

   // return view("export.invoice");

    $pdf = Pdf::loadView('export.invoice');

    return $pdf->download('invoice.pdf');

});


Route::get("/pages/show/{num1}",[\App\Http\Controllers\TestController::class,'showOne'])->where('num2', '[0-9]+')->where('num1', '[0-9]+');
Route::get("/pages/{id}",[\App\Http\Controllers\TestController::class,'showOne']);
Route::post("/pages/{id}",[\App\Http\Controllers\TestController::class,'formPiker'])->name("testFormPiker");


Route::get("/cron/tasks",[\App\Http\Controllers\TaskController::class,'deadline']);


Route::get("/curl",[\App\Http\Controllers\CurlController::class,'index']);

require __DIR__.'/auth.php';
