<?php

namespace App\Models;

use App\Exceptions\NotYetImplementedException;
use App\Models\Action;
use App\Models\Army;
use App\Models\Presenters\CountryPresenter;
use App\Models\Presenters\PresenterTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * App\Models\Country
 *
 * @property integer $id
 * @property integer $x
 * @property integer $y
 * @property integer $field_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Field $field
 * @method static Builder|Country whereId($value)
 * @method static Builder|Country whereX($value)
 * @method static Builder|Country whereY($value)
 * @method static Builder|Country whereFieldId($value)
 * @method static Builder|Country whereCreatedAt($value)
 * @method static Builder|Country whereUpdatedAt($value)
 * @property integer $player_id
 * @property-read Player $player
 * @method static Builder|Country wherePlayerId($value)
 * @method CountryPresenter presenter()
 * @property-read Army $army
 * @property-read Collection|Action[] $actions
 */
class Country extends Model {

	use PresenterTrait;

	protected $fillable = ['x', 'y', 'field_id', 'player_id',];

	public function field() {
		return $this->belongsTo('App\Models\Field');
	}

	public function player() {
		return $this->belongsTo('App\Models\Player');
	}

	public function army() {
		return $this->hasone('App\Models\Army');
	}

	public function actions() {
		return $this->hasMany('App\Models\Action');
	}

	public static function create(array $attributes = []) {
		$country = parent::create($attributes);
		/** @var $country Country */
		$army = Army::create([
			'size' => 2
		]);
		$country->army()->save($army);
		return $country;
	}

	public function isFree() {
		return $this->player == null;
	}

	public function conqueredBy(Player $player) {
		$this->player_id = $player->id;
		$this->save();
	}

	/**
	 * @param Country $possibleNeighbour
	 * @return bool
	 * @throws NotYetImplementedException
	 */
	public function hasNeighbour(Country $possibleNeighbour) {
		throw new NotYetImplementedException('neighbour check not yet implemented');
	}

	/**
	 * @param Country $to
	 * @return bool
	 * @throws NotYetImplementedException
	 */
	public function hasConnectionsTo(Country $to) {
		throw new NotYetImplementedException('Connection check not yet implemented');
	}

	public function __toString() {
		return $this->presenter()->drawField();
	}

	public function isOwnedBy(Player $player) {
		 return $this->player_id == $player->id;
	}
}
