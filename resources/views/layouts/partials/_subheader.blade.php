<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
{{--                <!--begin::Page Title-->--}}
{{--                <h5 class="text-dark font-weight-bold my-1 mr-5">Dashboard</h5>--}}
{{--                <!--end::Page Title-->--}}
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-muted">Dashboard</a>
                    </li>
                    @stack('breadcrumb-items')
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->

    </div>
</div>
<!--end::Subheader-->
