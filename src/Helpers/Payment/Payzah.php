<?php

namespace MshMsh\Helpers\Payment;

use Modules\Contracts\Models\Bill;
use Modules\Orders\Models\Order;

class Payzah
{


    public function payment($data, $payment_type = 1)
    {
        $payment_type = $payment_type == 'credit' ? 2 : 1;
        // dd($payment_type);
        $link = $data['callback_url'];
        // $trash_id = \DB::table('orders_trash')->insertGetId(['text' => json_encode($data)]);

        $request = array(
            "trackid" => date('YmdHis'),
            "amount" => $data['total'],
            "success_url" => url($link),
            "error_url" => url('/'),
            "language" => app()->getLocale() == 'ar' ? 'ARA' : 'ENG',
            "currency" => 414,
            "udf1" => $data['order_id'],
            'payment_type' => $payment_type,
        );
        // dd($request);
        /**
         * Test
         */
        $private_key = "c0e6ebf80254c59472cc43d2d0632b06f5f556bf";
        $url = "https://development.payzah.net/ws/paymentgateway/index";
        /**
         * Live
         */
        $private_key = "074f217350c4ae90e0a20b714715fa0b74fb9523";
        $url = 'https://payzah.net/production770/ws/paymentgateway/index';

        // dd($trash_id);
        $authentication = base64_encode($private_key);
        $ch = curl_init($url);
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_AUTOREFERER => true,
            CURLOPT_CONNECTTIMEOUT => 20,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_POST => 1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($request),
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_VERBOSE => 1,
            CURLOPT_HTTPHEADER => array(
                "Authorization: $authentication",
                "Content-Type: application/json",
            ),
        );
        // dd($options);
        curl_setopt_array($ch, $options);
        $data = curl_exec($ch);
        return $data;
    }

    public function callback($test_data = null)
    {
        if ($test_data) {
            $data = $test_data;
        } else {
            // dd(request()->all());
            $data = request('UDF1');
            $bill = Bill::withoutGlobalScopes()->findOrFail($data);
            if (request('paymentStatus') != "CAPTURED") {
                $message = __("Payment not completed we will review your order to confirm it later");
            } else {
                $bill->update([
                    'status' => 'paid',
                    'payment' => request()->all()
                ]);
                $message = $message ?? __("Your subscription created successfully");
                // $this->create_pdf_invoice($bill);
                return redirect()->route('admin.bills.show', $data);
            }
        }
        return '';
        return api_response('error', $message);
    }
}
