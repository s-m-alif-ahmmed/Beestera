@extends('backend.app')

@section('title', 'Edit Achievement Content')

@section('content')
    <div class="container-fluid">
        <div class="mt-4 row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Achievement Content</h3>
                    </div>
                    <div class="p-5">
                        <form action="{{ route('achievement.content.update', $achievement->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Enter Title" value="{{ old('title', $achievement->title) }}">
                            </div>

                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-control" id="category" name="category" required>
                                    <option value="MOVEMENT" {{ isset($achievement) && $achievement->category == 'MOVEMENT' ? 'selected' : '' }}>MOVEMENT</option>
                                    <option value="MANIPULATION" {{ isset($achievement) && $achievement->category == 'MANIPULATION' ? 'selected' : '' }}>MANIPULATION</option>
                                    <option value="CONTROL" {{ isset($achievement) && $achievement->category == 'CONTROL' ? 'selected' : '' }}>CONTROL</option>
                                    <option value="STRIKING" {{ isset($achievement) && $achievement->category == 'STRIKING' ? 'selected' : '' }}>STRIKING</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="logo_1" class="form-label">Logo_1:</label>
                                        <input type="file" class="dropify @error('logo_1') is-invalid @enderror"
                                            name="logo_1" id="logo_1"
                                            data-default-file="{{ isset($achievement->logo_1) ? asset($achievement->logo_1) : '' }}">
                                        @error('logo_1')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="logo_2" class="form-label">Logo_2:</label>
                                        <input type="file" class="dropify @error('logo_2') is-invalid @enderror"
                                            name="logo_2" id="logo_2"
                                            data-default-file="{{ isset($achievement->logo_2) ? asset($achievement->logo_2) : '' }}">
                                        @error('logo_2')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="active"
                                            {{ old('status', $achievement->status) == 'active' ? 'selected' : '' }}>
                                            Active</option>
                                        <option value="inactive"
                                            {{ old('status', $achievement->status) == 'inactive' ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Update Achievement</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
