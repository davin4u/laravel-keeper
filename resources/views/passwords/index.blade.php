@extends('layouts.app')

@section('content')
<div class="">
    <div class="page-title">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h3>
                  @if (isset($project))
                  {{ $project->name }} |
                  @endif
                  Passwords <a class="btn btn-primary pull-right" href="{{ action('PasswordsController@create') }}">Add password</a>
                </h3>
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
                                    <th style="width: 10%;">Type</th>
                                    <th style="width: 15%;">Project</th>
                                    <th style="width: 20%;">Name</th>
                                    <th style="width: 15%;">Username</th>
                                    <th style="width: 15%;">Password</th>
                                    <th style="width: 15%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($passwords as $password)
                                <tr>
                                    <td><i class="fa {{ $password->passwordType->icon }}"></i> {{ $password->passwordType->name }}</td>
                                    <td>{{ $password->project->name }}</td>
                                    <td>
                                        <a href="{{ action('PasswordsController@edit', [$password->id]) }}">{{ $password->name }}</a>
                                        <br />
                                        <small>Created at {{ $password->created_at }}</small>
                                    </td>
                                    <td>{{ $password->username }}<button class="btn btn-default pull-right copy-to-clipboard" data-clipboard-text="{{ $password->username }}" title="Copy to clipboard"><i class="fa fa-clipboard"></i></button></td>
                                    <td>******<button class="btn btn-default pull-right copy-to-clipboard" data-clipboard-text="{{ $password->decrypted_password }}" title="Copy to clipboard"><i class="fa fa-clipboard"></i></button></td>
                                    <td>
                                        <a href="{{ action('PasswordsController@edit', [$password->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                                        @if ($password->removable())
                                        <a href="{{ action('PasswordsController@delete', [$password->id]) }}" class="btn btn-danger btn-xs" onclick="if(!confirm('Are you sure?'){return false;});"><i class="fa fa-trash-o"></i> Delete </a>
                                        @endif
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

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#projects-table").DataTable();

            new Clipboard('.copy-to-clipboard');
        });
    </script>
@endsection
