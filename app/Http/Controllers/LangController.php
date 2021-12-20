<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LangController extends Controller
{
    public function hh() {
        $langs = DB::select('select distinct id, name, val, val_noexp, res_vac, 
        (row_number() over(order by val desc) + rank() over(order by val_noexp desc) + row_number() over(order by res_vac)) as rate
        from langs ml where ml.date_added = current_date order by rate;');
        return view('langs.hh', compact('langs'));
    }
}
