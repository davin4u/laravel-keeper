@extends('layouts.app')

@section('content')
<div class="">
    <div class="page-title">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h3>Password Types <a class="btn btn-primary pull-right" href="{{ action('SettingsController@create') }}">Add password type</a></h3>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <table id="password-types-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10%; text-align: center;">Icon</th>
                                    <th style="width: 70%;">Name</th>
                                    <th style="width: 20%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($types as $type)
                                <tr>
                                    <td style="text-align: center;">
                                      @if ($type->icon)
                                      <i class="fa {{ $type->icon }}"></i>
                                      @endif
                                    </td>
                                    <td>
                                        <a href="{{ action('SettingsController@edit', [$type->id]) }}">{{ $type->name }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ action('SettingsController@edit', [$type->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                                        <a href="{{ action('SettingsController@delete', [$type->id]) }}" class="btn btn-danger btn-xs" onclick="if(!confirm('Are you sure?'){return false;});"><i class="fa fa-trash-o"></i> Delete </a>
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
