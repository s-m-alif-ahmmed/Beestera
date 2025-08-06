@extends('backend.app')

@section('title', 'Edit Learn  Content')

@section('content')
    <div class="container-fluid">
        <div class="mt-4 row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Learn Content</h3>
                    </div>
                    <div class="p-5">
                        <form action="{{ route('learn.content.update', $learn->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Enter Title" value="{{ old('title', $learn->title) }}">
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter Description">{{ old('description', $learn->description) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-control" id="category" name="category" required>
                                    <option value="" disabled>Select a Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->name }}"
                                            {{ isset($learn) && $learn->category == $category->name ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="thumbnail" class="form-label">Thumbnail:</label>
                                        <input type="file" class="dropify @error('thumbnail') is-invalid @enderror"
                                            name="thumbnail" id="thumbnail"
                                            data-default-file="{{ isset($learn->thumbnail) ? asset($learn->thumbnail) : '' }}">
                                        @error('thumbnail')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="summernote" class="form-label">Details:</label>
                                    <textarea class="form-control @error('details') is-invalid @enderror" id="summernote" name="details"
                                        placeholder="Details">{{ old('details', $learn->details ?? '') }}</textarea>
                                    @error('details')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="vimeo_id" class="form-label">Vimeo ID</label>
                                    <input type="text" class="form-control" id="youtube_link" name="vimeo_id"
                                        placeholder="Enter Vimeo ID"
                                        value="{{ old('vimeo_id', $learn->vimeo_id ?? '') }}">
                                </div>



                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="active"
                                            {{ old('status', $learn->status) == 'active' ? 'selected' : '' }}>
                                            Active</option>
                                        <option value="inactive"
                                            {{ old('status', $learn->status) == 'inactive' ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Update Learn</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
