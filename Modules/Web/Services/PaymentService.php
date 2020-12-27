<?php


namespace Modules\Web\Services;


class PaymentService
{
    public const PAYMENT_SUCCESS = 1;
    private $creditNumber;
    private $expiredDate;
    private $cvv;

    public function __construct($info)
    {
        $this->creditNumber = $info['card_number'];
        $this->expiredDate = $info['year'] . "/" . $info['month'];
        $this->cvv = $info['cvv'];
    }
    public function payment() {
        return ['status' => self::PAYMENT_SUCCESS];
    }
}
