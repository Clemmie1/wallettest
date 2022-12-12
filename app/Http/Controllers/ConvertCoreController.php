<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ConvertCoreController extends Controller
{
    public static function convertPhone($phone){
        $phone_result = preg_replace("/\s+/", "", $phone);
        return $phone_result;
    }

    public static function getBalanceKZT($phone){
        $UserInfo = DB::table('users')->where('phone', $phone)->first();
        return number_format($UserInfo->balance_kzt, 1 );
    }

    public static function getBalanceRUB($phone){
        $UserInfo = DB::table('users')->where('phone', $phone)->first();
        return number_format($UserInfo->balance_rub, 1 );
    }

    public static function getBalanceUSD($phone){
        $UserInfo = DB::table('users')->where('phone', $phone)->first();
        return number_format($UserInfo->balance_usd, 1 );
    }

    public static function getCurrency($currencyFrom, $currencyTo, $sum){

        $response = Http::accept('application/json')->get('https://api.apilayer.com/exchangerates_data/convert?to='.$currencyTo.'&from='.$currencyFrom.'&amount='.$sum.'&apikey='.env('API_APILAYER'));

        if ($response->ok()){

            $ok = $response->collect('result');
            $ltrim = ltrim($ok, '[');
            $rtrim = rtrim($ltrim, ']');

            return $rtrim;
        }

    }
}
