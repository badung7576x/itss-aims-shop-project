<?php


namespace App\Repositories\Promotion;


use App\Entities\Promotion;
use App\Repositories\BaseRepository;

class PromotionRepository extends BaseRepository implements PromotionInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Promotion::class;
    }

    public function getAll()
    {
        return $this->_model->all();
    }

    public function getAllWithPaginate()
    {
        return $this->_model->whereStatus(1)->with(['category'])->paginate(PER_PAGE);
    }

    public function getPromotionById($id)
    {
        return $this->_model->findOrFail($id);
    }

    function deletePromotion($id)
    {
        $promotion = $this->find($id)->delete();
       
    }
}

