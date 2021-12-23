<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CurrencyController extends Controller
{
    public function currincies () {
        public function parser () {
            $url = 'http://www.cbr.ru/scripts/XML_daily.asp';
            $dateNow = new DateTime();
            $dateAgo = $dateNow->sub(new DateInterval('P' . '10' . 'D'))->format("d/m/Y");
        }
    }
    explode('>', mb_convert_encoding(Http::get('http://www.cbr.ru/scripts/XML_daily.asp')->body(), 'UTF-8', 'cp1251'));
}
