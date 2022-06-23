<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EventCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    static function booted()
    {
        parent::creating(fn (EventCategory $eventCategory) => [$eventCategory->slug =  Str::slug($eventCategory->name)]);
        parent::updating(fn (EventCategory $eventCategory) => $eventCategory->slug = Str::slug($eventCategory->name));
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
