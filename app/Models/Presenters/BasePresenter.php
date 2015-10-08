<?php
/**
 * Created by PhpStorm.
 * User: Jetse
 * Date: 07/10/2015
 * Time: 20:57
 */

namespace App\Models\Presenters;


class BasePresenter
{

    protected $caller;

    public function __construct($caller)
    {
        $this->caller = $caller;
    }

    protected function getCaller()
    {
        return $this->caller;
    }
}