<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Category;
use App\Subcategory;

class SubcategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public static $wrap = 'subcategory';
    public function toArray($request)
    {
        // return parent::toArray($request);
         return [
            'subcategory_id' => $this->id,
            'subcategory_name' => $this->name,
            'category' => Category::find($this->category_id),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
