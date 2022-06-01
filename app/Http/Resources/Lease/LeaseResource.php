<?php

namespace App\Http\Resources\Lease;

use App\Http\Resources\Gym\GymResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    protected  $aboutTitle;

    public function toArray($request)
    {
        switch (true) {
            case ($this->name === 'Rápida'):
                $this->aboutTitle = 'Quadras Rápidas';
                break;

            case ($this->name === 'PlayPack Locações'):
                $this->aboutTitle = 'Sobre o ' . $this->name;
                break;
            default:
                $this->aboutTitle = 'Quadras de ' . $this->name;
                break;
        }

        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'name' => $this->name,
            'about_title' => $this->aboutTitle,
            'business' => $this->business->slug,
            'slug' => $this->slug,
            'description' => $this->description,
            'description_1' => $this->description_1,
            'gyms' => $this->whenLoaded('gyms',  fn () => GymResource::collection($this->gyms->load('tennisCourts', 'comforts')))
        ];

        return parent::toArray($request);
    }
}
