@extends('layouts.app')

@section('content')
<div class="">
    <div class="page-title">
        <div class="">
            <h3>Users permissions</h3>
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

                        @if (!empty($users) && !empty($roles))
                        <form class="form-horizontal form-label-left input_mask" method="POST" action="{{ action('SettingsController@permissions') }}">
                            {{ csrf_field() }}

                            <table class="table table-striped table-bordered">
                              <thead>
                                <tr>
                                  <th style="width: 10%;" rowspan="2">ID</th>
                                  <th style="width: 60%;" rowspan="2">User</th>
                                  <th style="text-align: center" colspan="{{ count($roles) }}">Roles</th>
                                </tr>
                                <tr>
                                  @foreach ($roles as $role)
                                    <th style="text-align: center;">{{ $role->name }}</th>
                                  @endforeach
                                </tr>
                              </thead>
                              <tbody>
                              @foreach ($users as $user)
                                <tr>
                                  <td>{{ $user->id }}</td>
                                  <td>{{ $user->name }} [ {{ $user->email }} ]</td>
                                  @foreach ($roles as $role)
                                  <td style="text-align: center;">
                                    <input type="checkbox" name="roles[{{ $user->id }}][]" value="{{ $role->id }}" @if ($user->hasRole($role->id)) checked="checked" @endif />
                                  </td>
                                  @endforeach
                                </tr>
                              @endforeach
                              </tbody>
                            </table>

                            <div class="clearfix"></div>
                            <div class="ln_solid"></div>

                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <button type="submit" class="btn btn-primary pull-right">Save</button>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
