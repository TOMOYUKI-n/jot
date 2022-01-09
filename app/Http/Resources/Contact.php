<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Contact extends JsonResource
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
            'contact_id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'birthday' => $this->birthday->format('m/d/Y'),
            'company' => $this->company,
            'last_updated' => $this->updated_at->diffForHumans(),
        ];
    }
}
