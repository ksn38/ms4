<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CurrencyController extends Controller
{
    public function currencies () {
        function parser ($dif, $now) {
            $url = 'http://www.cbr.ru/scripts/XML_daily.asp';
            $dateNow = new DateTime();
            $dateAgo = $dateNow->sub(new DateInterval('P' . $dif . 'D'))->format("d/m/Y");
            $currency = explode('>', mb_convert_encoding(Http::get($url . '?date_req=' . $dateAgo)->body(), 'UTF-8', 'cp1251'));
            $dict_curr = [];
            $date_delta = currency[1];

            if ($now != True) {
                $date_delta = preg_replace('[^0-9.]', '', $date_delta);
            };

            for ($i = 0; $i < count($currency); $i++) {
                if ($currency[$i] == '<CharCode') {
                    $key = explode('<', $currency[$i + 1])[0];
                    $dict_curr[strval($key)] = floatval(explode('<', str_replace(',', '.', $currency[$i + 7]))[0]) / floatval(explode('<', $currency[$i + 3])[0]);
                };
            };
            return [$dict_curr, $date_delta];
        }
        $delta = 7;
        $delta1 = 365;
        $delta2 = 1460;
        $delta3 = 4018;

        /*if(request.GET.get('mybtn')):
            delta = (int(request.GET.get('mytextbox')))
            delta1 = (int(request.GET.get('mytextbox1')))
            delta2 = (int(request.GET.get('mytextbox2')))
            delta3 = (int(request.GET.get('mytextbox3')))*/

        function ordered_array($delta_val) {
            $now = parser(0, $now=True);
            $delta = parser($delta_val, $now=False);
            $order_dif = [];
            
            for key in now[0].keys():
                if key not in {'BYN', 'HUF', 'KGS', 'MDL', 'TJS', 'UZS', 'HKD', 'AZN', 'AMD', 'TMT', 'CZK', 'DKK', 'BGN', 'RON'}:
                    try:
                        order_dif[key] = round((now[0][key] / delta[0][key] - 1) * 100, 2)
                    except KeyError:
                        pass
            
            order_dif_plus = OrderedDict(sorted(order_dif.items(), key=lambda item: item[1], reverse=True))

            return order_dif_plus.items(), delta[1]
        }

        $date_delta = '0';
        $date_delta1 = '0';
        $date_delta2 = '0';
        $date_delta3 = '0';

        $dif_plus = [['name' => '0', 'value'=>'1'], ['name' => '2', 'value'=>'3']];
        $dif_plus1 = [['name' => 'bob', 'value'=>'1'], ['name' => 'max', 'value'=>'3']];
        $dif_plus2 = [['name' => 'bob', 'value'=>'1'], ['name' => 'max', 'value'=>'3']];
        $dif_plus3 = [['name' => 'bob', 'value'=>'1'], ['name' => 'max', 'value'=>'3']];

        return view('currencies', compact('date_delta', 'date_delta1', 'date_delta2', 'date_delta3', 'dif_plus', 'dif_plus1', 'dif_plus2', 'dif_plus3', 'delta', 'delta1', 'delta2', 'delta3'));
    }
    
}
