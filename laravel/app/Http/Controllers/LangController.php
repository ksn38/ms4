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

        $langs2020 = DB::select('select distinct b.id, a."name", ((b.val - a.aval)*100/a.aval) as cnd_val, ((b.val_noexp - a.aval_noexp)*100/a.aval_noexp) as cnd_vn, 
        ((b.res_vac - a.ares_vac)*100/a.ares_vac)::integer as cnd_rv,
        (rank() over(order by  ((b.val - a.aval)*100/a.aval) desc) + 
        rank() over(order by ((b.val_noexp - a.aval_noexp)*100/a.aval_noexp) desc) + 
        rank() over(order by ((b.res_vac - a.ares_vac)*100/a.ares_vac)::integer)) as rate
        from mean a
        left join langs b on a."name"  = b."name" 
        where b.date_added = current_date order by rate;');

        $langs2021 = DB::select('select distinct b.id, a."name", ((b.val - a.aval)*100/a.aval) as cnd_val, ((b.val_noexp - a.aval_noexp)*100/a.aval_noexp) as cnd_vn, 
        ((b.res_vac - a.ares_vac)*100/a.ares_vac)::integer as cnd_rv,
        (rank() over(order by  ((b.val - a.aval)*100/a.aval) desc) + 
        rank() over(order by ((b.val_noexp - a.aval_noexp)*100/a.aval_noexp) desc) + 
        rank() over(order by ((b.res_vac - a.ares_vac)*100/a.ares_vac)::integer)) as rate
        from mean_2021 a
        left join  langs b on a."name"  = b."name" 
        where b.date_added = current_date order by rate;');

        $graphs = DB::select("select id, name, res_vac, date_added from langs l where name = 'Python' or name = 'Java' or name = 'Javascript' 
        or name = 'php' or name = 'cpp' order by date_added, name");

        $graphsAvg = DB::select("select distinct max(id) over(partition by date_added) as id, date_added, avg(val_noexp) over(partition by date_added) 
        as avg_vn, avg(res_vac) over(partition by date_added) as avg_rv from langs order by date_added");

        return view('hh', compact('langs', 'langs2020', 'langs2021', 'graphs', 'graphsAvg'));
    }
}
