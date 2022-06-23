<?php

namespace App\Http\Resources\Event;

use App\Http\Resources\Gym\GymResource;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'start_at' => $this->whenPivotLoaded('event_schedules', fn () => $this->pivot->start_at),
            'description' => $this->description,
            'category' => $this->whenLoaded('category', fn () => new EventCategoryResource($this->category)),
            'schedule' => $this->whenLoaded('schedule', fn () => $this->schedule),
        ];
    }
}
