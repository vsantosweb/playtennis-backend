<?php

namespace App\Models\Event;

use App\Models\Gym\Gym;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_category_id',
        'name',
        'description',
    ];

    static function booted()
    {
        parent::creating(fn (Event $event) => [$event->uuid = Str::uuid(), $event->slug = Str::slug($event->name)]);
        parent::updating(fn (Event $event) => $event->slug = Str::slug($event->name));
    }

    public function category()
    {
        return $this->belongsTo(EventCategory::class, 'event_category_id');
    }

    public function schedule()
    {
        return $this->hasOne(EventSchedule::class);
    }

    public function gyms()
    {
        return $this->belongsToMany(Gym::class, 'event_schedules')->withPivot(
            'start_at',
            'end_at',
            'registration_start_date',
            'registration_end_date',
            'vacancies',
        );;
    }
}
