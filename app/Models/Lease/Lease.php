<?php

namespace App\Models\Lease;

use App\Models\Business\Business;
use App\Models\Gym\Gym;
use App\Models\TennisCourt\TennisCourt;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Lease extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'business_id',
        'slug',
        'name',
        'description',
        'description_1',
        'description_2',
    ];

    static function booted()
    {
        parent::creating(fn (Lease $lease) => [$lease->uuid = Str::uuid(),  $lease->slug = 'locacoes-' . Str::slug($lease->name)]);
        parent::updating(fn (Lease $lease) => $lease->slug = 'locacoes-' . Str::slug($lease->name));
    }

    public function gyms()
    {
        return $this->belongsToMany(Gym::class, 'gyms_leases');
    }

    public function tennisCourt()
    {
        return $this->belongsTo(TennisCourt::class);
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
