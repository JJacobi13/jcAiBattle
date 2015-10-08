<?php

namespace App\Models\Presenters;


trait PresenterTrait
{
    protected $caller;

    public function presenter()
    {
        $presenterName = 'App\\Models\\Presenters\\' . (new \ReflectionClass($this))->getShortName() . 'Presenter';
        return new $presenterName($this);
    }
}