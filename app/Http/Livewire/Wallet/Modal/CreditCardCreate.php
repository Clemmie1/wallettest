<?php

namespace App\Http\Livewire\Wallet\Modal;

use App\Http\Controllers\MyWalletController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CreditCardCreate extends Component
{
    use LivewireAlert;

    public function render()
    {
        return view('livewire.wallet.modal.credit-card-create');
    }

    public function createCreditCard(){
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://randommer.io/api/Card?type=visa",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-Api-Key: 3e40b96691214cf0af161fb3bf6f79ed"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return $this->alert('error', 'API response error');
        } else {

            sleep(20);

            $json_file = json_decode($response, true);
            $cardNumber = $json_file['cardNumber'];
            $cardType = $json_file['type'];
            $cardCvv = $json_file['cvv'];

            $session_name = session()->get('sessionPhone');

            date_default_timezone_set("Asia/Almaty");
            $date = date('d.m.Y H:i');
            DB::insert("insert into creditcards (owner_card, balance_kzt, type, cardNumber, cvv, created, closed) values ('$session_name', 0, '$cardType', '$cardNumber', '$cardCvv', '$date', 0)");
            Mail::to(MyWalletController::getMyEmail($session_name))->send(new \App\Mail\WalletSendCardDetailsMail($date, $cardNumber, $cardType, $cardCvv));
            return $this->redirect('/cards');

        }
    }

}
