<?php

namespace App\Models;

use App\Exceptions\InvalidActionException;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

/**
 * App\Models\Action
 *
 * @property-read Country $country
 */
class Action extends Model
{
	protected $fillable = [
		'action',
		'country_id_from',
		'country_id_to',
		'executed'
	];

	/**
	 * Only call this class from the Action class, can't make it private :(
	 * @param ActionType $action
	 * @param Country $from
	 * @param Country|null $to
	 */
	public function __construct(ActionType $action, Country $from, Country $to = null) {
		$this->$action = $action;
		$this->country_id_from = $from->id;
		if(isset($to)){
			$this->country_id_to = $to->id;
		}
		$this->executed = false;
		$this->save();
	}

	public function countryFrom() {
		return $this->belongsTo('App\Models\Country', 'country_id_from');
    }

	/**
	 * Can't turn the create method to protected so This method is not used in this object.
	 * Use one of the public static functions to create a new instance of this object.
	 * @param array $attributes
	 * @return void|static
	 * @deprecated
	 */
	public static function create(array $attributes = []) {
		throw new InvalidArgumentException('Call the function attack, increaseArmy or move');
	}

	public function countryTo() {
		return $this->belongsTo('App\Models\Country', 'country_id_to');
	}

	public static function attack(Country $from, Country $to) {
		if($from->hasNeighbour($to)){
			return new self(ActionType::attack(), $from, $to);
		}
		throw new InvalidActionException('Only neighbours can attack each other');
	}

	public function increaseArmy(Country $country) {
		return new self(ActionType::increaseArmy(), $country);
	}

	public function move(Country $from, Country $to) {
		if($from->hasConnectionsTo($to)){
			return new self(ActionType::move(), $from, $to);
		}
		throw new InvalidActionException('You need to connect your countries to each other before you can move to this country');
	}
}
