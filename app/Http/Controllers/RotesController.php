<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RotesController extends Controller
{

    public function index(){
        if (session()->get('sessionPhone') != null){

            $session = session()->get('sessionPhone');
            $phone_result = ConvertCoreController::convertPhone($session);
            $UserInfo = DB::table('users')->where('phone', $phone_result)->first();

            if ($UserInfo->email_confirm == 1){
                return view('MyWallet.WalletHome');
            } else {
                return redirect('/confirm');
            }

        } else {
            return redirect('/login');
        }
    }

    public function indexPayment(){
        if (session()->get('sessionPhone') != null){

            $session = session()->get('sessionPhone');
            $phone_result = ConvertCoreController::convertPhone($session);
            $UserInfo = DB::table('users')->where('phone', $phone_result)->first();

            if ($UserInfo->email_confirm == 1){
                return view('MyWallet.WalletPayment');
            } else {
                return redirect('/confirm');
            }

        } else {
            return redirect('/login');
        }
    }

    public function indexCreditCard(){
        if (session()->get('sessionPhone') != null){

            $session = session()->get('sessionPhone');
            $phone_result = ConvertCoreController::convertPhone($session);
            $UserInfo = DB::table('users')->where('phone', $phone_result)->first();

            if ($UserInfo->email_confirm == 1){
                return view('MyWallet.WalletCreditCard');
            } else {
                return redirect('/confirm');
            }

        } else {
            return redirect('/login');
        }
    }

    public function AuthLogin(){
        if (session()->get('sessionPhone') == null){
            return view('AuthSystem.AuthLogin');
        } else {
            return redirect('/');
        }
    }

    public function AuthRegister(){
        if (session()->get('sessionPhone') == null){
            return view('AuthSystem.AuthRegister');
        } else {
            return redirect('/');
        }
    }

    public function AuthLogout(){
        if (session()->get('sessionPhone') != NULL){
            session()->forget(['sessionPhone']);
            return redirect('/');
        }
    }

    public function AuthWalletClosed(){
        return view('AuthSystem.AuthWalletClosed');
    }

    public function AuthConfirm(){
        if (session()->get('sessionPhone') != NULL){
            $session = session()->get('sessionPhone');
            $phone_result = ConvertCoreController::convertPhone($session);
            $UserInfo = DB::table('users')->where('phone', $phone_result)->first();
            if ($UserInfo->email_confirm == 0){
                return view('AuthSystem.AuthConfirm');
            } else {
                return redirect('/');
            }

        } else {
            return redirect('/');
        }
    }

    public function ConfirmKey($ConfirmKey){

        $token = $ConfirmKey;

        $UserInfo = DB::table('confirmation_mail')->where('token', $token)->first();

        if ($UserInfo != null){

            $accountEmail = $UserInfo->email;
            DB::update('update users set email_confirm="1" where email = "'.$accountEmail.'"');
            DB::table('confirmation_mail')->where('token', $token)->delete();
            return redirect('/');

        } else {
            return abort(404, 'Page not found');
        }

    }

}
