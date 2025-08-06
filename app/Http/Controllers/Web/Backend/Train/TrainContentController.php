<?php

namespace App\Http\Controllers\Web\Backend\Train;

use App\Models\Train;
use App\Helpers\Helper;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use PhpOffice\PhpSpreadsheet\Calculation\Category;
use Yajra\DataTables\Facades\DataTables;

class TrainContentController extends Controller
{
    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {
            $data = Train::query()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('title', function ($data) {
                    return $data->title;
                })

                ->addColumn('description', function ($data) {
                    $truncatedDescription = Str::limit($data->description, 30, '...');
                    return '<span class="truncated-text" data-full-description="' . e($data->description) . '"
                                style="cursor: pointer; font-size: 14px; font-weight: normal;"
                                title="' . e($data->description) . '">' . e($truncatedDescription) . '</span>';
                })

                ->addColumn('category', function ($data) {
                    return $data->category;
                })


                ->addColumn('thumbnail', function ($data) {
                    return '<img src="' . asset($data->thumbnail) . '" alt="Thumbnail" style="width: 70px; height: 70px; object-fit: cover;">';
                })

                ->addColumn('status', function ($data) {
                    $backgroundColor = $data->status == "active" ? '#4CAF50' : '#ccc';
                    $sliderTranslateX = $data->status == "active" ? '26px' : '2px';
                    $sliderStyles = "position: absolute; top: 2px; left: 2px; width: 20px; height: 20px; background-color: white; border-radius: 50%; transition: transform 0.3s ease; transform: translateX($sliderTranslateX);";

                    $status = '<div style="display: flex; justify-content: center; align-items: center; height: 100%;">';
                    $status .= '<div class="form-check form-switch" style="position: relative; width: 50px; height: 24px; background-color: ' . $backgroundColor . '; border-radius: 12px; transition: background-color 0.3s ease; cursor: pointer;">';
                    $status .= '<input onclick="showStatusChangeAlert(' . $data->id . ')" type="checkbox" class="form-check-input" id="customSwitch' . $data->id . '" getAreaid="' . $data->id . '" name="status" style="position: absolute; width: 100%; height: 100%; opacity: 0; z-index: 2; cursor: pointer;">';
                    $status .= '<span style="' . $sliderStyles . '"></span>';
                    $status .= '<label for="customSwitch' . $data->id . '" class="form-check-label" style="margin-left: 10px;"></label>';
                    $status .= '</div>';
                    $status .= '</div>';

                    return $status;
                })



                ->addColumn('updated_at', function ($data) {
                    return $data->updated_at
                        ? $data->updated_at->diffForHumans()
                        : 'N/A';
                })
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <a href="' . route('train.content.edit', ['id' => $data->id]) . '" type="button" class="text-white btn btn-primary fs-14 edit-icn" title="Edit">
                                    <i class="fe fe-edit"></i>
                                </a>
                                <a href="#" type="button" onclick="showDeleteConfirm(' . $data->id . ')" class="text-white btn btn-danger fs-14 delete-icn" title="Delete">
                                    <i class="fe fe-trash"></i>
                                </a>
                            </div>';
                })

                ->rawColumns(['title', 'description', 'category', 'thumbnail', 'status', 'action'])
                ->make(true);
        }
        return view("backend.layouts.train.index");
    }

    public function create()
    {
        $categories = Categories::where('type', 'Train')->get();
        // dd($categories);
        return view("backend.layouts.train.create", compact('categories'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'thumbnail' => 'required|file|mimes:jpeg,jpg,png|max:51200',
            'category' => 'required|string',
            'details' => 'required',
            'vimeo_id' => 'nullable|string',
            'status' => 'required|string',
        ]);

        if ($request->hasFile('thumbnail')) {
            $imagePath = Helper::fileUpload($request->file('thumbnail'), 'train', time() . '_' . $request->file('thumbnail')->getClientOriginalName());
            $data['thumbnail'] = $imagePath;
        }
        Train::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'category' => $data['category'],
            'details' => $data['details'],
            'vimeo_id' => $data['vimeo_id'],
            'thumbnail' => $data['thumbnail'],
            'status' => $data['status'],
        ]);
        return redirect()->route('train.content.list')->with('t-success', 'Train Content created successfully.');
    }

    public function edit($id)
    {
        $train = Train::where('id', $id)->firstOrFail();

        $categories = Categories::where('type', 'Train')->get();
        return view('backend.layouts.train.edit', compact('train', 'categories'));
    }


    public function update(Request $request, $id)
    {
        $train = Train::where('id', $id)->firstOrFail();

        $request->validate([
            'title' => 'nullable',
            'description' => 'nullable',
            'category' => 'nullable',
            'details' => 'nullable',
            'vimeo_id' => 'nullable',
            'thumbnail' => 'nullable',
            'status' => 'nullable',
        ]);
        if ($request->hasFile('thumbnail')) {
            $imagePath = Helper::fileUpload($request->file('thumbnail'), 'train', time() . '_' . $request->file('thumbnail')->getClientOriginalName());
            if ($imagePath !== null) {
                Helper::fileDelete($train->thumbnail);
                $train->thumbnail = $imagePath;
            }
        }
        $train->title = $request->title;
        $train->description = $request->description;
        $train->category = $request->category;
        $train->details = $request->details;
        $train->vimeo_id = $request->vimeo_id;
        // $train->youtube_link = $request->youtube_link;
        $train->status = $request->status;

        $train->save();

        return redirect()->route('train.content.list')->with('t-success', 'Train Content updated successfully.');
    }


    public function toggleStatus($id): JsonResponse
    {
        $data = Train::findOrFail($id);
        if ($data->status == 'active') {
            $data->status = 'inactive';
            $data->save();

            return response()->json([
                'success' => false,
                'message' => 'Unpublished Successfully.',
                'data' => $data,
            ]);
        } else {
            $data->status = 'active';
            $data->save();

            return response()->json([
                'success' => true,
                'message' => 'Published Successfully.',
                'data' => $data,
            ]);
        }
    }


    public function destroy(int $id)
    {
        $train = Train::where('id', $id)->firstOrFail();
        if($train->thumbnail){
            Helper::fileDelete($train->thumbnail);
        }
        $train->delete();

        return response()->json([
            'success' => true,
            'message' => 'Train Content deleted successfully.'
        ]);
    }

    public function status(int $id): JsonResponse
    {
        // Find the CMS entry by ID
        $data = Train::findOrFail($id);

        // Check if the record was found
        if (!$data) {
            return response()->json([
                "success" => false,
                "message" => "Item not found.",
                "data" => $data,
            ]);
        }

        // Toggle the status
        $data->status = $data->status === 'active' ? 'inactive' : 'active';

        // Save the changes
        $data->save();

        return response()->json([
            'success' => true,
            'message' => 'Category status changed successfully.',
            'data' => $data,
        ]);
    }
}
