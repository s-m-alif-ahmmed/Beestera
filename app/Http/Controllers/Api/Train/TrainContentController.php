<?php

namespace App\Http\Controllers\Api\Train;
use App\Models\Train;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class TrainContentController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $categories = Categories::where('type', 'Train')->where('status', 'active')->get();

        $trainQuery = Train::where('status', 'active');

        if ($request->has('id')) {
            $category = Categories::where('id', $request->id)->first();
            if ($category) {
                $trainQuery->where('category', $category->name);
            }
        }

        if ($request->has('search')) {

            $keyword = $request->input('search');

            $trainQuery = Train::when($keyword, function ($query, $search) {
                $query->where('title', 'LIKE', "%{$search}%");
            });
        }

        $trains = $trainQuery->get();
        $formattedTrain = $trains->map(function ($train){
            return [
                'id' => $train->id,
                'title' => $train->title,
                'thumbnail' => $train->thumbnail,
                'description' => $train->description,
                'category' => $train->category,
                'details' => htmlspecialchars_decode($train->details),
                'vimeo_id' => $train->vimeo_id,
            ];
        });

        return response()->json([
            'status' => true,
            'message' => 'Train and Category data fetched successfully.',
            'data' => [
                'categories' => $categories,
                'train' => $formattedTrain,
            ],
            'code' => 200,
        ], 200);
    }
}
