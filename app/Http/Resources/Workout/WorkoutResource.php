<?php

namespace App\Http\Resources\Workout;

use App\Http\Resources\Benefit\BenefitResource;
use App\Http\Resources\Gym\GymResource;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkoutResource extends JsonResource
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
            case $this->name === 'Individuais':
                $this->aboutTitle = 'Sobre aulas ' . $this->name;
                break;
            case ($this->name === 'Dupla' ||  $this->name === 'Grupo'):
                $this->aboutTitle = 'Sobre aulas em ' . $this->name;
                break;
            default:
                $this->aboutTitle = 'Sobre o ' . $this->name;
                break;
        }

        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'name' => $this->name,
            'about_title' =>  $this->aboutTitle,
            'business' => $this->business->slug,
            'slug' => $this->slug,
            'description' => $this->description,
            'gyms' => $this->whenLoaded('gyms',  fn () => GymResource::collection($this->gyms->load('tennisCourts', 'comforts'))),
            'benefits' =>   $this->whenLoaded('benefits',  fn () => BenefitResource::collection($this->benefits)),

        ];
        return parent::toArray($request);
    }
}
