@extends('backend.app')

@section('title', 'User List')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">User List</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">User List</a></li>
            </ol>
        </div>
    </div>
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-header">
                <h4>User Information</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="datatable">
                    <thead>
                        <tr>

                            <th>SL</th>
                            <th>User Name</th>
                            <th>User Email</th>
                            <th>Date Of Birth</th>
                            <th>Gender</th>
                            <th>Club</th>
                            <th>Position</th>
                            <th>Preferred Foot</th>
                            <th>Favourite Club</th>
                            <th>Favourite Player</th>
                            <th>Created at</th>
                            <th>Duration </th>
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
            if (!$.fn.DataTable.isDataTable('#datatable')) {
                let dTable = $('#datatable').DataTable({
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
                        url: "{{ route('user_list.index') }}",
                        type: "GET",
                    },

                        columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'name',
                            name: 'name',
                            orderable: false,
                            searchable: true
                        },
                        {
                            data: 'email',
                            name: 'email',
                            orderable: false,
                            searchable: true
                        },
                        {
                            data: 'date_of_birth',
                            name: 'date_of_birth',
                            orderable: false,
                            searchable: true
                        },
                        {
                            data: 'gender',
                            name: 'gender',
                            orderable: false,
                            searchable: true
                        },
                        {
                            data: 'club',
                            name: 'club',
                            orderable: false,
                            searchable: true
                        },
                        {
                            data: 'position',
                            name: 'position',
                            orderable: false,
                            searchable: true
                        },
                        {
                            data: 'preferred_foot',
                            name: 'preferred_foot',
                            orderable: false,
                            searchable: true
                        },
                        {
                            data: 'favourite_club',
                            name: 'favourite_club',
                            orderable: false,
                            searchable: true
                        },
                        {
                            data: 'favourite_player',
                            name: 'favourite_player',
                            orderable: false,
                            searchable: true
                        },
                        {
                            data: 'created_at',
                            name: 'created_at',
                            orderable: false,
                            searchable: true
                        },
                        {
                            data: 'updated_at',
                            name: 'updated_at',
                            orderable: false,
                            searchable: true
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],
                });
            }

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
                        url: "/user/delete/" + userId,
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
    </script>
@endpush
