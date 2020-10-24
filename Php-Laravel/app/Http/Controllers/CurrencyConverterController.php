<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Alcohol\ISO4217;
use View;

class CurrencyConverterController extends Controller
{

    public function convert(Request $request)
	{
		$client = new CLient();
		$iso4217 = new ISO4217();

		$fromCode = $request->input('fromCode');
		$toCode = $request->input('toCode');
		$amount = $request->input('amount');

		$res = $client->get('https://api.exchangeratesapi.io/latest?base=INR');
		$result = json_decode($res->getBody(), true);

		foreach ($result['rates'] as $key => $value) {
		 $details = $iso4217->getByAlpha3($key);
		 $currencyCodes[$key] = $details['name'];
		}

		$uri = "https://api.exchangeratesapi.io/latest?base=" . $fromCode . "&symbols=" . $toCode;
		$res = $client->get($uri);
		$result = json_decode($res->getBody(), true);

		$fromUnitPrice = "1 " . $fromCode;
		$toPrice = number_format((float)$result['rates'][$toCode], 2, '.', '');

		$toUnitPrice = $toPrice . " " . $toCode;
		$convertedPrice = $amount . " " . $iso4217->getByAlpha3($fromCode)['name'] . " equals to " . $amount * $toPrice . " " . $iso4217->getByAlpha3($toCode)['name'];

        $data=array('currencyCodes'=>$currencyCodes, 'action'=>'Y', 'fromUnitPrice'=>$fromUnitPrice, 'toUnitPrice'=>$toUnitPrice, 'convertedPrice'=>$convertedPrice);

		return View::make("index")->with($data);
	}
}