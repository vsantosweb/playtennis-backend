<?php

namespace App\Http\Resources\Business;

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
            'workouts' => $this->when(count($this->workouts) > 0, $this->workouts),
            'subscriptions' => $this->when(count($this->subscriptions) > 0, $this->subscriptions),
            'leases' => $this->when(count($this->leases) > 0, $this->leases)
        ];

        return parent::toArray($request);
    }
}
