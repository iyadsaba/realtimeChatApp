<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
//use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response;

class MessageResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ([
            'text'=> $this->message,
            'sender' => $this->user->name,
            'sender_email'=>$this->user->email,
            'recevier'=>$this->group->name,
        ]);
    }
}
