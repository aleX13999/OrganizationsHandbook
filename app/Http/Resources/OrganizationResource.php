<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'address'    => $this->building->address,
            'latitude'   => $this->building->latitude,
            'longitude'  => $this->building->longitude,
            'phones'     => $this->phones->map(
                function ($phone)
                {
                    return $phone->phone_number;
                },
            ),
            'activities' => $this->activities->map(
                function ($activity)
                {
                    return [
                        'id'   => $activity->id,
                        'name' => $activity->name,
                    ];
                },
            ),
        ];
    }
}
