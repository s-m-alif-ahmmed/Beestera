@extends('backend.app')

@section('title', 'Home - Player Task')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Home - Player Task</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Task</a></li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER --}}

    <div class="col">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('user.task.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title" class="form-label">Task Name:</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        name="title" placeholder="Enter here Task Name" id="title"
                                        value="{{ old('title')}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description" class="form-label">Task Details</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                                        placeholder="Enter here Task Description" id="description" rows="4">{{ old('description')}}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3 d-flex justify-content-between">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="achievement" class="form-label">Achievement</label>
                                    <input type="text" class="form-control @error('achievement') is-invalid @enderror"
                                        name="achievement" placeholder="Enter here Task Achievement" id="achievement"
                                        value="{{ old('achievement')}}">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="person_focus" class="form-label">Person Focus</label>
                                    <input type="text" class="form-control @error('person_focus') is-invalid @enderror"
                                        name="person_focus" placeholder="Enter here Person Focus" id="person_focus"
                                        value="{{ old('person_focus')}}">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="person_focus_description" class="form-label">Person Focus Description</label>
                                    <input type="text" class="form-control @error('person_focus_description') is-invalid @enderror"
                                        name="person_focus_description" placeholder="Enter here Person Focus Description" id="person_focus_description"
                                        value="{{ old('person_focus_description')}}">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="player_focus" class="form-label">Player Focus</label>
                                    <input type="text" class="form-control @error('player_focus') is-invalid @enderror"
                                        name="player_focus" placeholder="Enter here Player Focus" id="player_focus"
                                        value="{{ old('player_focus')}}">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="player_focus_description" class="form-label">Player Focus Description</label>
                                    <input type="text" class="form-control @error('player_focus_description') is-invalid @enderror"
                                        name="player_focus_description" placeholder="Enter here Player Focus Description" id="player_focus_description"
                                        value="{{ old('player_focus_description')}}">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="phase" class="form-label">Phase</label>
                                    <input type="text" class="form-control @error('phase') is-invalid @enderror"
                                        name="phase" placeholder="Enter here Task Phase" id="phase"
                                        value="{{ old('phase')}}">
                                </div>
                            </div>

                            <div class="col-md-2" >
                                <div class="form-group">
                                    <label for="starting_date" class="form-label">Starting Date</label>
                                    <input type="date" class="form-control @error('starting_date') is-invalid @enderror"
                                        name="starting_date" id="starting_date"
                                        value="{{ old('starting_date')}}">
                                </div>
                            </div>

                            <div class="col-md-2" >
                                <div class="form-group">
                                    <label for="ending_date" class="form-label">Ending Date</label>
                                    <input type="date" class="form-control @error('ending_date') is-invalid @enderror"
                                        name="ending_date" id="ending_date"
                                        value="{{ old('ending_date')}}">
                                </div>
                            </div>

                        </div>



                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="thumbnail" class="form-label">Thumbnail:</label>
                                    <input type="file" class="dropify @error('thumbnail') is-invalid @enderror"
                                        name="thumbnail" id="thumbnail"
                                        data-default-file="{{ isset($task->thumbnail) ? asset($task->thumbnail) : '' }}">
                                    @error('thumbnail')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="base_video" class="form-label">Base Video:</label>
                                    <input type="file" class="dropify @error('base_video') is-invalid @enderror"
                                        name="base_video" id="base_video"
                                        data-default-file="{{ isset($task->base_video) ? asset($task->base_video) : '' }}">
                                    @error('base_video')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="build_video" class="form-label">Build Video:</label>
                                    <input type="file" class="dropify @error('build_video') is-invalid @enderror"
                                        name="build_video" id="build_video"
                                        data-default-file="{{ isset($task->build_video) ? asset($task->build_video) : '' }}">
                                    @error('build_video')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="boost_video" class="form-label">Boost Video:</label>
                                    <input type="file" class="dropify @error('boost_video') is-invalid @enderror"
                                        name="boost_video" id="boost_video"
                                        data-default-file="{{ isset($task->boost_video) ? asset($task->boost_video) : '' }}">
                                    @error('boost_video')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12 text-center">
                                <button class="btn btn-primary" type="button" onclick="window.location.href='{{ route('user.task.index') }}'">Back</button>
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
