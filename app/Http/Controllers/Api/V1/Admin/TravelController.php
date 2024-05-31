<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TravelRequest;
use App\Http\Resources\V1\TravelResource;
use App\Models\Travel;

class TravelController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(TravelRequest $request)
    {
        $travel = Travel::create($request->validated());

        return TravelResource::make($travel);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(TravelRequest $request, Travel $travel)
    {
        $travel->update($request->validated());

        return TravelResource::make($travel);
    }
}
