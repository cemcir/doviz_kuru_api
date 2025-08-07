<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CurrencyController extends Controller
{
    public function GetStates(Request $request)
    {
        $result = [];
        $response = Http::get('https://finans.truncgil.com/today.json');
        $array = json_decode($response->body(),TRUE);

        if($request->query('type')) {
            if ($request->query('type') == "altin") {
                $result['altin']['alis'] = $array['gram-altin']['Alış'];
                $result['altin']['satis'] = $array['gram-altin']['Satış'];
            }
            else if($request->query('type')=="euro") {
                $result['euro']['alis'] = $array['EUR']['Alış'];
                $result['euro']['satis'] = $array['EUR']['Satış'];
            }
            else if($request->query('type')=="dolar") {
                $result['dolar']['alis'] = $array['USD']['Alış'];
                $result['dolar']['satis'] = $array['USD']['Satış'];
            }
            else if($request->query('type')=="hepsi") {
                $result['altin']['alis'] = $array['gram-altin']['Alış'];
                $result['altin']['satis'] = $array['gram-altin']['Satış'];
                $result['euro']['alis'] = $array['EUR']['Alış'];
                $result['euro']['satis'] = $array['EUR']['Satış'];
                $result['dolar']['alis'] = $array['USD']['Alış'];
                $result['dolar']['satis'] = $array['USD']['Satış'];
            }
        }
        if(!empty($result)) {
            return response()->json(['status'=>200,'data'=>$result],200,[],JSON_NUMERIC_CHECK);
        }

        return response()->json(['status'=>404,'data'=>$result],404,[],JSON_UNESCAPED_UNICODE);
    }

}
