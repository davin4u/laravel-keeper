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
                  <th style="width: 25%;">Type</th>
                  <th style="width: 20%;">Project</th>
                  <th style="width: 45%;">Name</th>
                  <th style="width: 10%;"></th>
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
                    <td><a href="#" class="btn btn-danger view-password-details" data-id="{{ $password->id }}"><i class="fa fa-arrow-right"></i></a></td>
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
          <div id="password-details-{{ $password->id }}" class="panel panel-default password-details" style="display:none;">
            <div class="panel-heading"><h2>[ <i class="fa {{ $password->passwordType->icon }}"></i> {{ $password->passwordType->name }} ] {{ $password->name }}</h2></div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-10 col-sm-10 col-xs-10 form-group has-feedback">
                  <input value="{{ $password->username }}" type="text" name="username" class="form-control has-feedback-left" placeholder="Username" />
                  <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-2">
                  <button class="btn btn-default pull-right copy-to-clipboard" data-clipboard-text="{{ $password->username }}" title="Copy to clipboard"><i class="fa fa-clipboard"></i></button>
                </div>
              </div>

              <div class="row">
                <div class="col-md-10 col-sm-10 col-xs-10 form-group has-feedback password-group">
                  <input value="{{ $password->decrypted_password }}" type="text" name="password" class="form-control has-feedback-left" placeholder="Password" />
                  <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-2">
                  <button class="btn btn-default pull-right copy-to-clipboard" data-clipboard-text="{{ $password->decrypted_password }}" title="Copy to clipboard"><i class="fa fa-clipboard"></i></button>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                  <textarea name="full_description" class="form-control has-feedback-left" rows="{{ $password->getDescriptionRowsCount(10) }}" placeholder="Full Description">{{ $password->full_description }}</textarea>
                  <span class="fa fa-align-justify form-control-feedback left" aria-hidden="true"></span>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      @endif
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>
<script>
  $(document).ready(function(){
    $('.view-password-details').on('click', function(){
      $('.password-details').hide();
      $('#password-details-' + $(this).attr("data-id")).show();

      return false;
    });

    new Clipboard('.copy-to-clipboard');
  });
</script>
@endsection
