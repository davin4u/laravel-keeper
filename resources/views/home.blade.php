@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h2>
            Last viewed passwords:
            <a href="{{ action('PasswordsController@create') }}" class="btn btn-success pull-right">New password</a>
            <a href="{{ action('PasswordsController@index') }}" class="btn btn-primary pull-right">All passwords</a>
          </h2>
        </div>

        <div class="panel-body">
            @if (!empty($lastViewed))
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th style="width: 10%;">Type</th>
                  <th style="width: 15%;">Project</th>
                  <th style="width: 50%;">Name</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($lastViewed as $password)
                  <tr>
                    <td><i class="fa {{ $password->passwordType->icon }}"></i> {{ $password->passwordType->name }}</td>
                    <td>{{ $password->project->name }}</td>
                    <td>
                      <a href="{{ action('PasswordsController@edit', [$password->id]) }}">{{ $password->name }}</a>
                      <br />
                      <small>Created at {{ $password->created_at }}</small>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            @endif
        </div>
      </div>
    </div>
    <div class="col-md-6">
      @if (!empty($lastViewed))
        @foreach ($lastViewed as $password)
          <div class="panel panel-default" style="display:none;">
            <div class="panel-heading"><h2>{{ $password->name }}</h2></div>
            <div class="panel-body">

            </div>
          </div>
        @endforeach
      @endif
    </div>
  </div>
</div>
@endsection
