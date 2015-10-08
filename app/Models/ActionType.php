<?php
/**
 * Created by PhpStorm.
 * User: Jetse
 * Date: 08/10/2015
 * Time: 22:28
 */

namespace app\Models;


class ActionType {
	const ATTACK = 'Attack';
	const INCREASE_ARMY = 'Increase_army';
	const MOVE = 'Move';

	private function __construct($action) {
		$this->action = $action;
	}

	public static function attack() {
		return new self(self::ATTACK);
	}

	public static function increaseArmy() {
		return new self(self::INCREASE_ARMY);
	}

	public static function move() {
		return new self(self::MOVE);
	}
}