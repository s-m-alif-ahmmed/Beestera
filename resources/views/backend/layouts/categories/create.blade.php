@extends('backend.app')

@section('title', 'Create Category')


@section('content')

    <div class="container-fluid">
        <div class="mt-4 row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create Category</h3>
                    </div>
                    <div class="p-5">
                        <form action="{{ route('category.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <select class="form-control" id="type" name="type" required>
                                    <option value="" selected disabled>Select Type</option>
                                    <option value="Train">Train</option>
                                    <option value="Learn">Learn</option>
                                </select>
                            </div>


                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <textarea class="form-control" id="name" name="name" rows="3" placeholder="Enter name"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Create Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

{{-- @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
@endpush --}}
