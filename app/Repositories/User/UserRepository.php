<?php


namespace App\Repositories\User;

use App\Entities\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

class UserRepository extends BaseRepository implements UserInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return User::class;
    }

    public function getAll()
    {
        return $this->_model->all();
    }

    public function getUserLogin()
    {
        return Auth::user();
    }
}

