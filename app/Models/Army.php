<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Army
 *
 * @property integer $id
 * @property integer $size
 * @property integer $country_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Country $country
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Army whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Army whereSize($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Army whereCountryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Army whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Army whereUpdatedAt($value)
 */
class Army extends Model
{
        protected $fillable = [
            'size',
            'country_id',
        ];

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    public function increaseSize() {
        $this->size++;
        $this->save();
    }
}