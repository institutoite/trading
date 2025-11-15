<?php
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlueRateController;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'welcome']);
Route::post('/actualizar-blue-rate', [BlueRateController::class, 'manualUpdate']);
Route::post('/snapshot-blue-rate', [BlueRateController::class, 'snapshot']);

// Ruta de diagnóstico para probar APIs
Route::get('/probe-blue', [BlueRateController::class, 'probe']);

Route::get('/debug/airtm', function () {
    $r = Http::timeout(12)->withOptions([
        'verify' => filter_var(env('BLUE_HTTP_VERIFY', false), FILTER_VALIDATE_BOOLEAN),
    ])->get('https://rates.airtm.io/');
    return response($r->body(), $r->status())->header(
        'Content-Type',
        $r->header('Content-Type', 'application/json')
    );
});

Route::get('/debug/airtm/pretty', function () {
    $r = Http::timeout(12)->withOptions([
        'verify' => filter_var(env('BLUE_HTTP_VERIFY', false), FILTER_VALIDATE_BOOLEAN),
    ])->get('https://rates.airtm.io/');
    $json = $r->ok() ? $r->json() : ['status'=>$r->status(),'body'=>$r->body()];
    return response()->json($json, 200, [], JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
});