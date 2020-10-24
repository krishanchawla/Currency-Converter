<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurrencyConverterController;

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
	$client = new GuzzleHttp\Client();
	$iso4217 = new Alcohol\ISO4217();

	$res = $client->get('https://api.exchangeratesapi.io/latest?base=INR');
	$result = json_decode($res->getBody(), true);

	foreach ($result['rates'] as $key => $value) {
	 $details = $iso4217->getByAlpha3($key);
	 $currencyCodes[$key] = $details['name'];
	}

	$data=array('currencyCodes'=>$currencyCodes);
    return View::make("index")->with($data);
});

Route::post('/', [CurrencyConverterController::class, 'convert']);