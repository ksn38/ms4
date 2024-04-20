<?php
require 'vendor/autoload.php';

function ticks(...$args)
{
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
        print($response->getBody());
        /*parsed_html = bs(response, 'lxml')
        t = parsed_html.find('fin-streamer', {'class': 'livePrice svelte-mgkamr'}).text.replace(',', '')
        #print(t)
        t_dict[i] = float(t)*/
        }
}

ticks('sz');
