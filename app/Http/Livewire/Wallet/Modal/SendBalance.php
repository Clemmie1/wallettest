<?php

namespace App\Http\Livewire\Wallet\Modal;

use App\Http\Controllers\ConvertCoreController;
use App\Http\Controllers\MyWalletController;
use App\Http\Controllers\WalletApiController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class SendBalance extends Component
{
    use LivewireAlert;

    public $phone;
    public $sum;

    public $WalletTypeSend;


    public function render()
    {
        return view('livewire.wallet.modal.send-balance');
    }

    public function sendBalance(){

        $phone = $this->phone;
        $sum = $this->sum;

        $phone_result = '7'.$phone;
        $session = session()->get('sessionPhone');

        date_default_timezone_set("Asia/Almaty");
        $date = date('d.m.Y H:i');


        if ($session != $phone_result){
            $UserInfo = DB::table('users')->where('phone', $phone_result)->first();

            if (!preg_match("/^[0-9]{10,10}+$/", $phone)){
                return $this->alert('warning', 'Неверный формат телефона');
            } else {
                if ($UserInfo != null){
                    if ($this->WalletTypeSend == null){
                        if ($sum > 99){
                            $myBalance = MyWalletController::getBalanceKZT($session);
                            if (is_numeric($sum)){
                                if ($myBalance >= $sum){
                                    WalletApiController::addBalanceKZT($phone_result, $sum);
                                    WalletApiController::removeBalanceKZT($session, $sum);
                                    DB::insert("insert into payment (type, payment_from, payment_to, currency, sum, date) values ('translation', '$session', '$phone_result', 'KZT', '$sum', '$date')");

                                    $sumReplenishment = '+'. $sum . ' KZT';
                                    $sumConclusion = '-'. $sum . ' KZT';

                                    Mail::to(MyWalletController::getMyEmail($phone_result))->send(new \App\Mail\WalletWalletReplenishmentMail($date, $sumReplenishment));
                                    Mail::to(MyWalletController::getMyEmail($session))->send(new \App\Mail\WalletConclusionMail($date, $sumConclusion));

                                    return $this->alert('success', 'Успешно переведено');
                                } else {
                                    return $this->alert('warning', 'Недостаточно баланса на кошельке');
                                }
                            } else {
                                return $this->alert('warning', 'error');
                            }
                        } else  {
                            return $this->alert('warning', 'Минимальный перевод 100₸');
                        }
                    } else if ($this->WalletTypeSend == "RUB"){
                        if ($sum > 49){
                            $myBalance = MyWalletController::getBalanceKZT($session);
                            if (is_numeric($sum)){
                                if ($myBalance >= $sum){
                                    $sum_rub = ConvertCoreController::getCurrency('KZT', 'RUB', $sum);
                                    WalletApiController::addBalanceRUB($phone_result, ConvertCoreController::getCurrency('KZT', 'RUB', $sum));
                                    WalletApiController::removeBalanceKZT($session, $sum);
                                    DB::insert("insert into payment (type, payment_from, payment_to, currency, sum, date) values ('translation', '$session', '$phone_result', 'RUB', '$sum_rub', '$date')");

                                    $sumReplenishment = '+'. $sum_rub . ' RUB';
                                    $sumConclusion = '-'. $sum . ' KZT';

                                    Mail::to(MyWalletController::getMyEmail($phone_result))->send(new \App\Mail\WalletWalletReplenishmentMail($date, $sumReplenishment));
                                    Mail::to(MyWalletController::getMyEmail($session))->send(new \App\Mail\WalletConclusionMail($date, $sumConclusion));

                                    return $this->alert('success', 'Успешно переведено');
                                } else {
                                    return $this->alert('warning', 'Недостаточно баланса на кошельке');
                                }
                            } else {
                                return $this->alert('warning', 'error');
                            }
                        } else {
                            return $this->alert('warning', 'Минимальный перевод 50₸');
                        }
                    } else if ($this->WalletTypeSend == "USD"){
                        if ($sum > 499){
                            $myBalance = MyWalletController::getBalanceKZT($session);
                            if (is_numeric($sum)){
                                if ($myBalance >= $sum){
                                    $sum_usd = ConvertCoreController::getCurrency('KZT', 'USD', $sum);
                                    WalletApiController::addBalanceUSD($phone_result, ConvertCoreController::getCurrency('KZT', 'USD', $sum));
                                    WalletApiController::removeBalanceKZT($session, $sum);
                                    DB::insert("insert into payment (type, payment_from, payment_to, currency, sum, date) values ('translation', '$session', '$phone_result', 'USD', '$sum_usd', '$date')");

                                    $sumReplenishment = '+'. $sum_usd . ' USD';
                                    $sumConclusion = '-'. $sum . ' KZT';

                                    Mail::to(MyWalletController::getMyEmail($phone_result))->send(new \App\Mail\WalletWalletReplenishmentMail($date, $sumReplenishment));
                                    Mail::to(MyWalletController::getMyEmail($session))->send(new \App\Mail\WalletConclusionMail($date, $sumConclusion));

                                    return $this->alert('success', 'Успешно переведено');
                                } else {
                                    return $this->alert('warning', 'Недостаточно баланса на кошельке');
                                }
                            } else {
                                return $this->alert('warning', 'error');
                            }
                        } else{
                            return $this->alert('warning', 'Минимальный перевод 500₸');
                        }
                    }
                } else {
                    return $this->alert('warning', 'Кошелек не найден');
                }
            }

        } else {
            return $this->alert('error', 'Невозможно перевести');
        }
    }
}
