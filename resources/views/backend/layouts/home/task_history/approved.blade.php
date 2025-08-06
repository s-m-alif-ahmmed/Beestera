@extends('backend.app')

@section('title', 'LeaderBoard')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Task Approved List</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Approved List</a></li>
            </ol>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <h4>Task List</h4>
            </div>
            <div class="card-body">
                <div class="mb-3 row">
                    <div class="col-md-1 ms-auto">
                        <label for="taskFilter" class="form-label fw-bold">Filter by Task:</label>
                        <select id="taskFilter" class="form-select">
                            <option value="">All Tasks</option>
                            @foreach ($tasks as $task)
                                <option value="{{ $task->id }}">{{ $task->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <table class="table table-bordered" id="datatable">
                    <thead>
                        <tr>
                            <th>SL</th>
                            {{-- <th>User ID</th> --}}
                            <th>User Name</th>
                            <th>Task Name</th>
                            <th>Base-1</th>
                            <th>Base-2</th>
                            <th>Base-3</th>
                            <th>Build-1</th>
                            <th>Build-2</th>
                            <th>Build-3</th>
                            <th>User Video</th>
                            <th>User Point</th>
                            <th>Time</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    {{-- Filter Ajax Start --}}

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                }
            });

            let table = $('#datatable').DataTable({
                order: [],
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                processing: true,
                responsive: true,
                serverSide: true,
                language: {
                    processing: `<div class="text-center">
                        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>`
                },
                scroller: {
                    loadingIndicator: false
                },
                pagingType: "full_numbers",
                dom: "<'row justify-content-between table-topbar'<'col-md-2 col-sm-4 px-0'l><'col-md-2 col-sm-4 px-0'f>>tipr",
                ajax: {
                    url: "{{ route('user.approved.task') }}",
                    type: "GET",
                    data: function(d) {
                        d.task_id = $('#taskFilter').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'user_name',
                        name: 'user_name',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'title',
                        name: 'title',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'base_1',
                        name: 'base_1',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'base_2',
                        name: 'base_2',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'base_3',
                        name: 'base_3',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'build_1',
                        name: 'build_1',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'build_2',
                        name: 'build_2',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'build_3',
                        name: 'build_3',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'user_video',
                        name: 'user_video',
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: 'user_point',
                        name: 'user_point',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    }
                ],
            });

            $('#taskFilter').on('change', function() {
                table.ajax.reload();
            });
            $(document).on('click', '.delete-btn', function() {
                var userId = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you want to Delete this user?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Delete it!',
                    cancelButtonText: 'No, Cancel',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/approved-task/delete/" + userId,
                            method: 'DELETE', // Correct method
                            data: {
                                _token: $('meta[name="csrf-token"]').attr(
                                    'content') // CSRF token
                            },
                            success: function(response) {
                                if (response.success) {
                                    toastr.success('User Deleted!');
                                    $('#datatable').DataTable().ajax.reload();
                                } else {
                                    toastr.error(response.message);
                                }
                            },
                            error: function(xhr) {
                                toastr.error('Something went wrong!');
                            }
                        });
                    } else {
                        Swal.fire('Cancelled', 'Task Delete was cancelled.', 'info');
                    }
                });
            });
        });
    </script>
@endpush
