@extends('layouts.main')
@push('title', 'Dashboard')
@section('content')
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Dashboard-->
        <div class="card card-custom">
            <div class="card card-custom">
                <div class="card-header flex-wrap border-0 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Dashboard</h3>
                    </div>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
        <!--end::Dashboard-->
    </div>
    <!--end::Container-->
</div>
@endsection
@push('post-scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>

        // Create the chart

    </script>

@endpush



