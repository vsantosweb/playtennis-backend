<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\Business\BusinessResource;
use App\Http\Resources\Gym\GymResource;
use App\Http\Resources\Lease\LeaseResource;
use App\Http\Resources\Subscription\SubscriptionResource;
use App\Http\Resources\Workout\WorkoutResource;
use App\Models\Business\Business;
use App\Models\Gym\Gym;
use App\Models\Lease\Lease;
use App\Models\Partner;
use App\Models\Subscription\Subscription;
use App\Models\Workout\Workout;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function gyms()
    {
        return $this->outputJSON(GymResource::collection(Gym::with('comforts', 'tennisCourts', 'workouts', 'subscriptions', 'leases')->get()));
    }

    public function showGym(Gym $gym)
    {
        return $this->outputJSON(new GymResource($gym->load('comforts', 'tennisCourts', 'workouts')));
    }

    public function partners()
    {
        return $this->outputJSON(Partner::all());
    }

    public function workouts()
    {
        return $this->outputJSON(WorkoutResource::collection(Workout::with('gyms', 'benefits')->get()));
    }

    public function subscriptions()
    {
        return $this->outputJSON(SubscriptionResource::collection(Subscription::with('gyms', 'classifications' , 'benefits')->get()));
    }

    public function products()
    {
        return $this->outputJSON(BusinessResource::collection(Business::with('workouts', 'subscriptions', 'leases')->get()));
    }

    public function leases()
    {
        return $this->outputJSON(LeaseResource::collection(Lease::with('gyms')->get()));
    }

}
