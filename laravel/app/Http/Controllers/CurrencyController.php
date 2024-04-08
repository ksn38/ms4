<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use DateTime;
use DateInterval;
use Illuminate\Support\Facades\Redis;

class CurrencyController extends Controller
{
    public function currencies (Request $request) {
        function parser ($dif, $now) {
            $url = 'http://www.cbr.ru/scripts/XML_daily.asp';
            $dateNow = new DateTime();
            $dateAgo = $dateNow->sub(new DateInterval('P' . $dif . 'D'))->format("d/m/Y");
            $currency = explode('>', mb_convert_encoding(Http::get($url . '?date_req=' . $dateAgo)->body(), 'UTF-8', 'cp1251'));
            $dict_curr = [];
            $date_delta = $currency[1];

            $date_delta = preg_replace('/[^0-9.]/', '', $date_delta);

            for ($i = 0; $i < count($currency); $i++) {
                if ($currency[$i] == '<CharCode') {
                    $key = explode('<', $currency[$i + 1])[0];
                    $dict_curr[strval($key)] = floatval(explode('<', str_replace(',', '.', $currency[$i + 7]))[0]) / floatval(explode('<', $currency[$i + 3])[0]);
                }
            }
            return [$dict_curr, $date_delta];
        }
        $delta = 7;
        $delta1 = 365;
        $delta2 = 1460;
        $delta3 = 4018;

        $query_array = $request->query();

        if (array_key_exists('mybtn', $query_array)) {
            $delta = $query_array['mytextbox'];
            $delta1 = $query_array['mytextbox1'];
            $delta2 = $query_array['mytextbox2'];
            $delta3 = $query_array['mytextbox3'];
        }

        //print_r($query_array['mybtn']);

        function orderedArray($deltaVal) {
            $nowArr = parser(0, $now=True);
            $deltaArr = parser($deltaVal, $now=False);
            $orderDif = [];
            $keys = array_keys($nowArr[0]);
            $setCur = new \Ds\Set(['BYN', 'HUF', 'KGS', 'MDL', 'TJS', 'UZS', 'HKD', 'AZN', 'AMD', 'TMT', 'CZK', 'DKK', 
            'BGN', 'RON', 'RSD', 'GEL', 'NZD', 'THB', 'VND', 'AED', 'QAR', 'EGP', 'IDR']);
            
            foreach ($keys as $key) {
                if (!$setCur->contains($key)) {
                    if (array_key_exists($key, $deltaArr[0])) {
                        $orderDif[strval($key)] = round(($nowArr[0][strval($key)] / $deltaArr[0][strval($key)] - 1) * 100, 2);
                    } 
                }
            }

            arsort($orderDif);
            return [$orderDif, $deltaArr[1]];
        }

        $date_delta = orderedArray($delta)[1];
        $date_delta1 = orderedArray($delta1)[1];
        $date_delta2 = orderedArray($delta2)[1];
        $date_delta3 = orderedArray($delta3)[1];

        $dif_plus = orderedArray($delta)[0];
        $dif_plus1 = orderedArray($delta1)[0];
        $dif_plus2 = orderedArray($delta2)[0];
        $dif_plus3 = orderedArray($delta3)[0];

        return view('currencies', compact('date_delta', 'date_delta1', 'date_delta2', 'date_delta3', 'dif_plus', 'dif_plus1', 'dif_plus2', 'dif_plus3', 'delta', 'delta1', 'delta2', 'delta3'));
    }
    
}
