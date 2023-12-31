<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProductResource extends JsonResource
{
    
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'code' => $this->code,
            'category' => $this->category,
            'name'  => $this->name,
            'description'  => $this->description,
            'selling_price'  => $this->selling_price,
            'special_price'  => $this->special_price,
            'status'  => $this->status,
            'is_delivery_available'  => $this->is_delivery_available,
            'image'  => Storage::url($this->image),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'actions' => '<button class="btn btn-default show" data-id="'.$this->id.'" >Show</button> <button class="btn btn-default edit" data-id="'.$this->id.'" >Edit</button><button class="btn btn-default delete" data-id="'.$this->id.'" >Delete</button>'

        ];
    }
}
