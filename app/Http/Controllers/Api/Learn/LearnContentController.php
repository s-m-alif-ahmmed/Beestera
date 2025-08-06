<?php

namespace App\Http\Controllers\Api\Learn;
use App\Models\Learn;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class LearnContentController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $categories = Categories::where('type', 'Learn')->where('status', 'active')->get();

        $learnQuery = Learn::where('status', 'active');

        if ($request->has('id')) {
            $category = Categories::where('id', $request->id)->first();
            if ($category) {
                $learnQuery->where('category', $category->name);
            }
        }

        if($request->has('search')){
            $keyword = $request->input('search');
            $learnQuery = Learn::when($keyword, function ($query, $search) {
                $query->where('title', 'LIKE', "%{$search}%");
            });
        }

        $learns = $learnQuery->get();
        $formattedLearn = $learns->map(function ($learn){
            return [
                'id' => $learn->id,
                'title' => $learn->title,
                'thumbnail' => $learn->thumbnail,
                'description' => $learn->description,
                'category' => $learn->category,
                'details' => htmlspecialchars_decode($learn->details),
                'vimeo_id' => $learn->vimeo_id,
            ];
        });

        return response()->json([
            'status' => true,
            'message' => 'learn and Category data fetched successfully.',
            'data' => [
                'categories' => $categories,
                'learn' => $formattedLearn,
            ],
            'code' => 200,
        ], 200);
    }
}
