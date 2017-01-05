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
                    <h3 class="panel-title bariol-bold"><i class="fa fa-users"></i> Update CMS Category</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8 col-xs-12">
                            {{-- group base form --}}

                            {!! Form::model($data, [ 'url' => [URL::route('page.edit'), $data->id], 'method' => 'post'] ) !!}

                            <div class="form-group">
                                {!! Form::label('template','Select Template:* ') !!}
                                {!! Form::select('template', $template, $data->template, ["class"=>"form-control "]) !!}
                                <span class="text-danger">{!! $errors->first('template') !!}</span>
                            </div>

                            <div class="form-group">
                                {!! Form::label('name','Page name (only seen by admins): *') !!}
                                {!! Form::text('name', null, [ 'class' => 'form-control', 'placeholder' => 'Page name here.']) !!}
                                <span class="text-danger">{!! $errors->first('name') !!}</span>
                            </div>

                            <div class="form-group">
                                {!! Form::label('title','Title') !!}
                                {!! Form::text('title', null, [ 'class' => 'form-control', 'placeholder' => 'Title here.']) !!}
                                <span class="text-danger">{!! $errors->first('title') !!}</span>
                            </div>

                            <div class="form-group">
                                {!! Form::label('slug','Page Slug (URL)') !!}
                                {!! Form::text('slug', null, [ 'class' => 'form-control', 'placeholder' => 'Page Slug here.']) !!}
                                <p class="help-block">Will be automatically generated from your title, if left
                                    empty.</p>
                                <span class="text-danger">{!! $errors->first('slug') !!}</span>
                            </div>

                            <div class="form-group">
                                {!! Form::label('content','Content') !!}
                                {!! Form::textarea('content', null, [ 'class' => 'form-control tinymce', 'placeholder' => 'Content here.']) !!}
                                <span class="text-danger">{!! $errors->first('content') !!}</span>
                            </div>

                            <div class="form-group">
                                {!! Form::label('banner_type','Select Banner Type') !!}
                                {!! Form::select('banner_type', ['hero_image'=>'Hero Image', 'slider'=>'Slider'], $data->banner_type, ["class"=>"form-control "]) !!}
                            </div>

                            <div class="form-group" style="display: block;">
                                {!! Form::label('banner_title','Banner Title') !!}
                                {!! Form::text('banner_title', null, [ 'class' => 'form-control', 'placeholder' => 'Banner Title here.']) !!}
                            </div>

                            <div class="form-group">
                                <div class="form-group">
                                    {!! Form::label('banner_image','Banner Image: ') !!}
                                    {!! Form::text('banner_image', null, ['id' => 'banner_image-filemanager', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                                    <div class="btn-group" role="group" aria-label="..." style="margin-top: 3px;">
                                        <button type="button" data-inputid="banner_image-filemanager"
                                                class="btn btn-default popup_selector">
                                            <i class="fa fa-cloud-upload"></i> Browse uploads
                                        </button>
                                        <button type="button" data-inputid="image-filemanager"
                                                class="btn btn-default clear_elfinder_picker">
                                            <i class="fa fa-eraser"></i> Clear
                                        </button>
                                    </div>
                                    <span class="text-danger">{!! $errors->first('banner_image') !!}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('banner_description','Banner Description') !!}
                                {!! Form::textarea('banner_description', null, [ 'class' => 'form-control tinymce', 'placeholder' => 'Content here.']) !!}
                                <span class="text-danger">{!! $errors->first('banner_description') !!}</span>
                            </div>

                            @if(isset($fields) && !empty($fields))
                                @foreach($fields as $field)
                                    <?php $type = $field['type'];?>
                                    @include("laravel-authentication-acl::admin.cms.fields.$type")
                                @endforeach
                            @endif

                            <div class="form-group">
                                <span>After saving:</span>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="redirect_after_save" value="list" checked="">
                                        go to the table view
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="redirect_after_save" value="new">
                                        let me add another item
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="redirect_after_save" value="edit">
                                        edit the new item
                                    </label>
                                </div>

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


                $(document).ready(function () {
                    $('#banner_type').change(function () {
                        var banner_type = $(this).val();
                        if (banner_type == 'slider') {
                            $("#slider_category").parent().show();
                            $("#banner_title").parent().hide();
                            $("#mceu_50").parent().hide();
                            $("#banner_image-filemanager").parent().hide();
                            $('#banner_type').closest('div').append('<p class="help-block">After adding or editing your page please add slider image by adding posts</p>');
                        } else {
                            $("#banner_title").parent().show();
                            $("#mceu_50").parent().show();
                            $("#banner_image-filemanager").parent().show();
                            $('#banner_type').closest('div').find('p').empty();
                        }
                    });
                });

                $(document).ready(function () {
                    var banner_type = $('#banner_type').val();
                    if (banner_type == 'slider') {
                        $("#slider_category").parent().show();
                        $("#banner_title").parent().hide();
                        $("#banner_description").parent().hide();
                        $("#banner_image-filemanager").parent().hide();
                        $('#banner_type').closest('div').append('<p class="help-block">After adding or editing your page, please add slider image by adding posts</p>');

                    } else {

                        $("#slider_category").parent().hide();
                    }

                    $("#template").change(function () {
                        var page = $(this).val();
                        var url = '<?php route("page.new");?>?page=' + page
                        window.location = url;
                    })
                });
            </script>

@stop