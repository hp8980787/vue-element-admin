<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'created_at' =>Carbon::create($this->created_at)->format('Y-m-d H:i:s'),
            'avatar'=>$this->avatar,
            'introdution'=>$this->introdution,
            'roles'=>$this->roles,
        ];
    }
}
