<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * App\Models\Player
 *
 * @property integer $id
 * @property string $color
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection|Country[] $countries
 * @method static Builder|Player whereId($value)
 * @method static Builder|Player whereColor($value)
 * @method static Builder|Player whereCreatedAt($value)
 * @method static Builder|Player whereUpdatedAt($value)
 */
class Player extends Model {
	protected $fillable = [
		'color',
		'hash'
	];

	public static function create(array $attributes = []) {
		return parent::create([
			'color' => sprintf('#%06X', mt_rand(0, 0xFFFFFF)),
			'hash' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz1234567890'), 0, 10)
		]);
	}

	public static function getByHash($playerHash) {
		return self::whereHash($playerHash)->firstOrFail();
	}

	public function countries() {
		return $this->hasMany('App\Models\Country');
	}
}
