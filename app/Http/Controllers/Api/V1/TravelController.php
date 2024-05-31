<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\TravelResource;
use App\Models\Travel;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $travels =  Travel::public()->paginate();

        return TravelResource::collection($travels);
    }
}
