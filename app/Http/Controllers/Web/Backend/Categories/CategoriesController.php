<?php

namespace App\Http\Controllers\Web\Backend\Categories;
use Illuminate\View\View;
use App\Models\Categories;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\Calculation\Category;


class CategoriesController extends Controller
{
    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {
            $data = Categories::query()->get();
            // dd($data);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('type', function ($data) {
                    return $data->type;
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
                                <a href="' . route('category.edit', ['id' => $data->id]) . '" type="button" class="text-white btn btn-primary fs-14 edit-icn" title="Edit">
                                    <i class="fe fe-edit"></i>
                                </a>
                                <a href="#" type="button" onclick="showDeleteConfirm(' . $data->id . ')" class="text-white btn btn-danger fs-14 delete-icn" title="Delete">
                                    <i class="fe fe-trash"></i>
                                </a>
                            </div>';
                })

                ->rawColumns(['name', 'type', 'status', 'action'])
                ->make(true);
        }

        return view("backend.layouts.categories.index");

    }

    public function create()
    {
        return view("backend.layouts.categories.create");
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'nullable|string',
            'type' => 'nullable|string',
        ]);
        $data['slug'] = Str::slug($request->name); // Generate slug
        //Categories::create($data);

        Categories::create([
            'name' => $data['name'],
            'type' => $data['type'],
        ]);

        return redirect()->route('category.list')->with('t-success', 'Category created successfully.');
    }

    public function edit(int $id)
    {
        $categories = Categories::where('id', $id)->firstOrFail();
        return view('backend.layouts.categories.edit', compact('categories'));
    }

    public function update(Request $request, $id)
    {
        $category = Categories::where('id', $id)->firstOrFail();

        $request->validate([
            'name' => 'nullable|string',
            'type' => 'nullable|string',
        ]);

        // $data['slug'] = Str::slug($request->name);

        $category->name = $request->name;
        $category->type = $request->type;

        $category->save();

        return redirect()->route('category.list')->with('t-success', 'Category updated successfully.');
    }


    public function toggleStatus(int $id): JsonResponse
    {
        $data = Categories::findOrFail($id);
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
        $category = Categories::where('id', $id)->firstOrFail();
        $category->delete();

        return response()->json(['success' => true, 'message' => 'Category deleted successfully.']);
    }

    public function status(int $id): JsonResponse
    {
        // Find the CMS entry by ID
        $data = Categories::findOrFail($id);

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
