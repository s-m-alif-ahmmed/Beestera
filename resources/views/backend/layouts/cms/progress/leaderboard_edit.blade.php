@extends('backend.app')

@section('title', 'CMS - Leaderboard')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">CMS - Leaderboard</h1>
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
                    <form method="POST" action="{{ route('cms.leaderboard.banner.update') }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Title Input -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title" class="form-label">Title:</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        name="title" placeholder="Enter here Title" id="title"
                                        value="{{ $cms->title ?? '' }}">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Description Input -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                                        placeholder="Enter here Description" id="description" rows="4">{{ $cms->description ?? '' }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Picture Input -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="picture" class="form-label">Picture</label>
                                    <input type="file" class="dropify @error('picture') is-invalid @enderror"
                                        name="picture" id="picture"
                                        data-default-file="{{ isset($cms->picture) ? asset($cms->picture) : '' }}">
                                    @error('picture')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="row">
                            <div class="col text-center">
                                <button class="btn btn-primary" type="button"
                                    onclick="window.location.href='{{ route('cms.leaderboard.banner') }}'">Back</button>
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
