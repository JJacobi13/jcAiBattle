<?php
/**
 * Created by PhpStorm.
 * User: Jetse
 * Date: 07/10/2015
 * Time: 21:01
 */

namespace App\Models\Presenters;


class CountryPresenter extends BasePresenter
{

    public function getColor()
    {
        if($this->caller->isFree()){
            return 'white';
        }
        return $this->caller->player->color;
    }

    public function drawField()
    {
        $html = '<td style="background-color: ' . $this->getColor() . '" ">';
        $html .= $this->caller->army->size;
        $html .= '</td>';
        return $html;
    }
}