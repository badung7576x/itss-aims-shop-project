<?php


namespace App\Repositories\Warehouse;

use App\Entities\Warehouse;
use App\Repositories\BaseRepository;

class WarehouseRepository extends BaseRepository implements WarehouseInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Warehouse::class;
    }

    public function getQuantityRemaining($productId)
    {
        $quantity = $this->_model->where('product_id', $productId)->pluck('quantity')->first();
        return $quantity ?? 0;
    }

    public function updateOrCreateQuantity($productId, $quantity)
    {
        return $this->_model->updateOrCreate(['product_id' => $productId], ['quantity' => $quantity]);
    }

    public function backProductQuantity($productId, $backQuantity)
    {
        return $this->_model->where('product_id', $productId)->increment('quantity', $backQuantity);
    }
}

