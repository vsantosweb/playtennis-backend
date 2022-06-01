<?php

namespace App\Http\Resources\TennisCourt;

use Illuminate\Http\Resources\Json\JsonResource;

class TennisCourtResource extends JsonResource
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
            'uuid' => $this->uuid,
            'name' => $this->name,
            'slug' => $this->slug,
            'indoor' => $this->whenPivotLoaded('gym_courts', fn () => $this->pivot->indoor),
            'outdoor' => $this->whenPivotLoaded('gym_courts', fn () => $this->pivot->outdoor)
        ];
    }
}
