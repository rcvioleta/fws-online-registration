<?php

namespace App\Http\Resources\Registration;

use Illuminate\Http\Resources\Json\JsonResource;

class RegistrationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id, 
            'e_id' => $this->employee->e_id, 
            'full_name' => $this->employee->full_name, 
            'campaign' => $this->employee->campaign->campaign_name, 
            'status' => $this->status
        ];
    }
}
