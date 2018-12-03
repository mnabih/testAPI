<?php

namespace App\Http\Resources\Product;


use Illuminate\Http\Resources\Json\Resource;

class ProductResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            
            'name' => $this->name,
            'detail' => $this->detail,
            'stock' => $this->stock== 0 ? "Out Of Stock": $this->stock,
            'price' => $this->price,
            'discount' => $this->discount,
            'netPrice' => round((1- $this->discount/100) * $this->price , 2),
            'rating' => $this->reviews->count() > 0 ? round($this->reviews->sum('star')/$this->reviews->count(),2) : 'Not Rating Yet',
            'href' => [
                'review' => route('reviews.index',$this->id)
            ],
        ];
    }
}
