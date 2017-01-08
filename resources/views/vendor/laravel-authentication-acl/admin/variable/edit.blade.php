@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
    Admin area: add Tutorial
@stop

@section('head_css')
    {!! HTML::style('/assets/css/colorbox.css') !!}
@stop

@section('content')
    {{-- @include('tinymce::tpl')  --}}
    <div class="row">
        <div class="col-md-12" id="tutorialForm">
            {{-- model general errors from the form --}}
            @if($errors->has('model') )
                <div class="alert alert-danger">{!! $errors->first('model') !!}</div>
            @endif

            {{-- successful message --}}
            <?php $message = Session::get('message'); ?>
            @if( isset($message) )
                <div class="alert alert-success">{{$message}}</div>
            @endif
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title bariol-bold"><i class="fa fa-users"></i> Add New Bank</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            {{-- group base form --}}
                            {!! Form::model($data, [ 'url' => [URL::route('variable.edit'), $data->id], 'method' => 'post', 'files' => true] ) !!}
                            <div class="form-group">
                                {!! Form::label('copy_right','Footer CopyRight :*') !!}
                                {!! Form::text('copy_right', null, [ 'class' => 'form-control', 'placeholder' => 'Footer copy right text here.']) !!}
                                <span class="text-danger">{!! $errors->first('copy_right') !!}</span>
                            </div>
                            <div class="form-group">
                                {!! Form::label('footer_address','Footer Address :*') !!}
                                {!! Form::textarea('footer_address', null, [ 'class' => 'form-control tinymce', 'placeholder' => 'Footer address text here.']) !!}
                                <span class="text-danger">{!! $errors->first('footer_address') !!}</span>
                            </div>

                            {!! Form::hidden('id', 1) !!}
                            {!! Form::submit('Save', array("class"=>"btn btn-info pull-right ")) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer_scripts')
    {!! HTML::script('/assets/js/jquery.colorbox-min.js') !!}
    {!! HTML::script('/vendor/backpack/tinymce/tinymce.min.js') !!}
    {!! HTML::script('/packages/barryvdh/elfinder/js/standalonepopup.min.js') !!}
    <script>
        $(".delete").click(function () {
            return confirm("Are you sure to delete this snippet?");
        });

        tinymce.init({
            selector: "textarea.tinymce",
            skin: "dick-light",
            plugins: "image,link,media,anchor,code",
            file_browser_callback: elFinderBrowser,
            relative_urls: false,
            remove_script_host: false,
            convert_urls: true,
        });
        function elFinderBrowser(field_name, url, type, win) {
            tinymce.activeEditor.windowManager.open({
                file: '<?= route('elfinder.tinymce4') ?>', // use an absolute path!
                title: 'elFinder 2.0',
                width: 900,
                height: 450,
                resizable: 'yes'
            }, {
                setUrl: function (url) {
                    win.document.getElementById(field_name).value = url;
                }
            });
            return false;
        }

    </script>

@stop
