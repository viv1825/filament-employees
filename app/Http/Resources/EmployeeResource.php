<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return 
        [
            'id' => $this->id,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'address' => $this->address,
            'countryID' => $this->country_id,
            'stateID' => $this->state_id,
            'cityID' => $this->city_id,
            'departmentID' => $this->department_id,
            'zip_code' => $this->zip_code,
            'LastName' => $this->last_name,
            'birthDate' => $this->birth_date,
            'dateHired' => $this->date_hired
        ];
    }
}
