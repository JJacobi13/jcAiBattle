<?php
/**
 * Created by PhpStorm.
 * User: Jetse
 * Date: 08/10/2015
 * Time: 21:04
 */

namespace App\Models;


class TurnManager {

	public function doTurn($country) {
		$this->manageArmy($country->army, $country);
	}

	private function manageArmy(Army $army,Country $country) {
		if($country->isFree()){
			return;
		}

		$army->increaseSize();
	}
}