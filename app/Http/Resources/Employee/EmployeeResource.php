<?php

namespace App\Http\Resources\Employee;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'e_id' => $this->e_id,
            'full_name' => $this->full_name,
            'campaign' => $this->campaign->campaign_name,
            'status' => $this->status
        ];
    }
}
