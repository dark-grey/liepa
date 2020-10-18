<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\RbcNewsService;
use Illuminate\Http\Request;

class RbcNewsController extends Controller
{
    public function index(Request $request, RbcNewsService $service): array
    {
        return $service->formFullResponse($request);
    }
}
