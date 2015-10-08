<?php

namespace App\Http\Controllers;


use App\Models\Action;
use App\Models\Country;
use App\Models\Player;
use App\Models\TurnManager;

class GameController extends Controller{

	public function getNextTurn() {
		$turnManager = new TurnManager();
		foreach(Country::all() as $country){
			$turnManager->doTurn($country);
		}
		return 'done!';
	}

	public function getAttack($playerHash, $countryIdFrom, $countryIdTo) {
		$from = Country::find($countryIdFrom); /** @var $from Country */
		$to = Country::find($countryIdTo);
		$player = Player::getByHash($playerHash);

		if($from->isOwnedBy($player))
		Action::attack($from, $to);
	}
}