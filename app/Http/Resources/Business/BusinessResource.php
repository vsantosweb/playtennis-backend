<?php

namespace App\Http\Resources\Business;

use App\Http\Resources\Lease\LeaseResource;
use App\Http\Resources\Subscription\SubscriptionResource;
use App\Http\Resources\Workout\WorkoutResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BusinessResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'name' => $this->name,
            'slug' => $this->slug,
            'workouts' => $this->when(count($this->workouts) > 0, WorkoutResource::collection($this->workouts)),
            'subscriptions' => $this->when(count($this->subscriptions) > 0, SubscriptionResource::collection($this->subscriptions)),
            'leases' => $this->when(count($this->leases) > 0, LeaseResource::collection($this->leases)),
        ];

        return parent::toArray($request);
    }
}
