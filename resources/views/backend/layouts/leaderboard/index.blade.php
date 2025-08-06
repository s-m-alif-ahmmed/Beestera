@extends('backend.app')

@section('title', 'LeaderBoard')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">LeaderBoard</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">LeaderBoard</a></li>
            </ol>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>LeaderBoard</h4>
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
                    <div class="col-md-1">
                        <label for="ageFilter" class="form-label fw-bold">Filter by Age:</label>
                        <select id="ageFilter" class="form-select">
                            <option value="">All</option>
                            <option value="1">6 - 8</option>
                            <option value="2">9 - 11</option>
                            <option value="3">12 - 14</option>
                            <option value="4">15 - 20</option>
                        </select>
                    </div>

                </div>


                <table class="table table-bordered" id="datatable">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Task Name</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Club</th>
                            <th>Total Point</th>
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
                },
            });

            var table = $('#datatable').DataTable({
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
                    url: "{{ route('user.leaderboard') }}",
                    type: "GET",
                    data: function(d) {
                        d.task_id = $('#taskFilter').val();
                        d.age = $('#ageFilter').val();
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
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
                        data: 'user_name',
                        name: 'user_name',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'email',
                        name: 'email',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'club',
                        name: 'club',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'user_point',
                        name: 'user_point',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true ,
                        searchable: true ,
                    }
                ],
            });

            // Handle filter change
            $('#taskFilter, #ageFilter').on('change', function() {
                table.ajax.reload(null, false); // Reload data without resetting pagination
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
                            url: "/leaderboard/delete/" + userId,
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
