@extends('layouts.app')

@section('content')
<div class="">
    <div class="page-title">
        <div class="">
            <h3>New project</h3>
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
                        <form class="form-horizontal form-label-left input_mask" method="POST" action="{{ action('ProjectsController@store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                <input value="{{ old('name') }}" type="text" name="name" class="form-control has-feedback-left" id="inputSuccess1" placeholder="Project Name" />
                                <span class="fa fa-laptop form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                <input value="{{ old('url') }}" type="text" name="url" class="form-control has-feedback-left" id="inputSuccess2" placeholder="URL" />
                                <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                <input value="{{ old('short_description') }}" type="text" name="short_description" class="form-control has-feedback-left" id="inputSuccess3" placeholder="Short Description" />
                                <span class="fa fa-align-justify form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                <textarea name="full_description" class="form-control has-feedback-left" rows="4" id="inputSuccess4" placeholder="Full Description">{{ old('full_description') }}</textarea>
                                <span class="fa fa-align-justify form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group atach-files-group">
                                <div class="file-line last">
                                    <a href="#" class="remove-line"><i class="fa fa-close"></i></a>
                                    <input type="file" name="files[]" class="form-control atach-file" />
                                </div>
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
