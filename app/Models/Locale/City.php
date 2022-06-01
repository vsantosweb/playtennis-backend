<?php

namespace App\Models\Locale;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'state_id',
        'code',
        'name',
    ];

    public function state(){
        return $this->belongsTo(State::class, 'state_id')->with('country');
    }
}
