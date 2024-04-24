<?php
use Illuminate\Contracts\Console\Kernel;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Support\Facades\Config;

$capsule = new Capsule;
$capsule->addConnection(Config::get('database'));
$capsule->setAsGlobal();  //this is important
$capsule->bootEloquent();

function ticks(...$args)
{
    $tickers = [];
    $setTicks = new \Ds\Set(['wti', 'gold', 'sz', 'wheat', 'ss', 'cop']);
    $commodities = ['wti'=> 'CL=F', 'gold'=> 'GC=F', 'wheat'=> 'KE=F', 'sz'=> '399001.SZ', 'ss'=> '000001.SS', 'cop'=> 'HG=F'];

    foreach($args as $i)
    {
        if (!$setTicks->contains($i))
        {
            $url = 'https://finance.yahoo.com/quote/^' . $i . '/history';
        }
        else
        {
            $url = 'https://finance.yahoo.com/quote/' . $commodities[$i] . '/history';
        }
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $url, [
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.132 Safari/537.36',
            ]
        ]);
        $out = [];
        preg_match("/livePrice svelte-mgkamr.*?<span>/", $response->getBody(), $out);
        $out2 = [];
        preg_match("/[\d\.]{2,}/", $out[0], $out2);
        $tickers[$i] = floatval($out2[0]);
        }
    return $tickers;
}

$dateToday = date("Y-m-d");
//$date7 = (date.today() - timedelta(7)).strftime("%Y-%m-%d");
$tickers = DB::table('tickers')->where('date_added', '=', $dateToday)->get();

//ticks('sz');
$x = DB::select("select gspc from tickers order by date_added desc limit 1");
//print_r(count($tickers));
//var_dump(floatval($x[0]->gspc) == ticks('gspc')['gspc']);
