<?php

namespace App\Http\Resources\Gym;

use App\Http\Resources\Comfort\ComfortResource;
use App\Http\Resources\Lease\LeaseResource;
use App\Http\Resources\Subscription\SubscriptionResource;
use App\Http\Resources\TennisCourt\TennisCourtResource;
use App\Http\Resources\Workout\WorkoutResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GymResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $geo = explode(',', $this->geolocation);
        return [
            'uuid' => $this->uuid,
            'name' => $this->name,
            'slug' => $this->slug,
            'address_1' => $this->address_1,
            'address_2' => $this->address_2,
            'locality' => $this->locality,
            'city' => $this->city,
            'state' => $this->state,
            'geolocation' => [
                'latitude' => (float)$geo[0],
                'longitude' => (float)$geo[1]
            ],
            'phone' => $this->phone,
            'email' => $this->email,
            'thumbnail' => $this->thumbnail,
            'is_school' => $this->is_school,
            'is_main' => $this->is_main,
            'cover' => $this->cover,
            'description' => $this->description,
            'comforts' => $this->whenLoaded('comforts', fn () => ComfortResource::collection($this->comforts)),
            'tennis_courts' => $this->whenLoaded('tennisCourts', fn () => TennisCourtResource::collection($this->tennisCourts)),
            'workouts' => $this->whenLoaded('workouts',  fn () => WorkoutResource::collection($this->workouts)),
            'subscriptions' => $this->whenLoaded('subscriptions',  fn () => SubscriptionResource::collection($this->subscriptions)),
            'leases' => $this->whenLoaded('leases',  fn () => LeaseResource::collection($this->leases))
        ];
    }
}
