<?php

namespace App\Http\Resources;

use App\Models\RbcNews;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RbcNewsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(fn(RbcNews $model) => $this->itemToArray($model))->all();
    }

    public function itemToArray(RbcNews $model): array
    {
        return [
            'id' => $model->id,
            'date' => $model->date,
            'title' => $model->title,
            'description' => $model->description,
            'url' => $model->url,
            'image_url' => $model->image_url,
        ];
    }
}
