<?php

namespace App\Http\Livewire\AuthSystem;

use App\Http\Controllers\ConvertCoreController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Register extends Component
{

    use LivewireAlert;

    public $name;
    public $surname;
    public $phone;
    public $email;
    public $pass;

    public function render()
    {
        return view('livewire.auth-system.register');
    }

    public function register(){

        $name = $this->name;
        $surname = $this->surname;
        $phone = $this->phone;
        $email = $this->email;
        $password = $this->pass;


        sleep(2);
        if ($name and $surname and $phone and $email and $password != null){

            if (!preg_match("/^[яА-Я]+$/ui", $name)){
                return $this->alert('warning', 'Введите имя кириллицей');
            } else if (!preg_match("/^[яА-Я]+$/ui", $surname)){
                return $this->alert('warning', 'Введите фамилию кириллицей');
            } else if(!preg_match("/^[0-9]{10,10}+$/", $phone)){
                return $this->alert('warning', 'Неверный формат телефона');
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                return $this->alert('warning', 'Неверный формат электронной почты');
            } else {
                $phone_result = '7'.$phone;
                $UserInfo = DB::table('users')->where('phone', $phone_result)->where('email', $email)->first();

                if ($UserInfo == null){

                    $token = bin2hex(random_bytes(60));

                    DB::insert("insert into users (name, surname, phone, email, password, email_confirm, balance_kzt, balance_rub, balance_usd, wallet_closed) values ('$name', '$surname', '$phone_result', '$email', '$password', 0, 0, 0, 0, 0)");
                    DB::insert("insert into confirmation_mail (email, token) values ('$email', '$token')");

                    $link = "http://wallet.mountmc.net/confirm/".$token;
                    Mail::to($email)->send(new \App\Mail\SendConfirmAccountMail($link));
                    session()->put('sessionPhone', $phone_result);
                    return redirect('/confirm');

                } else {
                    return $this->alert('warning', 'Пользователь уже зарегистрирован');
                }

            }

        } else {
            return $this->alert('error', 'Введите данные');
        }

//        sleep(1);
//        $phone = $this->phone;
//        $result = preg_replace("/\s/", "", $phone);
//        $chars = '+'.$result;
//        return $this->alert('warning', $result);
    }
}
