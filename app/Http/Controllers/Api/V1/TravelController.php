<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\TravelResource;
use App\Models\Travel;
use App\Traits\ApiResponse;
use App\Traits\GeneratePaginationMeta;
use Illuminate\Http\JsonResponse;

class TravelController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $travels =  Travel::public()->paginate();

        return $this->generateJsonResponse(
          data: TravelResource::collection($travels),
          message: trans('Travels Has been Retrieved successfully'),
        );
    }
}
