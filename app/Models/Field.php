<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * App\Models\Field
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Country[] $countries
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Field whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Field whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Field whereUpdatedAt($value)
 */
class Field extends Model {

	protected $countries = [];


	public static function create(array $attributes = []) {
		$field = new static($attributes);
		$field->save();
		self::createStartingCountries($field);

		return $field;
	}

	private static function createStartingCountries(Field $field) {
		$countries = new Collection();
		for ($x = 0; $x < \Config::get('settings.fieldWidth'); $x++) {
			for ($y = 0; $y < \Config::get('settings.fieldHeight'); $y++) {
				$countries->push(Country::create(['x' => $x, 'y' => $y, 'field_id' => $field->id,]));
			}
		}
		return $countries;
	}

	public function addPlayer(Player $player) {
		$country = $this->countries()->orderByRaw("RAND()")->first();
		if ($country->isFree()) {
			$country->conqueredBy($player);
		} else {
			$this->addPlayer($player);
		}
	}

	public function countries() {
		return $this->hasMany('App\Models\Country');
	}
}
