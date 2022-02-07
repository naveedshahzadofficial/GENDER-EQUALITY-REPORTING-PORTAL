@extends('layouts.main')
@push('title', 'Voluntary National Report')
@push('breadcrumb-items')
    <li class="breadcrumb-item">
        <a class="text-muted">Voluntary National Report</a>
    </li>
@endpush
@section('content')
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Dashboard-->
            <!--begin::Row-->

            <div class="card card-custom">
                <div class="card-header flex-wrap border-0 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Voluntary National Report</h3>
                    </div>
                    @if(auth()->user()->isDepartment())
                        <div class="card-toolbar">
                        <!--begin::Button-->
                        <a href="{{ route('voluntary-national-report.create') }}" class="btn btn-primary bg-white btn-outline-white text-danger font-weight-bolder">New Voluntary National Report</a>
                        <!--end::Button-->
                    </div>
                    @endif
                </div>
                <div class="card-body">
                @component('_components.alerts-default') @endcomponent
                <!--begin: Search Form-->
                    <!--begin: Datatable-->
                    <table class="table  data-table table-separate table-head-custom table-checkable" id="my_datatable">
                        <thead>
                        <tr>
                            <th>No</th>
                            @if(!auth()->user()->isDepartment())
                                <th>Department</th>
                            @endif
                            <th>Target</th>
                            <th>Project</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>

                    </table>
                    <!--end: Datatable-->
                </div>
            </div>


            <!--end::Row-->
            <!--begin::Row-->

            <!--end::Row-->
            <!--end::Dashboard-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection

@push('post-scripts')
    <script type="text/javascript">
        var myDataTable;
        $(function () {

            myDataTable = $('#my_datatable').DataTable({
                responsive: true,
                language: {
                    infoFiltered: ""
                },
                processing: true,
                pageLength: 30,
                serverSide: true,
                searching: true,
                ajax: {
                    url: '{{ route('voluntary-national-report.index') }}',
                    type: "GET",
                    data: function (row) {
                        row.test = 1;
                    }
                },
                columns: [
                    {data: 'id', searchable: false, visible: false, printable: false},
                        @if(!auth()->user()->isDepartment())
                    {data: 'department_name', name: 'department_name'},
                        @endif
                    {data: 'target_value', name: 'target_value'},
                    {data: 'project_title', name: 'project.project_title'},
                    {data: 'start_date', name: 'start_date', class: 'text-center'},
                    {data: 'end_date', name: 'end_date', class: 'text-center'},
                    {data: 'status', name: 'status', class: 'text-center'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, class: 'text-center not-exported'},
                ],
                order: [[0, 'desc']],
                dom: 'Blfrtip',

                lengthMenu: [
                    [10, 20, 30, 50, 100, -1],
                    ['10', '20', '30', '50', '100', 'All']
                ],
                buttons: [
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        titleAttr: 'Print',
                        charset: "utf-8",
                        "bom": "true",
                        className: 'btn btn-xs',
                        exportOptions: {
                            columns: ':visible:not(.not-exported)',
                            modifier: {
                                search: 'applied',
                                order: 'applied',
                                page: 'all'
                            }
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fa fa-file-csv"></i>',
                        titleAttr: 'CSV',
                        charset: "utf-8",
                        "bom": "true",
                        className: 'btn btn-xs',
                        exportOptions: {
                            columns: ':visible:not(.not-exported)',
                            modifier: {
                                search: 'applied',
                                order: 'applied',
                                page: 'all'
                            }
                        }

                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel"></i>',
                        titleAttr: 'Excel',
                        charset: "utf-8",
                        "bom": "true",
                        className: 'btn btn-xs',
                        exportOptions: {
                            columns: ':visible:not(.not-exported)',
                            modifier: {
                                search: 'applied',
                                order: 'applied',
                                page: 'all'
                            }
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf"></i>',
                        titleAttr: 'PDF',
                        charset: "utf-8",
                        "bom": "true",
                        className: 'btn btn-xs',
                        exportOptions: {
                            columns: ':visible:not(.not-exported)',
                            modifier: {
                                search: 'applied',
                                order: 'applied',
                                page: 'all'
                            }
                        }
                    }
                ],
            });

        });


    </script>
@endpush
