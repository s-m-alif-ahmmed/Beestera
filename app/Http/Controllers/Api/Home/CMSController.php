<?php

namespace App\Http\Controllers\Api\Home;
use App\Http\Controllers\Controller;
use App\Models\CMS;

class CMSController extends Controller
{

    public function index()
    {
        $cms = CMS::all()->map(function ($item) {
            return collect($item->toArray())->map(fn($value) => $value ?? '')->toArray();
        });

        return response()->json([
            'status' => true,
            'message' => 'Task data fetched successfully.',
            'data' => $cms,
            'code' => 200,
        ], 200);
    }
}
