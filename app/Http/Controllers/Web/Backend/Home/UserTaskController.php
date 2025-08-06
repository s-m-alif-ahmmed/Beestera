<?php


namespace App\Http\Controllers\Web\Backend\Home;

use App\Jobs\CheckVimeoVideoStatusJob;
use App\Models\Task;
use App\Helpers\Helper;
use Illuminate\View\View;
use App\Models\Leaderboard;
use App\Traits\ApiResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ChallengePoint;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Vimeo\Laravel\Facades\Vimeo;
use Yajra\DataTables\Facades\DataTables;

class UserTaskController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Task::latest()->get();
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
                ->addColumn('starting_date', function ($data) {
                    return $data->starting_date;
                })
                ->addColumn('ending_date', function ($data) {
                    return $data->ending_date;
                })
                ->addColumn('achievement', function ($data) {
                    return $data->achievement;
                })
                ->addColumn('thumbnail', function ($data) {
                    return '<img src="' . asset($data->thumbnail) . '" alt="Thumbnail" style="width: 70px; height: 70px; object-fit: cover;">';
                })
                ->addColumn('base_video', function ($data) {
                    if ($data->base_video) {
                        return $data->status === 'processing' ? '<span style="width:100px;font-size: 14px">processing...</span>' : '<iframe id="vimeoPlayer" src="https://player.vimeo.com/video/' . $data->base_video . '"
                                  allow="autoplay; fullscreen; picture-in-picture"
                                  allowfullscreen>
                          </iframe>';
                    }
                    return 'No Video';
                })
                ->addColumn('build_video', function ($data) {
                    if ($data->build_video) {
                        return $data->status === 'processing' ? '<span style="width:100px;font-size: 14px">processing...</span>' : '<iframe id="vimeoPlayer" src="https://player.vimeo.com/video/' . $data->build_video . '"
                                  allow="autoplay; fullscreen; picture-in-picture"
                                  allowfullscreen>
                          </iframe>';
                    }
                    return 'No Video';
                })
                ->addColumn('boost_video', function ($data) {
                    if ($data->boost_video) {
                        return $data->status === 'processing' ? '<span  style="width:100px;font-size: 14px">processing...</span>' : '<iframe id="vimeoPlayer" src="https://player.vimeo.com/video/' . $data->boost_video . '"
              allow="autoplay; fullscreen; picture-in-picture"
              allowfullscreen>
      </iframe>';
                    }
                    return 'No Video';
                })
                ->addColumn('updated_at', function ($data) {
                    return $data->updated_at
                        ? $data->updated_at->diffForHumans()
                        : 'N/A';
                })
                ->addColumn('action', function ($data) {
                    return '<button class="btn btn-success btn-sm edit-btn" data-id="' . $data->id . '" style="width: 50px; height: 30px; margin-right: 10px; background-color: #081210; border-color: #081210;">Edit</button>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="' . $data->id . '" style="width: 60px; height: 30px; background-color: #dc3545; border-color: #dc3545;">Delete</button>';
                })
                ->rawColumns(['description', 'thumbnail', 'base_video', 'build_video', 'boost_video', 'action'])
                ->make(true);
        }
        return view('backend.layouts.home.task.index');
    }

    public function create(Request $request)
    {
        return view('backend.layouts.home.task.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'achievement' => 'required|string',
            'person_focus' => 'required|string',
            'person_focus_description' => 'required|string',
            'player_focus' => 'required|string',
            'player_focus_description' => 'required|string',
            'phase' => 'required|string',
            'starting_date' => 'nullable|date',
            'ending_date' => 'nullable|date|after_or_equal:start_date',
            'thumbnail' => 'nullable|file|mimes:jpeg,jpg,png|max:51200',
            'base_video' => 'nullable|file|mimes:mp4,mov,avi|max:204800',
            'build_video' => 'nullable|file|mimes:mp4,mov,avi|max:204800',
            'boost_video' => 'nullable|file|mimes:mp4,mov,avi|max:204800',
        ]);

        try {
            DB::beginTransaction();
            // Handle thumbnail upload
            $thumbnail = null;
            if ($request->hasFile('thumbnail')) {
                $imagePath = Helper::fileUpload($request->file('thumbnail'), 'task', time() . '_' . $request->file('thumbnail')->getClientOriginalName());
                $thumbnail = $imagePath;
            }

            // Initialize video variables
            $baseVideoId = null;
            $buildVideoId = null;
            $boostVideoId = null;
            $hasVideos = false;

            // Upload base_video to Vimeo if provided
            if ($request->hasFile('base_video')) {
                $hasVideos = true;
                $baseUri = Vimeo::upload($request->file('base_video')->getPathname(), [
                    'name' => $request->title . ' - Base Video',
                    'description' => 'Base video for ' . $request->title,
                    'privacy' => [
                        'view' => 'anybody'
                    ],
                    'embed' => [
                        'title' => [
                            'name' => 'hide',
                            'owner' => 'hide',
                            'portrait' => 'hide'
                        ],
                        'buttons' => [
                            'like' => false,
                            'share' => false,
                            'embed' => false
                        ],
                        'logos' => [
                            'vimeo' => false,
                        ],
                    ]
                ]);
                $baseVideoId = basename($baseUri);
            }

            // Upload build_video to Vimeo if provided
            if ($request->hasFile('build_video')) {
                $hasVideos = true;
                $buildUri = Vimeo::upload($request->file('build_video')->getPathname(), [
                    'name' => $request->title . ' - Build Video',
                    'description' => 'Build video for ' . $request->title,
                    'privacy' => [
                        'view' => 'anybody'
                    ],
                    'embed' => [
                        'title' => [
                            'name' => 'hide',
                            'owner' => 'hide',
                            'portrait' => 'hide'
                        ],
                        'buttons' => [
                            'like' => false,
                            'share' => false,
                            'embed' => false
                        ],
                        'logos' => [
                            'vimeo' => false,
                        ],
                    ]
                ]);
                $buildVideoId = basename($buildUri);
            }

            // Upload boost_video to Vimeo if provided
            if ($request->hasFile('boost_video')) {
                $hasVideos = true;
                $boostUri = Vimeo::upload($request->file('boost_video')->getPathname(), [
                    'name' => $request->title . ' - Boost Video',
                    'description' => 'Boost video for ' . $request->title,
                    'privacy' => [
                        'view' => 'anybody'
                    ],
                    'embed' => [
                        'title' => [
                            'name' => 'hide',
                            'owner' => 'hide',
                            'portrait' => 'hide'
                        ],
                        'buttons' => [
                            'like' => false,
                            'share' => false,
                            'embed' => false
                        ],
                        'logos' => [
                            'vimeo' => false,
                        ],
                    ]
                ]);
                $boostVideoId = basename($boostUri);
            }


            // Insert the new task into the database
            $task = Task::create([
                'title' => $request->title,
                'description' => $request->description,
                'achievement' => $request->achievement,
                'person_focus' => $request->person_focus,
                'person_focus_description' => $request->person_focus_description,
                'player_focus' => $request->player_focus,
                'player_focus_description' => $request->player_focus_description,
                'phase' => $request->phase,
                'starting_date' => $request->starting_date,
                'ending_date' => $request->ending_date,
                'thumbnail' => $thumbnail,
                'base_video' => $baseVideoId,
                'build_video' => $buildVideoId,
                'boost_video' => $boostVideoId,
                'status' => 'processing'
            ]);

            DB::commit();

            // If videos were uploaded, dispatch job to check processing status
            if ($hasVideos) {
                CheckVimeoVideoStatusJob::dispatch($task->id)->delay(now()->addMinute());
            }

            // Redirect or return response
            return redirect()->route('user.task.index')->with('success', 'Task created successfully.');
        } catch (\Exception $exception) {
            DB::rollBack();

            // Clean up any videos that might have been uploaded to Vimeo
            $this->cleanupVimeoVideos([$baseVideoId ?? null, $buildVideoId ?? null, $boostVideoId ?? null]);

            Log::error('Task creation failed', [
                'error' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'Task creation failed: ' . $exception->getMessage());
        }
    }

    public function edit(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        return view('backend.layouts.home.task.edit', compact('task'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'achievement' => 'nullable|string',
            'person_focus' => 'required|string',
            'person_focus_description' => 'required|string',
            'player_focus' => 'required|string',
            'player_focus_description' => 'required|string',
            'phase' => 'required|string',
            'starting_date' => 'nullable|date',
            'ending_date' => 'nullable|date|after_or_equal:start_date',
            'thumbnail' => 'nullable|file|mimes:jpeg,jpg,png|max:51200',
            'base_video' => 'nullable|file|mimes:mp4,mov,avi|max:204800',
            'build_video' => 'nullable|file|mimes:mp4,mov,avi|max:204800',
            'boost_video' => 'nullable|file|mimes:mp4,mov,avi|max:204800',
        ]);

        try {
            // Start transaction
            DB::beginTransaction();

            // Fetch the task to update
            $task = Task::find($request->id);
            if (!$task) {
                return redirect()->route('user.task.index')->with('t-error', 'Task not found!');
            }

            // Update task details
            $task->title = $request->title;
            $task->description = $request->description;
            $task->achievement = $request->achievement;
            $task->person_focus = $request->person_focus;
            $task->person_focus_description = $request->person_focus_description;
            $task->player_focus = $request->player_focus;
            $task->player_focus_description = $request->player_focus_description;
            $task->phase = $request->phase;
            $task->starting_date = $request->starting_date;
            $task->ending_date = $request->ending_date;

            // Handle thumbnail upload if exists
            if ($request->hasFile('thumbnail')) {
                $imagePath = Helper::fileUpload($request->file('thumbnail'), 'task', time() . '_' . $request->file('thumbnail')->getClientOriginalName());
                if ($imagePath !== null) {
                    // Delete old thumbnail if exists
                    Helper::fileDelete($task->thumbnail);
                    $task->thumbnail = $imagePath;
                }
            }

            $hasNewVideos = false;

            // Handle base_video upload
            if ($request->hasFile('base_video')) {
                $hasNewVideos = true;

                // Delete old video from Vimeo if exists
                if ($task->base_video) {
                    $this->deleteVimeoVideo($task->base_video);
                }

                // Upload new video to Vimeo
                $baseUri = Vimeo::upload($request->file('base_video')->getPathname(), [
                    'name' => $task->title . ' - Base Video',
                    'description' => 'Base video for ' . $task->title,
                    'privacy' => [
                        'view' => 'anybody'
                    ],
                    'embed' => [
                        'title' => [
                            'name' => 'hide',
                            'owner' => 'hide',
                            'portrait' => 'hide'
                        ],
                        'buttons' => [
                            'like' => false,
                            'share' => false,
                            'embed' => false
                        ],
                        'logos' => [
                            'vimeo' => false,
                        ],
                    ]
                ]);
                $task->base_video = basename($baseUri);
            }

            // Handle build_video upload
            if ($request->hasFile('build_video')) {
                $hasNewVideos = true;

                // Delete old video from Vimeo if exists
                if ($task->build_video) {
                    $this->deleteVimeoVideo($task->build_video);
                }

                // Upload new video to Vimeo
                $buildUri = Vimeo::upload($request->file('build_video')->getPathname(), [
                    'name' => $task->title . ' - Build Video',
                    'description' => 'Build video for ' . $task->title,
                    'privacy' => [
                        'view' => 'anybody'
                    ],
                    'embed' => [
                        'title' => [
                            'name' => 'hide',
                            'owner' => 'hide',
                            'portrait' => 'hide'
                        ],
                        'buttons' => [
                            'like' => false,
                            'share' => false,
                            'embed' => false
                        ],
                        'logos' => [
                            'vimeo' => false,
                        ],
                    ]
                ]);
                $task->build_video = basename($buildUri);
            }

            // Handle boost_video upload
            if ($request->hasFile('boost_video')) {
                $hasNewVideos = true;

                // Delete old video from Vimeo if exists
                if ($task->boost_video) {
                    $this->deleteVimeoVideo($task->boost_video);
                }

                // Upload new video to Vimeo
                $boostUri = Vimeo::upload($request->file('boost_video')->getPathname(), [
                    'name' => $task->title . ' - Boost Video',
                    'description' => 'Boost video for ' . $task->title,
                    'privacy' => [
                        'view' => 'anybody'
                    ],
                    'embed' => [
                        'title' => [
                            'name' => 'hide',
                            'owner' => 'hide',
                            'portrait' => 'hide'
                        ],
                        'buttons' => [
                            'like' => false,
                            'share' => false,
                            'embed' => false
                        ],
                        'logos' => [
                            'vimeo' => false,
                        ],
                    ]
                ]);
                $task->boost_video = basename($boostUri);
            }

            // If new videos were uploaded, set status to processing
            if ($hasNewVideos) {
                $task->status = 'processing';
            }

            $task->save();
            DB::commit();

            // If new videos were uploaded, dispatch job to check processing status
            if ($hasNewVideos) {
                CheckVimeoVideoStatusJob::dispatch($task->id)->delay(now()->addMinute());
            }

            return redirect()->route('user.task.index')->with('t-success', 'Data Updated Successfully');

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Task update failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('user.task.index')->with('t-error', 'Data update failed! ' . $e->getMessage());
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            DB::beginTransaction();

            $task = Task::findOrFail($id);

            // Delete videos from Vimeo
            if ($task->base_video) {
                $this->deleteVimeoVideo($task->base_video);
            }

            if ($task->build_video) {
                $this->deleteVimeoVideo($task->build_video);
            }

            if ($task->boost_video) {
                $this->deleteVimeoVideo($task->boost_video);
            }

            // Delete thumbnail if exists
            if ($task->thumbnail && file_exists(public_path($task->thumbnail))) {
                Helper::fileDelete(public_path($task->thumbnail));
            }

            // Delete the task
            $task->delete();

            DB::commit();
            return $this->success('Task deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Task deletion failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return $this->error('Failed to delete the task: ' . $e->getMessage(), 'error');
        }
    }

    /**
     * Delete a video from Vimeo
     *
     * @param string $videoId
     * @return bool
     */
    private function deleteVimeoVideo(string $videoId)
    {
        if (!$videoId) {
            return false;
        }

        try {
            Vimeo::request('/videos/' . $videoId, [], 'DELETE');
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to delete Vimeo video', [
                'video_id' => $videoId,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Clean up multiple Vimeo videos
     *
     * @param array $videoIds
     * @return void
     */
    private function cleanupVimeoVideos(array $videoIds)
    {
        foreach ($videoIds as $videoId) {
            if ($videoId) {
                $this->deleteVimeoVideo($videoId);
            }
        }
    }


}
