@extends('backend.app')

@section('title', 'Task List')

@push('styles')
   <style>
       /*th {*/
       /*    width: 50px !important;*/
       /*    white-space: nowrap; / Prevent text wrapping /*/
       /*}*/

       th:nth-child(8) {
           width: 50px !important;
       }
   </style>
@endpush

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Task List</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Task List</a></li>
            </ol>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Task List</h4>
                <!-- Add Task Button -->
                <a href="{{ route('user.task.create') }}" class="btn btn-primary">Add Task</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="datatable">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Task Name</th>
                            <th>Task Description</th>
                            <th>Task Achivement</th>
                            <th>Starting Date</th>
                            <th>Ending Date</th>
                            <th>Thumbnail</th>
                            <th style="width: 50px !important;">Base Video</th>
                            <th>Build Video</th>
                            <th>Boost Video</th>
                            <th>Duration</th>
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
                $('#datatable').DataTable({
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
                        url: "{{ route('user.task.index') }}",
                        type: "GET",
                    },

                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: true,
                            searchable: true,
                        },
                        {
                            data: 'title',
                            name: 'title',
                            orderable: true,
                            searchable: true,
                        },
                        {
                            data: 'description',
                            name: 'description',
                            orderable: true,
                            searchable: true,

                        },

                        {
                            data: 'achievement',
                            name: 'achievement',
                            orderable: true,
                            searchable: true,

                        }, {
                            data: 'starting_date',
                            name: 'starting_date',
                            orderable: true,
                            searchable: true,

                        },
                        {
                            data: 'ending_date',
                            name: 'ending_date',
                            orderable: true,
                            searchable: true,

                        },
                        {
                            data: 'thumbnail',
                            name: 'thumbnail',
                            orderable: true,
                            searchable: true,
                        },
                        {
                            data: 'base_video',
                            name: 'base_video',
                            orderable: true,
                            searchable: true,
                        },
                        {
                            data: 'build_video',
                            name: 'build_video',
                            orderable: true,
                            searchable: true,
                        },
                        {
                            data: 'boost_video',
                            name: 'boost_video',
                            orderable: true,
                            searchable: true,
                        },
                        {
                            data: 'updated_at',
                            name: 'updated_at',
                            orderable: true,
                            searchable: true,
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

            // Handle Approve button click
            $(document).on('click', '.edit-btn', function() {
                var taskId = $(this).data('id');

                // Redirect to the edit page (GET method), passing the taskId to the route
                window.location.href = "{{ route('user.task.edit', ':id') }}".replace(':id', taskId);
            });
            // $(document).ready(function() {
            //     // Handle click on truncated text
            //     $(document).on('click', '.truncated-text', function() {
            //         // Get the truncated text and full description
            //         const $this = $(this);
            //         const truncatedText = $this.text();
            //         const fullDescription = $this.data('full-description');

            //         // Toggle between truncated and full description
            //         if ($this.text() === truncatedText) {
            //             $this.text(fullDescription);
            //         } else {
            //             $this.text(truncatedText);
            //         }
            //     });
            // });


            $(document).on('click', '.delete-btn', function() {
                var taskId = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you want to Delete this task?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Delete it!',
                    cancelButtonText: 'No, Cancel',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/task/delete/" + taskId,
                            method: 'DELETE', // Correct method
                            data: {
                                _token: $('meta[name="csrf-token"]').attr(
                                    'content') // CSRF token
                            },
                            success: function(response) {
                                if (response.success) {
                                    toastr.success('Task Deleted!');
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
