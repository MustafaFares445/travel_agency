<?php

namespace App\Http\Controllers\Api\V1;

use App\Traits\ApiResponse;
use App\Traits\GeneratePaginationMeta;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ApiController
{
    use AuthorizesRequests, ValidatesRequests , ApiResponse;
}
