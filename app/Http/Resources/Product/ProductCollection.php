<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\Resource;

class ProductCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return [
            'name' => $this->name,
            'discountedPrice' => $this->discount==0 ? "No Discount": round((1-($this->discount/100))*$this->price,2),
            'ratings'=> $this->reviews->count() > 0  ? round($this->reviews->sum('star')/$this->reviews->count(),2)
                : "No rating Yet" ,
            'href' =>[
                'link' => route('products.show', $this->id),
            ]
        ];
    }
}
