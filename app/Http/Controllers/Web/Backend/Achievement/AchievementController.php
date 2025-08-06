<?php

namespace App\Http\Controllers\Web\Backend\Achievement;

use App\Helpers\Helper;
use Illuminate\View\View;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class AchievementController extends Controller
{

    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {
            $data = Achievement::query()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('title', function ($data) {
                    return $data->title;
                })

                ->addColumn('category', function ($data) {
                    return $data->category;
                })


                ->addColumn('logo_1', function ($data) {
                    return '<img src="' . asset($data->logo_1) . '" alt="Logo" style="width: 70px; height: 70px; object-fit: cover;">';
                })
                ->addColumn('logo_2', function ($data) {
                    return '<img src="' . asset($data->logo_2) . '" alt="Logo" style="width: 70px; height: 70px; object-fit: cover;">';
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
                                <a href="' . route('achievement.content.edit', ['id' => $data->id]) . '" type="button" class="text-white btn btn-primary fs-14 edit-icn" title="Edit">
                                    <i class="fe fe-edit"></i>
                                </a>
                                <a href="#" type="button" onclick="showDeleteConfirm(' . $data->id . ')" class="text-white btn btn-danger fs-14 delete-icn" title="Delete">
                                    <i class="fe fe-trash"></i>
                                </a>
                            </div>';
                })
                ->rawColumns(['title', 'category', 'logo_1', 'logo_2', 'status', 'action'])
                ->make(true);
        }
        return view("backend.layouts.achievement.index");
    }

    public function create()
    {
        $achievements = Achievement::where('status', 'active')->get();
        // dd($categories);
        return view("backend.layouts.achievement.create", compact('achievements'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'category' => 'required|string',
            'logo_1' => 'required|file|mimes:jpeg,jpg,png|max:5120',
            'logo_2' => 'required|file|mimes:jpeg,jpg,png|max:5120',
            'status' => 'required|string',
        ]);

        if ($request->hasFile('logo_1')) {
            $imagePath = Helper::fileUpload($request->file('logo_1'), 'achievement', time() . '_' . $request->file('logo_1')->getClientOriginalName());
            $data['logo_1'] = $imagePath;
        }
        if ($request->hasFile('logo_2')) {
            $imagePath = Helper::fileUpload($request->file('logo_2'), 'achievement', time() . '_' . $request->file('logo_2')->getClientOriginalName());
            $data['logo_2'] = $imagePath;
        }
        Achievement::create([
            'title' => $data['title'],
            'category' => $data['category'],
            'logo_1' => $data['logo_1'],
            'logo_2' => $data['logo_2'],
            'status' => $data['status'],
        ]);
        return redirect()->route('achievement.content.list')->with('t-success', 'Achievement Content created successfully.');
    }

    public function edit(int $id)
    {
        $achievement = Achievement::where('id', $id)->firstOrFail();
        return view('backend.layouts.achievement.edit', compact ('achievement'));
    }

    public function update(Request $request, int $id)
    {
        $achievement = Achievement::where('id', $id)->firstOrFail();
        $request->validate([
            'title' => 'nullable',
            'category' => 'nullable',
            'logo_1' => 'nullable',
            'logo_2' => 'nullable',
            'status' => 'nullable',
        ]);
        if ($request->hasFile('logo_1')) {
            $imagePath = Helper::fileUpload($request->file('logo_1'), 'achievement', time() . '_' . $request->file('logo_1')->getClientOriginalName());
            if ($imagePath !== null) {
                // Delete old logo_1 if exists
                Helper::fileDelete($achievement->logo_1);
                $achievement->logo_1 = $imagePath;
            }
        }
        if ($request->hasFile('logo_2')) {
            $imagePath = Helper::fileUpload($request->file('logo_2'), 'achievement', time() . '_' . $request->file('logo_2')->getClientOriginalName());
            if ($imagePath !== null) {
                // Delete old logo_2 if exists
                Helper::fileDelete($achievement->logo_2);
                $achievement->logo_2 = $imagePath;
            }
        }

        $achievement->title = $request->title;
        $achievement->category = $request->category;
        $achievement->status = $request->status;

        $achievement->update();

        return redirect()->route('achievement.content.list')->with('t-success', 'Achievement Content updated successfully.');
    }

    public function toggleStatus(int $id): JsonResponse
    {
        $data = Achievement::findOrFail($id);
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
        $achievement = Achievement::where('id', $id)->firstOrFail();
        if($achievement->logo_1){
            Helper::fileDelete($achievement->logo_1);
        }
        if($achievement->logo_2){
            Helper::fileDelete($achievement->logo_2);
        }
        $achievement->delete();

        return response()->json([
            'success' => true,
            'message' => 'achievement Content deleted successfully.'
        ]);
    }
}
