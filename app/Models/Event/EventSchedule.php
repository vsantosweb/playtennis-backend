<?php

namespace App\Models\Event;

use App\Models\Gym\Gym;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EventSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_at',
        'end_at',
        'code',
        'registration_start_date',
        'registration_end_date',
        'vacancies',
    ];
    
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }
}
