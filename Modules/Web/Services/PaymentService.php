<?php


namespace Modules\Web\Services;


use App\Entities\Payment;
use GuzzleHttp\Client;

class PaymentService
{
    public const PAYMENT_SUCCESS = 1;
    public const PAYMENT_FAILURE = 0;
    public const CANCEL_SUCCESS = 1;
    public const CANCEL_FAILURE = 0;
    private $paymentInfo;
    private $paymentApi = "https://6006e95f3698a80017de253e.mockapi.io/api/v1/";
    private $client;

    public function __construct($info = null)
    {
        if(!empty($info)) {
            $this->paymentInfo['credit_number'] = $info['card_number'];
            $this->paymentInfo['expired_date'] = $info['year'] . "/" . $info['month'];
            $this->paymentInfo['cvv'] = $info['cvv'];
        }
        $this->client = new Client();
    }
    public function payment($amount) {

        $res = $this->client->get($this->paymentApi . "payment/1", [$this->paymentInfo, $amount]);
        if($res->getStatusCode()) {
            $paymentResponse = $res->getBody()->getContents();
            return ['status' => self::PAYMENT_SUCCESS, 'response' => json_decode($paymentResponse)];
        } else {
            return ['status' => self::PAYMENT_FAILURE];
        }
    }

    public function cancel($order) {
        $res = $this->client->get($this->paymentApi . "cancel/1", [$order->id]);
        if($res->getStatusCode()) {
            $paymentResponse = $res->getBody()->getContents();
            return ['status' => self::CANCEL_SUCCESS, 'response' => json_decode($paymentResponse)];
        } else {
            return ['status' => self::CANCEL_FAILURE];
        }
    }
}
