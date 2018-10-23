<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'description' =>$this->description,
            'price' =>$this->price,
            'discountedPrice' => $this->discount==0 ? "No Discount": round((1-($this->discount/100))*$this->price,2),
            'stock' =>$this->stock==0 ? "Out of Stock": $this->stock,
            'discount' =>$this->discount==0 ? "No Discount": $this->discount,
            'ratings'=> $this->reviews->count() > 0  ? round($this->reviews->sum('star')/$this->reviews->count(),2)
                : "No rating Yet" ,
            'href' =>[
                'reviews' => route('reviews.index', $this->id),
            ]
        ];
    }
    public function with($request){
        return [
          'version' =>"1.0.0",
          'Author_URL' =>url('http://bdimomin.me/')
        ];
    }
}
