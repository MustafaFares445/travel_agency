<?php

namespace App\Services;

use App\Http\Requests\ToursListRequest;
use App\Models\Travel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TourService
{
    public function getToursFiltered(ToursListRequest $request, Travel $travel): LengthAwarePaginator
    {
        return $travel->tours()
            ->when($request->priceFrom, function ($query) use ($request) {
                $query->where('price', '>=', $request->priceFrom * 100);
            })
            ->when($request->dateFrom, function ($query) use ($request) {
                $query->where('starting_date', '>=', $request->dateFrom);
            })
            ->when($request->dateTo, function ($query) use ($request) {
                $query->where('ending_date', '<=', $request->dateTo);
            })
            ->when($request->sortBy && $request->sortOrder, function ($query) use ($request) {
                $query->orderBy($request->sortBy, $request->sortOrder);
            })
            ->orderBy('starting_date')
            ->paginate();
    }
}
