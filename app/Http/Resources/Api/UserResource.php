<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

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
        $hash = Hash::make($this->email);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => Carbon::create($this->created_at)->format('Y-m-d H:i:s'),
            'avatar' => $this->avatar?: "http://www.gravatar.com/avatar/$hash?s=300",
            'introdution' => $this->introdution,
            'roles' => $this->roles,
        ];
    }
}
