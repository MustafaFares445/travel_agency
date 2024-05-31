<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ToursListRequest;
use App\Http\Resources\V1\TourResource;
use App\Models\Travel;

class TourController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(ToursListRequest $request , Travel $travel)
    {
        $tours = $travel->tours()
            ->when($request->priceFrom , function ($query) use ($request){
                $query->where('price', '>=', $request->priceFrom * 100);
            })
            ->when($request->dateFrom , function ($query) use ($request){
                $query->where('starting_date', '>=', $request->dateFrom);
            })
            ->when($request->dateTo , function ($query) use ($request){
                $query->where('ending_date', '<=', $request->dateTo);
            })
            ->when($request->sortBy && $request->sortOrder , function ($query) use ($request){
                $query->orderBy($request->sortBy , $request->sortOrder);
            })
            ->orderBy('starting_date')
            ->paginate();

        return $this->generateJsonResponse(
            data: TourResource::collection($tours),
            message: trans('Travel Has been Created successfully'),
            metaData: $this->generatePaginationMeta($tours),
        );
    }
}
