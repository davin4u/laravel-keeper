@extends('layouts.app')

@section('content')
<div class="">
    <div class="page-title">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h3>Projects <a class="btn btn-primary pull-right" href="{{ action('ProjectsController@create') }}">Add project</a></h3>
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
                                    <th style="width: 20%;">Name</th>
                                    <th style="width: 20%;">Url</th>
                                    <th style="width: 40%;">Info</th>
                                    <th style="width: 20%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($projects as $project)
                                <tr>
                                    <td>
                                        <a href="{{ action('PasswordsController@projectPasswordsList', [$project->id]) }}">{{ $project->name }}</a>
                                        <br />
                                        <small>Created at {{ $project->created_at }}</small>
                                    </td>
                                    <td>
                                        <a href="{{ $project->url }}" target="_blank">{{ $project->url }}</a>
                                    </td>
                                    <td><small>{{ $project->short_description }}</small></td>
                                    <td>
                                        <a href="{{ action('ProjectsController@edit', [$project->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                                        <a href="{{ action('ProjectsController@delete', [$project->id]) }}" class="btn btn-danger btn-xs" onclick="if(!confirm('Are you sure?'){return false;});"><i class="fa fa-trash-o"></i> Delete </a>
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
