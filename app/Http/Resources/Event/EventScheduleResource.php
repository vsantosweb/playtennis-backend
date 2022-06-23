<?php

namespace App\Http\Resources\Event;

use Illuminate\Http\Resources\Json\JsonResource;

class EventScheduleResource extends JsonResource
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
            'id' => $this->event->id,
            'code' => $this->code,
            'name' => $this->event->name,
            'category' => $this->event->category->name,
            'gym' => $this->gym->name,
            'gym_slug' => $this->gym->slug,
            'slug' => $this->event->slug,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'registration_start_date' => $this->registration_start_date,
            'registration_end_date' => $this->registration_end_date,
            'vacancies' => $this->vacancies,
            'description' => $this->event->description,
        ];
    }
}
