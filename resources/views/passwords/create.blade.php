@extends('layouts.app')

@section('content')
<div class="">
    <div class="page-title">
        <div class="">
            <h3>New password</h3>
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

                        <form class="form-horizontal form-label-left input_mask" method="POST" action="{{ action('PasswordsController@store') }}">

                            {{ csrf_field() }}
                            
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                <select class="form-control has-feedback-left" name="project_id">
                                    @foreach($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                                <span class="fa fa-laptop form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                <select class="form-control has-feedback-left" name="type">
                                    <option value="1">Admin Panel</option>
                                    <option value="2">FTP</option>
                                    <option value="3">SSH</option>
                                </select>
                                <span class="fa fa-tag form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                <input value="{{ old('name') }}" type="text" name="name" class="form-control has-feedback-left" id="inputSuccess1" placeholder="Password Name" />
                                <span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                <input value="{{ old('username') }}" type="text" name="username" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Username" />
                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                <input value="{{ old('password') }}" type="password" name="password" class="form-control has-feedback-left" id="inputSuccess3" placeholder="Password" />
                                <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                <textarea name="full_description" class="form-control has-feedback-left" rows="4" id="inputSuccess4" placeholder="Full Description">{{ old('full_description') }}</textarea>
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
