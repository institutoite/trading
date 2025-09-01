


<?php
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
Route::post('/actualizar-blue-rate', function(Request $request) {
	try {
		Artisan::call('blue-rate:update');
		return response()->json(['success' => true]);
	} catch (\Exception $e) {
		return response()->json(['success' => false, 'error' => $e->getMessage()]);
	}
});