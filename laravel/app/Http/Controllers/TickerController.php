<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis; 

class TickerController extends Controller
{
    public function index() {
        $chartTickers = DB::select('(select mt2.id, 
        round((mt.tnx/mt2.tnx - 1) * 10000)/100 as dif_tnx,
        round((mt.gspc/mt2.gspc - 1) * 10000)/100 as dif_gspc,
        round((mt.ixic/mt2.ixic - 1) * 10000)/100 as dif_ixic,
        round((mt.rut/mt2.rut - 1) * 10000)/100 as dif_rut, 
        round((mt.gdaxi/mt2.gdaxi - 1) * 10000)/100 as dif_gdaxi,
        round((mt.ss/mt2.ss - 1) * 10000)/100 as dif_ss,
        round((mt.sz/mt2.sz - 1) * 10000)/100 as dif_sz, 
        round((mt.bvsp/mt2.bvsp - 1) * 10000)/100 as dif_bvsp,
        round((mt.bsesn/mt2.bsesn - 1) * 10000)/100 as dif_bsesn,
        round((mt.wheat/mt2.wheat - 1) * 10000)/100 as dif_wheat, 
        round((mt.wti/mt2.wti - 1) * 10000)/100 as dif_wti,
        round((mt.cop/mt2.cop - 1) * 10000)/100 as dif_cop,
        round((mt.gold/mt2.gold - 1) * 10000)/100 as dif_gold,
        round((mt.vix/mt2.vix - 1) * 10000)/100 as dif_vix
        from tickers mt
        left join tickers mt2 on mt2.id = mt.id - 1 
        where mt.id = (select max(mt.id) from tickers mt))
        union
        (select mt2.id, 
        round((mt.tnx/mt2.tnx - 1) * 10000)/100 as dif_tnx,
        round((mt.gspc/mt2.gspc - 1) * 10000)/100 as dif_gspc,
        round((mt.ixic/mt2.ixic - 1) * 10000)/100 as dif_ixic,
        round((mt.rut/mt2.rut - 1) * 10000)/100 as dif_rut, 
        round((mt.gdaxi/mt2.gdaxi - 1) * 10000)/100 as dif_gdaxi,
        round((mt.ss/mt2.ss - 1) * 10000)/100 as dif_ss,
        round((mt.sz/mt2.sz - 1) * 10000)/100 as dif_sz, 
        round((mt.bvsp/mt2.bvsp - 1) * 10000)/100 as dif_bvsp,
        round((mt.bsesn/mt2.bsesn - 1) * 10000)/100 as dif_bsesn,
        round((mt.wheat/mt2.wheat - 1) * 10000)/100 as dif_wheat, 
        round((mt.wti/mt2.wti - 1) * 10000)/100 as dif_wti,
        round((mt.cop/mt2.cop - 1) * 10000)/100 as dif_cop,
        round((mt.gold/mt2.gold - 1) * 10000)/100 as dif_gold,
        round((mt.vix/mt2.vix - 1) * 10000)/100 as dif_vix
        from tickers mt
        left join tickers mt2 on mt2.id = mt.id - 5
        where mt.id = (select max(mt.id) from tickers mt))
        union
        (select mt2.id, 
        round((mt.tnx/mt2.tnx - 1) * 10000)/100 as dif_tnx,
        round((mt.gspc/mt2.gspc - 1) * 10000)/100 as dif_gspc,
        round((mt.ixic/mt2.ixic - 1) * 10000)/100 as dif_ixic,
        round((mt.rut/mt2.rut - 1) * 10000)/100 as dif_rut, 
        round((mt.gdaxi/mt2.gdaxi - 1) * 10000)/100 as dif_gdaxi,
        round((mt.ss/mt2.ss - 1) * 10000)/100 as dif_ss,
        round((mt.sz/mt2.sz - 1) * 10000)/100 as dif_sz, 
        round((mt.bvsp/mt2.bvsp - 1) * 10000)/100 as dif_bvsp,
        round((mt.bsesn/mt2.bsesn - 1) * 10000)/100 as dif_bsesn,
        round((mt.wheat/mt2.wheat - 1) * 10000)/100 as dif_wheat, 
        round((mt.wti/mt2.wti - 1) * 10000)/100 as dif_wti,
        round((mt.cop/mt2.cop - 1) * 10000)/100 as dif_cop,
        round((mt.gold/mt2.gold - 1) * 10000)/100 as dif_gold,
        round((mt.vix/mt2.vix - 1) * 10000)/100 as dif_vix
        from tickers mt
        left join tickers mt2 on mt2.id = mt.id - 20
        where mt.id = (select max(mt.id) from tickers mt))union
        (select mt2.id, 
        round((mt.tnx/mt2.tnx - 1) * 10000)/100 as dif_tnx,
        round((mt.gspc/mt2.gspc - 1) * 10000)/100 as dif_gspc,
        round((mt.ixic/mt2.ixic - 1) * 10000)/100 as dif_ixic,
        round((mt.rut/mt2.rut - 1) * 10000)/100 as dif_rut, 
        round((mt.gdaxi/mt2.gdaxi - 1) * 10000)/100 as dif_gdaxi,
        round((mt.ss/mt2.ss - 1) * 10000)/100 as dif_ss,
        round((mt.sz/mt2.sz - 1) * 10000)/100 as dif_sz, 
        round((mt.bvsp/mt2.bvsp - 1) * 10000)/100 as dif_bvsp,
        round((mt.bsesn/mt2.bsesn - 1) * 10000)/100 as dif_bsesn,
        round((mt.wheat/mt2.wheat - 1) * 10000)/100 as dif_wheat, 
        round((mt.wti/mt2.wti - 1) * 10000)/100 as dif_wti,
        round((mt.cop/mt2.cop - 1) * 10000)/100 as dif_cop,
        round((mt.gold/mt2.gold - 1) * 10000)/100 as dif_gold,
        round((mt.vix/mt2.vix - 1) * 10000)/100 as dif_vix
        from tickers mt
        left join tickers mt2 on mt2.id = mt.id - 50 
        where mt.id = (select max(mt.id) from tickers mt))
        union
        (select mt2.id, 
        round((mt.tnx/mt2.tnx - 1) * 10000)/100 as dif_tnx,
        round((mt.gspc/mt2.gspc - 1) * 10000)/100 as dif_gspc,
        round((mt.ixic/mt2.ixic - 1) * 10000)/100 as dif_ixic,
        round((mt.rut/mt2.rut - 1) * 10000)/100 as dif_rut, 
        round((mt.gdaxi/mt2.gdaxi - 1) * 10000)/100 as dif_gdaxi,
        round((mt.ss/mt2.ss - 1) * 10000)/100 as dif_ss,
        round((mt.sz/mt2.sz - 1) * 10000)/100 as dif_sz, 
        round((mt.bvsp/mt2.bvsp - 1) * 10000)/100 as dif_bvsp,
        round((mt.bsesn/mt2.bsesn - 1) * 10000)/100 as dif_bsesn,
        round((mt.wheat/mt2.wheat - 1) * 10000)/100 as dif_wheat, 
        round((mt.wti/mt2.wti - 1) * 10000)/100 as dif_wti,
        round((mt.cop/mt2.cop - 1) * 10000)/100 as dif_cop,
        round((mt.gold/mt2.gold - 1) * 10000)/100 as dif_gold,
        round((mt.vix/mt2.vix - 1) * 10000)/100 as dif_vix
        from tickers mt
        left join tickers mt2 on mt2.id = mt.id - 100 
        where mt.id = (select max(mt.id) from tickers mt))
        union
        (select mt2.id, 
        round((mt.tnx/mt2.tnx - 1) * 10000)/100 as dif_tnx,
        round((mt.gspc/mt2.gspc - 1) * 10000)/100 as dif_gspc,
        round((mt.ixic/mt2.ixic - 1) * 10000)/100 as dif_ixic,
        round((mt.rut/mt2.rut - 1) * 10000)/100 as dif_rut, 
        round((mt.gdaxi/mt2.gdaxi - 1) * 10000)/100 as dif_gdaxi,
        round((mt.ss/mt2.ss - 1) * 10000)/100 as dif_ss,
        round((mt.sz/mt2.sz - 1) * 10000)/100 as dif_sz, 
        round((mt.bvsp/mt2.bvsp - 1) * 10000)/100 as dif_bvsp,
        round((mt.bsesn/mt2.bsesn - 1) * 10000)/100 as dif_bsesn,
        round((mt.wheat/mt2.wheat - 1) * 10000)/100 as dif_wheat, 
        round((mt.wti/mt2.wti - 1) * 10000)/100 as dif_wti,
        round((mt.cop/mt2.cop - 1) * 10000)/100 as dif_cop,
        round((mt.gold/mt2.gold - 1) * 10000)/100 as dif_gold,
        round((mt.vix/mt2.vix - 1) * 10000)/100 as dif_vix
        from tickers mt
        left join tickers mt2 on mt2.id = mt.id - 250 
        where mt.id = (select max(mt.id) from tickers mt))
        union
        (select mt2.id, 
        round((mt.tnx/mt2.tnx - 1) * 10000)/100 as dif_tnx,
        round((mt.gspc/mt2.gspc - 1) * 10000)/100 as dif_gspc,
        round((mt.ixic/mt2.ixic - 1) * 10000)/100 as dif_ixic,
        round((mt.rut/mt2.rut - 1) * 10000)/100 as dif_rut, 
        round((mt.gdaxi/mt2.gdaxi - 1) * 10000)/100 as dif_gdaxi,
        round((mt.ss/mt2.ss - 1) * 10000)/100 as dif_ss,
        round((mt.sz/mt2.sz - 1) * 10000)/100 as dif_sz, 
        round((mt.bvsp/mt2.bvsp - 1) * 10000)/100 as dif_bvsp,
        round((mt.bsesn/mt2.bsesn - 1) * 10000)/100 as dif_bsesn,
        round((mt.wheat/mt2.wheat - 1) * 10000)/100 as dif_wheat, 
        round((mt.wti/mt2.wti - 1) * 10000)/100 as dif_wti,
        round((mt.cop/mt2.cop - 1) * 10000)/100 as dif_cop,
        round((mt.gold/mt2.gold - 1) * 10000)/100 as dif_gold,
        round((mt.vix/mt2.vix - 1) * 10000)/100 as dif_vix
        from tickers mt
        left join tickers mt2 on mt2.id = mt.id - 1000 
        where mt.id = (select max(mt.id) from tickers mt))
        union
        (select mt2.id, 
        round((mt.tnx/mt2.tnx - 1) * 10000)/100 as dif_tnx,
        round((mt.gspc/mt2.gspc - 1) * 10000)/100 as dif_gspc,
        round((mt.ixic/mt2.ixic - 1) * 10000)/100 as dif_ixic,
        round((mt.rut/mt2.rut - 1) * 10000)/100 as dif_rut, 
        round((mt.gdaxi/mt2.gdaxi - 1) * 10000)/100 as dif_gdaxi,
        round((mt.ss/mt2.ss - 1) * 10000)/100 as dif_ss,
        round((mt.sz/mt2.sz - 1) * 10000)/100 as dif_sz, 
        round((mt.bvsp/mt2.bvsp - 1) * 10000)/100 as dif_bvsp,
        round((mt.bsesn/mt2.bsesn - 1) * 10000)/100 as dif_bsesn,
        round((mt.wheat/mt2.wheat - 1) * 10000)/100 as dif_wheat, 
        round((mt.wti/mt2.wti - 1) * 10000)/100 as dif_wti,
        round((mt.cop/mt2.cop - 1) * 10000)/100 as dif_cop,
        round((mt.gold/mt2.gold - 1) * 10000)/100 as dif_gold,
        round((mt.vix/mt2.vix - 1) * 10000)/100 as dif_vix
        from tickers mt
        left join tickers mt2 on mt2.id = mt.id - 5000 
        where mt.id = (select max(mt.id) from tickers mt))
        order by id desc;');

        $tickers5000 = DB::select('select * from tickers mt where id > (select max(id) from tickers mt2) - 5000');
        //print_r($tickers5000);
        Redis::set('tickers5000', $tickers5000);

        return view('index', compact('chartTickers', 'tickers5000'));
    }
}
