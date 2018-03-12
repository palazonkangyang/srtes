@extends('layout.master')
@section('title','Error')
@section('content')

<div class="row">
    <div class="col-md-12"><h4 class="page-head-line">Page Error</h4></div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-danger">
            <strong>Error Page</strong> Cannot find page you requested!
        </div>
    </div>
</div>

@stop