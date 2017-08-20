@extends('layouts.app')

@section('content')
<div class="">
    <div class="page-title">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h3>Passwords <a class="btn btn-primary pull-right" href="{{ action('PasswordsController@create') }}">Add password</a></h3>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <table id="projects-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 20%;">Type</th>
                                    <th style="width: 20%;">Project</th>
                                    <th style="width: 20%;">Name</th>
                                    <th style="width: 20%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($passwords as $password)
                                <tr>
                                    <td>{{ $password->passwordType->name }}</td>
                                    <td>{{ $password->project->name }}</td>
                                    <td>
                                        <a href="{{ action('PasswordsController@edit', [$password->id]) }}">{{ $password->name }}</a>
                                        <br />
                                        <small>Created at {{ $password->created_at }}</small>
                                    </td>
                                    <td>
                                        <a href="{{ action('PasswordsController@edit', [$password->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                                        <a href="{{ action('PasswordsController@delete', [$password->id]) }}" class="btn btn-danger btn-xs" onclick="if(!confirm('Are you sure?'){return false;});"><i class="fa fa-trash-o"></i> Delete </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection