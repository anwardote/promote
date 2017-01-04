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
                <h3 class="panel-title bariol-bold"><i class="fa fa-users"></i> Update Device</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-8 col-xs-12">
                        {{-- group base form --}}

                        {!! Form::model($data, [ 'url' => [URL::route('viewcategory.edit'), $data->id], 'method' => 'post', 'files' => true] ) !!}
                        <?php
                        unset($fcategory_output_values[4]);
                        ?>
                        <div class="form-group">
                            {!! Form::label('fcategory_id','Select Category: *') !!}
                            {!! Form::select('fcategory_id', $fcategory_output_values, $data->fcategory_id, ["class"=>"form-control"]) !!}
                            <span class="text-danger">{!! $errors->first('fcategory_id') !!}</span>
                        </div>

                        <div class="form-group">
                            {!! Form::label('title','Title :*') !!}
                            {!! Form::text('title', null, [ 'class' => 'form-control', 'placeholder' => 'Title here.']) !!}
                            <span class="text-danger">{!! $errors->first('title') !!}</span>
                        </div>
                        
                        <div class="form-group">
                            {!! Form::label('description','Description:') !!}
                            {!! Form::textarea('description', null, [ 'class' => 'form-control tinymce', 'placeholder' => 'Description here.']) !!}
                            <span class="text-danger">{!! $errors->first('description') !!}</span>
                        </div>

                        <div class="form-group">
                            {!! Form::label('search_engine','Google Search Keywords:') !!}
                            {!! Form::textarea('search_engine', null, [ 'class' => 'form-control tinymce', 'placeholder' => 'Google Search Keywords here.']) !!}
                            <span class="text-danger">{!! $errors->first('search_engine') !!}</span>
                        </div>
                        
                        {{--<div class="form-group">--}}
                            {{--<div class="form-group">--}}
                                {{--{!! Form::label('image','Device Thumbnail: ') !!}                                --}}
                                {{--{!! Form::text('image', null, ['id' => 'image-filemanager', 'class' => 'form-control', 'readonly' => 'readonly']) !!}--}}
                                {{--<div class="btn-group" role="group" aria-label="..." style="margin-top: 3px;">--}}
                                    {{--<button type="button" data-inputid="image-filemanager" class="btn btn-default popup_selector">--}}
                                        {{--<i class="fa fa-cloud-upload"></i> Browse uploads</button>--}}
                                    {{--<button type="button" data-inputid="image-filemanager" class="btn btn-default clear_elfinder_picker">--}}
                                        {{--<i class="fa fa-eraser"></i> Clear</button>--}}
                                {{--</div>--}}
                                {{--<span class="text-danger">{!! $errors->first('image') !!}</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {!! Form::hidden('id') !!}

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

