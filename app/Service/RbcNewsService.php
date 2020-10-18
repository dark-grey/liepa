<?php

namespace App\Service;

use App\Http\Resources\RbcNewsCollection;
use App\Models\RbcNews;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class RbcNewsService
{
    public function updateOrCreateModels(array $data): void
    {
        foreach ($data as $item) {
            $rbcId = $item['rbc_id'] ?? null;

            if (!$rbcId) continue;

            RbcNews::updateOrCreate(
                ['rbc_id' => $rbcId],
                $item,
            );
        }
    }

    public function formFullResponse(Request $request): array
    {
        return (array)RbcNewsCollection::make(
            $this->getWithPagination()
        )
            ->toResponse($request)
            ->getData();
    }

    public function getWithPagination(): LengthAwarePaginator
    {
        return RbcNews::query()->orderBy('date', 'desc')->paginate();
    }
}
