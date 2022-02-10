@extends('layouts.main')
@push('title', 'Detail Print Media Reporting')
@push('breadcrumb-items')
    <li class="breadcrumb-item">
        <a href="{{ route('print-media-reporting.index') }}" class="text-muted">Print Media Reporting</a>
    </li>
    <li class="breadcrumb-item">
        <a class="text-muted">Detail</a>
    </li>
@endpush
@section('content')
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="">
                <div class="">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b ">
                        <div class="card-header">
                            <h3 class="card-title">Detail Print Media Reporting</h3>

                        </div>
                        <div class="card-body">
                            <div class="row mt-10">
                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Content type published:</strong></div>
                                        <div
                                            class="col-md-6 value">{{ $printMediaReporting->published_content_type }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Name of Newspaper/Magazine:</strong></div>
                                        <div
                                            class="col-md-6 value">{{ $printMediaReporting->name_of_newspaper_magazine }}</div>
                                    </div>
                                </div>

                            </div>
                            <div class="row mt-10">
                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Title/Subject:</strong></div>
                                        <div class="col-md-6 value">{{ $printMediaReporting->title }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Publishing Date:</strong></div>
                                        <div class="col-md-6 value">{{ $printMediaReporting->date_of_publishing }}</div>
                                    </div>
                                </div>

                            </div>
                            <div class="row mt-10">
                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Online URL:</strong></div>
                                        <div class="col-md-6 value">{{ $printMediaReporting->online_url }}</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Evidence:</strong></div>
                                        <div class="col-md-6 value"> @if(!empty($printMediaReporting->evidence))&nbsp;<a href="{{ Storage::url($printMediaReporting->evidence) }}" target="_blank">View File</a> @endif</div>
                                    </div>
                                </div>

                            </div>
                            <div class="row mt-10">
                                <div class="col-md-6">
                                    <div class="static-info row">
                                        <div class="col-md-6 name"><strong>Status:</strong></div>
                                        <div
                                            class="col-md-6 value">{{ $printMediaReporting->status }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (auth()->user()->isEvaluator())
                    <div class="card card-custom gutter-b">
                        <div class="card-header">
                            <h3 class="card-title">Activity Evaluation</h3>

                        </div>

                        <!--begin::Form-->
                        {!! Form::open(array('id'=>'form_add_edit','route' => ['print-media-reporting.evaluation.store', $printMediaReporting],'method'=>'POST')) !!}
                        <input type="hidden" name="print_id" value="{{ $printMediaReporting->id }}">
                        <div class="card-body">
                            <div class="row form-group">
                                <div class="col-lg-6">
                                    <label>Evaluation <span class="color-red-700">*</span></label>
                                    <div class="col-form-label">
                                        <div class="radio-inline">
                                            <label class="radio radio-primary">
                                                <input type="radio" name="evaluation" value="1" {{ old('evaluation', $printMediaReporting->evaluation)==1?'checked':'' }}>
                                                <span></span>1 Mark</label>
                                            <label class="radio radio-primary">
                                                <input type="radio" name="evaluation" value="2" {{ old('evaluation', $printMediaReporting->evaluation)==2?'checked':'' }}>
                                                <span></span>2 Marks</label>
                                            <label class="radio radio-primary">
                                                <input type="radio" name="evaluation" value="3" {{ old('evaluation', $printMediaReporting->evaluation)==3?'checked':'' }}>
                                                <span></span>3 Marks</label>
                                            <label class="radio radio-primary">
                                                <input type="radio" name="evaluation" value="4" {{ old('evaluation', $printMediaReporting->evaluation)==4?'checked':'' }}>
                                                <span></span>4 Marks</label>
                                            <label class="radio radio-primary">
                                                <input type="radio" name="evaluation" value="5" {{ old('evaluation', $printMediaReporting->evaluation)==5?'checked':'' }}>
                                                <span></span>5 Marks</label>
                                        </div>
                                        @error('plot_type')
                                        <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Comments<span class="color-red-700">*</span></label>
                                    <textarea name="evaluation_comments" id="evaluation_comments" class="form-control" cols="30" rows="2">{{ old('evaluation_comments')!=null?old('evaluation_comments'):(isset($printMediaReporting->evaluation_comments)?$printMediaReporting->evaluation_comments:'') }}</textarea>
                                    @error('$printMediaReporting')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <a href="{{ route('print-media-reporting.index') }}"  class="btn btn-secondary">Cancel</a>
                        </div>
                    {!! Form::close() !!}
                    <!--end::Form-->
                    </div>
                    @endif

                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->

@endsection

