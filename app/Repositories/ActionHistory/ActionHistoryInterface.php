<?php


namespace App\Repositories\ActionHistory;


interface ActionHistoryInterface
{
    public function create(array $attributes);

    public function countHistories($type);

    public function getAllHistories();
}
