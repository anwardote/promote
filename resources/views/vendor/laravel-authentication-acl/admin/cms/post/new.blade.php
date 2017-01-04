@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
    Admin area: add Tutorial
@stop

@section('head_css')
    {!! HTML::style('css/chosen.css') !!}
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
                    <h3 class="panel-title bariol-bold"><i class="fa fa-users"></i> Add New Post</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8 col-xs-12">
                            {{-- group base form --}}

                            {!! Form::open(
                            array(
                            'route' => 'post.new',
                            'class' => '',
                            'files' => true)) !!}
                            <div class="form-group">
                                {!! Form::label('cms_category_id','Select Category: *') !!}
                                {!! Form::select('cms_category_id', array_map('ucwords', $cms_category_values), '', ["class"=>"form-control permission-select chosen-select"]) !!}
                                <span class="text-danger">{!! $errors->first('cms_category_id') !!}</span>
                            </div>

                            <div class="form-group">
                                {!! Form::label('title','Title :*') !!}
                                {!! Form::text('title', null, [ 'class' => 'form-control', 'placeholder' => 'Your title here.']) !!}
                                <span class="text-danger">{!! $errors->first('title') !!}</span>
                            </div>

                            <div class="form-group">
                                {!! Form::label('slug','Slug (URL)') !!}
                                {!! Form::text('slug', null, [ 'class' => 'form-control', 'placeholder' => '']) !!}
                                <p class="help-block">Will be automatically generated from your title, if left
                                    empty.</p>
                                <span class="text-danger">{!! $errors->first('slug') !!}</span>
                            </div>

                            <div class="form-group">
                                {!! Form::label('source','Source (If required)') !!}
                                {!! Form::text('source', null, [ 'class' => 'form-control', 'placeholder' => '']) !!}
                                <span class="text-danger">{!! $errors->first('source') !!}</span>
                            </div>

                            <div class="form-group">
                                {!! Form::label('date','Date :*') !!}
                                {!! Form::date('date', \Carbon\Carbon::now(), [ 'class' => 'form-control', 'placeholder' => '']) !!}
                                <span class="text-danger">{!! $errors->first('date') !!}</span>
                            </div>

                            <div class="form-group">
                                {!! Form::label('content','Content :') !!}
                                {!! Form::textarea('content', null, [ 'class' => 'form-control tinymce', 'placeholder' => 'Your content here.']) !!}
                                <span class="text-danger">{!! $errors->first('content') !!}</span>
                            </div>


                            <div class="form-group">
                                <div class="form-group">
                                    {!! Form::label('image','Image: ') !!}
                                    {!! Form::text('image', null, ['id' => 'image-filemanager', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                                    <div class="btn-group" role="group" aria-label="..." style="margin-top: 3px;">
                                        <button type="button" data-inputid="image-filemanager"
                                                class="btn btn-default popup_selector">
                                            <i class="fa fa-cloud-upload"></i> Browse uploads
                                        </button>
                                        <button type="button" data-inputid="image-filemanager"
                                                class="btn btn-default clear_elfinder_picker">
                                            <i class="fa fa-eraser"></i> Clear
                                        </button>
                                    </div>
                                    <span class="text-danger">{!! $errors->first('image') !!}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('status','Select status: *') !!}
                                {!! Form::select('status', ['PUBLISHED'=>'Published', 'DRAFT'=>'Draft'], '', ["class"=>"form-control "]) !!}
                                <span class="text-danger">{!! $errors->first('status') !!}</span>
                            </div>

                            <div class="form-group">
                                {{ Form::checkbox('featured', 1, null, ['class' => 'field', 'id'=>'featured']) }}
                                {!! Form::label('featured','Featured') !!}
                            </div>

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
    {!! HTML::script('js/chosen.jquery.js') !!}
    {!! HTML::script('/assets/js/jquery.colorbox-min.js') !!}
    {!! HTML::script('/vendor/backpack/tinymce/tinymce.min.js') !!}
    {!! HTML::script('/packages/barryvdh/elfinder/js/standalonepopup.min.js') !!}
    <script>
        $(".delete").click(function () {
            return confirm("Are you sure to delete this snippet?");
        });

        var config = {
            '.chosen-select': {},
            '.chosen-select-deselect': {allow_single_deselect: true},
            '.chosen-select-no-single': {disable_search_threshold: 10},
            '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
            '.chosen-select-width': {width: "95%"}
        }
        for (var selector in config) {
            $(selector).chosen(config[selector]);
        }


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

