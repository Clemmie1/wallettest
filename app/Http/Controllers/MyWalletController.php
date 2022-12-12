<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MyWalletController extends Controller
{
    public static function getMyName($phone){
        $UserInfo = DB::table('users')->where('phone', $phone)->first();
        return $UserInfo->name;
    }

    public static function getMySurname($phone){
        $UserInfo = DB::table('users')->where('phone', $phone)->first();
        return $UserInfo->surname;
    }

    public static function getMyPhone($phone){
        $UserInfo = DB::table('users')->where('phone', $phone)->first();
        return $UserInfo->phone;
    }

    public static function getMyEmail($phone){
        $UserInfo = DB::table('users')->where('phone', $phone)->first();
        return $UserInfo->email;
    }

    public static function getBalanceKZT($phone){
        $UserInfo = DB::table('users')->where('phone', $phone)->first();
        return $UserInfo->balance_kzt;
    }

    public static function getBalanceRUB($phone){
        $UserInfo = DB::table('users')->where('phone', $phone)->first();
        return $UserInfo->balance_rub;
    }

    public static function getBalanceUSD($phone){
        $UserInfo = DB::table('users')->where('phone', $phone)->first();
        return $UserInfo->balance_usd;
    }

    public static function getPaymentList($phone){
        return DB::table('payment')->Where('payment_from', $phone)->orWhere('payment_to', $phone)->limit(1)->first();
    }

    public static function getCreditCardsList($phone){
        return DB::table('creditcards')->Where('owner_card', $phone)->limit(1)->first();
    }

    public static function getCCNumberFormat($cardNumber){
        return substr_replace($cardNumber, '******', -10, 6);
    }

}
