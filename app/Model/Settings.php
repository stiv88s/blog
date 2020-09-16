<?php

namespace App\Model;

use App\Model\Constants\TimeZone;
use App\Model\Contracts\GenerableInterface;
use App\Traits\GenerableTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
        $timeZoneUser = Auth::user()->timezone ?? TimeZone::DEFAULT_TIME_ZONE;
        $timeZ =  new Carbon( $value, $timeZoneUser);
        $timeZ->setTimezone(Carbon::now()->getTimezone());
        $this->attributes['value'] = $timeZ->format('H:i');
    }

    public function getValueUtcAttribute()
    {
        $timeB = new Carbon($this->attributes['value']);
        $timeZoneUser = Auth::user()->timezone ?? TimeZone::DEFAULT_TIME_ZONE;
        $timeZ = $timeB->setTimezone($timeZoneUser);

        return $timeZ->format('H:i');

    }


}
