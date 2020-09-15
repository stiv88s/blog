<?php

namespace App\Model;

use App\Model\Contracts\GenerableInterface;
use App\Traits\GenerableTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model implements GenerableInterface
{
    use GenerableTrait;

    private $generable = true;
    protected $fillable = ['type', 'value', 'days'];
    protected $casts = [
        'days' => 'array'
    ];
    protected $appends = ['value_utc'];

    public function setValueAttribute($value)
    {
        $time = new Carbon($value);
        $timeZ = $time->setTimezone('-03:00');
        $this->attributes['value'] = $timeZ->format('H:i');
    }

    public function getValueUtcAttribute()
    {
        $timeB = new Carbon($this->attributes['value']);
        $timeZ = $timeB->setTimezone('+03:00');

        return $timeZ->format('H:i');

    }


}
