<?php

namespace App\Http\Resources\Cart;

use App\Http\Resources\Cart\CartProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'products' => CartProductResource::collection($this->cart)
        ];
    }
}
