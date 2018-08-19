<?php
namespace app\objects\ViewModels;

use app\models\User;

class NoteCreateView
{
    /**
     * @return array
     */
    public function getUserOptions(): array
    {
        return User::find()
            ->indexBy('id')
            ->select(['username', 'id'])
            ->column();
    }
}