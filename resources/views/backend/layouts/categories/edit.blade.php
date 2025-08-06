@extends('backend.app')

@section('title', 'Edit Categories')

@section('content')
    <div class="container-fluid">
        <div class="mt-4 row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Category</h3>
                    </div>
                    <div class="p-5">
                        <form action="{{ route('category.update', $categories->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <input type="text" class="form-control" id="type" name="type"
                                    placeholder="Enter type" value="{{ old('type', $categories->type) }}">
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <textarea class="form-control" id="name" name="name" rows="3" placeholder="Enter name">{{ old('name', $categories->name) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="active" {{ old('status', $categories->status) == 'active' ? 'selected' : '' }}>
                                        Active</option>
                                    <option value="inactive"
                                        {{ old('status', $categories->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
