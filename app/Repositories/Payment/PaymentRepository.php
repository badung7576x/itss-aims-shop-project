<?php


namespace App\Repositories\Payment;


use App\Entities\Payment;
use App\Repositories\BaseRepository;

class PaymentRepository extends BaseRepository implements PaymentInterface
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Payment::class;
    }
}
