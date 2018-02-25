@extends('layouts.app')

@section('content')
<div class="">
    <div class="page-title">
        <div class="">
            <h3>
                <a class="btn btn-sm btn-primary" href="{{ action('PasswordsController@index') }}"><i class="fa fa-reply"></i> Passwords</a>
                {{ $password->name }}
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

                        <form class="form-horizontal form-label-left input_mask" method="POST" action="{{ action('PasswordsController@update', [$password->id]) }}" enctype="multipart/form-data">

                            {{ csrf_field() }}

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                <select class="form-control has-feedback-left" name="project_id">
                                    @foreach ($projects as $project)
                                    <option value="{{ $project->id }}"
                                            @if($project->id == $password->project_id)
                                            selected = "selected"
                                            @endif
                                    >{{ $project->name }}</option>
                                    @endforeach
                                </select>
                                <span class="fa fa-laptop form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                <select class="form-control has-feedback-left" name="type">
                                    @foreach ($password_types as $type)
                                        <option value="{{ $type->id }}"
                                                @if($password->type == $type->id)
                                                selected = "selected"
                                                @endif
                                                >{{ $type->name }}</option>
                                    @endforeach
                                </select>
                                <span class="fa fa-tag form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                <input value="{{ $password->name }}" type="text" name="name" class="form-control has-feedback-left" id="inputSuccess1" placeholder="Password Name" />
                                <span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                <input value="{{ $password->username }}" type="text" name="username" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Username" />
                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback password-group">
                                <button class="btn btn-primary btn-small show-password-btn"><span class="fa fa-eye"></span></button>
                                <input value="{{ $password->decrypted_password }}" type="password" name="password" class="form-control has-feedback-left" id="inputSuccess3" placeholder="Password" />
                                <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                <textarea name="full_description" class="form-control has-feedback-left" rows="{{ $password->getDescriptionRowsCount(20) }}" id="inputSuccess4" placeholder="Full Description">{{ $password->full_description }}</textarea>
                                <span class="fa fa-align-justify form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="clearfix"></div>
                            <div class="ln_solid"></div>

                            @if (!empty($files))
                                <h2>Attached Files</h2>
                                <div class="well">
                                    <ul class="files-list">
                                        @foreach ($files as $file)
                                            <li>
                                                @if ($password->removable())
                                                <a href="#" data-id="{{ $file->id }}" class="remove-file"><i class="fa fa-close"></i></a>
                                                @endif

                                                <div class="file-icon">
                                                    <a href="{{ route('download', ['id' => $file->id]) }}"><img src="/images/{{ $file->icon() }}.png" /></a>
                                                </div>

                                                <div class="file-name"><a href="{{ route('download', ['id' => $file->id]) }}">{{ $file->original_name }}</a></div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group atach-files-group">
                                <div class="file-line last">
                                    <a href="#" class="remove-line"><i class="fa fa-close"></i></a>
                                    <input type="file" name="files[]" class="form-control atach-file" />
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <div class="ln_solid"></div>

                            @if ($password->editable())
                                <h2>Share password with users:</h2>

                                <div class="well share-with-block">
                                    <ul class="share-with-users">
                                        @foreach ($users as $user)
                                            <li>
                                                <input type="checkbox" <?php if ($password->isSharedWithUser($user->id)) echo 'checked="checked"'; ?> name="share_with[]" value="{{ $user->id }}" class="flat" /> {{ $user->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="ln_solid"></div>

                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <button type="submit" class="btn btn-primary pull-right">Save</button>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('body').on('change', '.atach-file', function() {
                if ($(this).parent().hasClass('last')) {
                    $('.atach-files-group').append(`
                        <div class="file-line last">
                            <a href="#" class="remove-line"><i class="fa fa-close"></i></a>
                            <input type="file" name="files[]" class="form-control atach-file" />
                        </div>
                    `);

                    $(this).parent().removeClass('last');
                }
            });

            $('body').on('click', '.remove-line', function() {
                $(this).closest('.file-line').remove();

                return false;
            });

            $('body').on('click', '.remove-file', function() {
                var $this = $(this);

                var id = $(this).attr("data-id");

                $.ajax({
                    url: '/delete-file/' + id,
                    type: 'get',
                    success: function(response) {
                        $this.closest('li').remove();
                    }
                });

                return false;
            });
        });
    </script>
@endsection