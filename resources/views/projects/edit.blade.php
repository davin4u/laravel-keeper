@extends('layouts.app')

@section('content')
<div class="">
    <div class="page-title">
        <div class="">
            <h3>
                <a class="btn btn-sm btn-primary" href="{{ action('ProjectsController@index') }}"><i class="fa fa-reply"></i> Projects</a>
                {{ $project->name }}
            </h3>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        @foreach($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            {{ $error }}
                        </div>
                        @endforeach
                        <form class="form-horizontal form-label-left input_mask" method="POST" action="{{ action('ProjectsController@update', [$project->id]) }}">
                            {{ csrf_field() }}
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                <input value="{{ $project->name }}" type="text" name="name" class="form-control has-feedback-left" id="inputSuccess1" placeholder="Project Name" />
                                <span class="fa fa-laptop form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                <input value="{{ $project->url }}" type="text" name="url" class="form-control has-feedback-left" id="inputSuccess2" placeholder="URL" />
                                <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                <input value="{{ $project->short_description }}" type="text" name="short_description" class="form-control has-feedback-left" id="inputSuccess3" placeholder="Short Description" />
                                <span class="fa fa-align-justify form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                <textarea name="full_description" class="form-control has-feedback-left" rows="4" id="inputSuccess4" placeholder="Full Description">{{ $project->full_description }}</textarea>
                                <span class="fa fa-align-justify form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="clearfix"></div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <button type="submit" class="btn btn-primary pull-right">Save</button>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
