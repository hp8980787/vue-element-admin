<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'guard_name'=>$this->guard_name,
            'created_at'=>Carbon::create($this->created_at)->format('Y-m-d H:i:s'),
            'updated_at'=>Carbon::create($this->updated_at)->format('Y-m-d H:i:s'),
        ];
    }
}
