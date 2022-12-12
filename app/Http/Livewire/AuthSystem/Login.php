<?php

namespace App\Http\Livewire\AuthSystem;

use App\Http\Controllers\ConvertCoreController;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Login extends Component
{

    use LivewireAlert;

    public $phone;
    public $pass;

    public function render()
    {
        return view('livewire.auth-system.login');
    }

    public function login(){

        $phone = $this->phone;
        $password = $this->pass;
        $phone_result = '7'.$phone;

        $UserInfo = DB::table('users')->where('phone', $phone_result)->where('password', $password)->first();

        sleep(1);

        if (!preg_match("/^[0-9]{10,10}+$/", $phone)){
            return $this->alert('warning', 'Неверный формат телефона');
        } else {
            if ($UserInfo){

                if ($UserInfo->wallet_closed != 1){
                    session()->put('sessionPhone', $phone_result);
                    return redirect('/');
                } else {
                    return redirect('/walletClosed');
                }

            } else {
                return $this->alert('warning', 'Неверный пароль или телефон');
            }
        }

    }

}
