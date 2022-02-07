<?php
/**
 * Project: hajjtrack.
 * User: naveed
 * Date: 12/07/2018
 * Time: 1:21 PM
 */
?>
@if(isset($errors) && $errors->any())
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
            <span class="sr-only">Close</span>
        </button>
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

@if(session()->has('error_message'))
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
            <span class="sr-only">Close</span>
        </button>
        <strong>Error!</strong>  {{ session()->get('error_message') }}
    </div>
@endif
@if(session()->has('success_message'))
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
            <span class="sr-only">Close</span>
        </button>
        <strong>Success!</strong>  {{ session()->get('success_message') }}
    </div>
@endif

@if(session()->has('warning_message'))
    <div class="alert alert-warning" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
            <span class="sr-only">Close</span>
        </button>
        <strong>Warning!</strong> {{ session()->get('warning_message') }}
    </div>
@endif

@if(session()->has('custom_messages'))
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
            <span class="sr-only">Close</span>
        </button>
        <strong style="font-size: 16px;">Please correct the following errors before continuing!</strong><br>
        <ul>
            {!! session()->get('custom_messages') !!}
        </ul>
    </div>
@endif
