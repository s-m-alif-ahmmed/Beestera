@extends('backend.app')

@section('title', 'Create Achievement Contents')


@section('content')

    <div class="container-fluid">
        <div class="mt-4 row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create Achievement Content</h3>
                    </div>
                    <div class="p-5">
                        <form action="{{ route('achievement.content.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Enter Title">
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-control" id="category" name="category">
                                    <option value="MOVEMENT">MOVEMENT</option>
                                    <option value="MANIPULATION">MANIPULATION</option>
                                    <option value="CONTROL">CONTROL</option>
                                    <option value="STRIKING">STRIKING</option>
                                </select>
                            </div>

                            {{-- <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter Description"></textarea>
                            </div> --}}

                            {{-- <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-control" id="category" name="category" required>
                                </select>
                            </div> --}}

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="logo_1" class="form-label">Logo_1:</label>
                                        <input type="file" class="dropify @error('logo_1') is-invalid @enderror"
                                            name="logo_1" id="logo_1"
                                            data-default-file="">
                                        @error('logo_1')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="logo_2" class="form-label">Logo_2:</label>
                                        <input type="file" class="dropify @error('logo_2') is-invalid @enderror"
                                            name="logo_2" id="logo_2"
                                            data-default-file="">
                                        @error('logo_2')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="form-group">
                                <label for="summernote" class="form-label">Details:</label>
                                <textarea class="form-control @error('details') is-invalid @enderror" id="summernote" name="details"
                                    placeholder="Details"></textarea>
                                @error('details')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> --}}

                            {{-- <div class="mb-3">
                                <label for="youtube_link" class="form-label">Youtube Link</label>
                                <input type="text" class="form-control" id="youtube_link" name="youtube_link"
                                    placeholder="Enter Youtube Link">
                            </div> --}}


                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Create Content</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

