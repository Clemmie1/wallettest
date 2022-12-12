<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WalletApiController extends Controller
{

    //KZT
    public static function addBalanceKZT($phone, $sum){
        DB::update('UPDATE `users` SET balance_kzt=balance_kzt+'.$sum.' WHERE phone = '.$phone.'');
    }
    public static function removeBalanceKZT($phone, $sum){
        DB::update('UPDATE `users` SET balance_kzt=balance_kzt-'.$sum.' WHERE phone = '.$phone.'');
    }

    //RUB
    public static function addBalanceRUB($phone, $sum){
        DB::update('UPDATE `users` SET balance_rub=balance_rub+'.$sum.' WHERE phone = '.$phone.'');
    }
    public static function removeBalanceRUB($phone, $sum){
        DB::update('UPDATE `users` SET balance_rub=balance_rub-'.$sum.' WHERE phone = '.$phone.'');
    }

    //USD
    public static function addBalanceUSD($phone, $sum){
        DB::update('UPDATE `users` SET balance_usd=balance_usd+'.$sum.' WHERE phone = '.$phone.'');
    }
    public static function removeBalanceUSD($phone, $sum){
        DB::update('UPDATE `users` SET balance_usd=balance_usd-'.$sum.' WHERE phone = '.$phone.'');
    }

}
