<?php

namespace App\Http\Controllers\Web\Backend\RoadMap;

use App\Helpers\Helper;
use App\Models\RoadMap;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class RoadMapController extends Controller
{
    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {
            $data = RoadMap::query()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('title', function ($data) {
                    return $data->title;
                })

                ->addColumn('category', function ($data) {
                    return $data->category;
                })

                ->addColumn('photo', function ($data) {
                    return '<img src="' . asset($data->photo) . '" alt="Photo" style="width: 70px; height: 70px; object-fit: cover;">';
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
                                <a href="' . route('roadmap.content.edit', ['id' => $data->id]) . '" type="button" class="text-white btn btn-primary fs-14 edit-icn" title="Edit">
                                    <i class="fe fe-edit"></i>
                                </a>
                                <a href="#" type="button" onclick="showDeleteConfirm(' . $data->id . ')" class="text-white btn btn-danger fs-14 delete-icn" title="Delete">
                                    <i class="fe fe-trash"></i>
                                </a>
                            </div>';
                })
                ->rawColumns(['title', 'category', 'photo', 'logo_2', 'status', 'action'])
                ->make(true);
        }
        return view("backend.layouts.roadmap.index");
    }

    public function create()
    {
        $roadmaps = RoadMap::where('status', 'active')->get();
        // dd($categories);
        return view("backend.layouts.roadmap.create", compact('roadmaps'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'category' => 'required|string',
            'photo' => 'required|file|mimes:jpeg,jpg,png|max:5120',
            'description' => 'required|string',
            'details' => 'required|string',
            'vimeo_id' => 'required|string',
            'status' => 'required|string',
        ]);

        if ($request->hasFile('photo')) {
            $imagePath = Helper::fileUpload($request->file('photo'), 'roadmap', time() . '_' . $request->file('photo')->getClientOriginalName());
            $data['photo'] = $imagePath;
        }
        RoadMap::create([
            'title' => $data['title'],
            'category' => $data['category'],
            'photo' => $data['photo'],
            'description' => $data['description'],
            'details' => $data['details'],
            'vimeo_id' => $data['vimeo_id'],
            'status' => $data['status'],
        ]);
        return redirect()->route('roadmap.content.list')->with('t-success', 'RoadMap Content created successfully.');
    }

    public function edit(int $id)
    {
        $roadmap = RoadMap::where('id', $id)->firstOrFail();
        return view('backend.layouts.roadmap.edit', compact ('roadmap'));
    }

    public function update(Request $request, int $id)
    {
        $roadmap = RoadMap::where('id', $id)->firstOrFail();
        $request->validate([
            'title' => 'nullable',
            'category' => 'nullable',
            'photo' => 'nullable',
            'description' => 'nullable',
            'details' => 'nullable',
            'vimeo_id' => 'nullable',
            'status' => 'nullable',
        ]);
        if ($request->hasFile('photo')) {
            $imagePath = Helper::fileUpload($request->file('photo'), 'roadmap', time() . '_' . $request->file('photo')->getClientOriginalName());
            if ($imagePath !== null) {
                // Delete old photo if exists
                Helper::fileDelete($roadmap->photo);
                $roadmap->photo = $imagePath;
            }
        }


        $roadmap->title = $request->title;
        $roadmap->category = $request->category;
        $roadmap->description = $request->description;
        $roadmap->details = $request->details;
        $roadmap->vimeo_id = $request->vimeo_id;
        $roadmap->status = $request->status;

        $roadmap->update();

        return redirect()->route('roadmap.content.list')->with('t-success', 'RoadMap Content updated successfully.');
    }

    public function toggleStatus(int $id): JsonResponse
    {
        $data = RoadMap::findOrFail($id);
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

    public function destroy($id)
    {
        $roadmap = RoadMap::where('id', $id)->firstOrFail();
        if($roadmap->logo_1){
            Helper::fileDelete($roadmap->logo_1);
        }
        if($roadmap->logo_2){
            Helper::fileDelete($roadmap->logo_2);
        }
        $roadmap->delete();

        return response()->json([
            'success' => true,
            'message' => 'Roadmap Content deleted successfully.'
        ]);
    }
}
