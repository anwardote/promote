@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
    Admin area: add snippets
@stop

@section('head_css')
    {!! HTML::style('css/prism.css') !!}
    {!! HTML::style('css/chosen.css') !!}
    {!! HTML::style('/assets/css/colorbox.css') !!}
    <style>
        #firmwareForm a.remove {
            float: right;
            top: -25px;
            right: 10px;
        }
    </style>
@stop

@section('content')
    {{-- @include('tinymce::tpl')  --}}
    <div class="row">
        <div class="col-md-12" id="firmwareForm">
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
                    <h3 class="panel-title bariol-bold"><i class="fa fa-users"></i> Add Firmware</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            {{-- group base form --}}

                            {!! Form::open(
                            array(
                            'route' => 'firmware.new',
                            'class' => '',
                            'files' => true)) !!}
                            <?php
                            unset($fcategory_output_values[3]);
                            unset($fcategory_output_values[4]);
                            ?>
                            <div class="form-group">
                                {!! Form::label('fcategory_id','Select Firmware Category: *') !!}
                                {!! Form::select('fcategory_id', $fcategory_output_values, '', ["class"=>"form-control"]) !!}
                                <span class="text-danger">{!! $errors->first('fcategory_id') !!}</span>
                            </div>

                            <div class="form-group">
                                {!! Form::label('view_category_id','Select View Category: *') !!}
                                {!! Form::select('view_category_id', $view_category, '', ["class"=>"form-control permission-select chosen-select"]) !!}
                                <span class="text-danger">{!! $errors->first('view_category_id') !!}</span>
                            </div>

                            <div class="form-group">
                                {!! Form::label('device_id','Select Supported Device: *') !!}
                                {!! Form::select('device_id', $device_output_values, '', ["class"=>"form-control permission-select chosen-select"]) !!}
                                <span class="text-danger">{!! $errors->first('device_id') !!}</span>
                            </div>

                            <div class="form-group">
                                {!! Form::label('device_model','Supported Device Models:') !!}
                                {!! Form::text('device_model', null, [ 'class' => 'form-control', 'placeholder' => 'Supported Device Models here.']) !!}
                                <span class="text-danger">{!! $errors->first('device_model') !!}</span>
                            </div>

                            <div class="form-group">
                                {!! Form::label('device_version','Supported Device versions:') !!}
                                {!! Form::text('device_version', null, [ 'class' => 'form-control', 'placeholder' => 'Supported Device Versions here.']) !!}
                                <span class="text-danger">{!! $errors->first('device_version') !!}</span>
                            </div>

                            <div class="form-group">
                                {!! Form::label('country','Select supported countries:') !!}
                                {!! Form::select('country[]', $country_output_values, '', ["class"=>"form-control permission-select chosen-select", "id"=>'country', 'multiple'=>'multiple']) !!}
                                <span class="text-danger">{!! $errors->first('country') !!}</span>
                            </div>
                            <div class="form-group input_fields_wrap">
                                {!! Form::label('download_link','Download Links:') !!}
                                <?php
                                $downloadArr = explode(',', old('download_link'));
                                $l = (count($downloadArr));
                                $i = 0;
                                ?>
                                @if($l > 1)
                                    @foreach($downloadArr as $v)
                                        <?php $i++; ?>
                                        <div style="margin-top:10px">
                                            @if($i==1)
                                                <input type="text" name="download_link[]" value="{{ $v }}"
                                                       class="form-control" placeholder="More Download links here."
                                                       required="required"/>
                                            @else
                                                <input type="text" name="download_link[]" value="{{ $v }}"
                                                       class="form-control" placeholder="More Download links here."
                                                       required="required"/><a href="javascript:void(0)"
                                                                               class="remove_field glyphicon glyphicon-minus-sign remove"></a>
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                    {!! Form::text('download_link[]', null, [ 'class' => 'form-control', 'placeholder' => 'Download links here.']) !!}
                                @endif
                            </div>
                            <span class="text-danger">{!! $errors->first('download_link') !!}</span>
                            <a href="javascript:void(0)" class="addMore add_field_button">Add More</a>

                            <div class="form-group">
                                {!! Form::label('d_sizes','Download size:') !!}
                                {!! Form::text('d_sizes', null, [ 'class' => 'form-control', 'placeholder' => 'Download size here.']) !!}
                                <span class="text-danger">{!! $errors->first('d_sizes') !!}</span>
                            </div>

                            <div class="form-group">
                                {!! Form::label('tutorial_id','Supported tutorial: *') !!}
                                {!! Form::number('tutorial_id', null, [ 'class' => 'form-control', 'placeholder' => 'Tutorial ID here.']) !!}
                                <span class="text-danger">{!! $errors->first('tutorial_id') !!}</span>
                            </div>

                            {{--<div class="form-group">--}}
                                {{--{!! Form::label('st_instruct','Starting Instruction(if any):') !!}--}}
                                {{--{!! Form::textarea('st_instruct', null, [ 'class' => 'form-control tinymce', 'placeholder' => 'Starting Instruction here.']) !!}--}}
                                {{--<span class="text-danger">{!! $errors->first('st_instruct') !!}</span>--}}
                            {{--</div>--}}

                            <div class="form-group">
                                {!! Form::label('status','Select status: *') !!}
                                {!! Form::select('status', $status_values, '', ["class"=>"form-control "]) !!}
                                <span class="text-danger">{!! $errors->first('status') !!}</span>
                            </div>

                            <div class="form-group">
                                {{ Form::checkbox('featured', 1, null, ['class' => 'field', 'id'=>'featured']) }}
                                {!! Form::label('featured','Featured') !!}
                            </div>
                        <!--                        <div class="form-group">
                                                    <div class="form-group">
                                                        {!! Form::label('thumbnail','Snippet Thumbnail: ') !!}
                            {!! Form::text('thumbnail', null, ['id' => 'image-filemanager', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                                <div class="btn-group" role="group" aria-label="..." style="margin-top: 3px;">
                                    <button type="button" data-inputid="image-filemanager" class="btn btn-default popup_selector">
                                        <i class="fa fa-cloud-upload"></i> Browse uploads</button>
                                    <button type="button" data-inputid="image-filemanager" class="btn btn-default clear_elfinder_picker">
                                        <i class="fa fa-eraser"></i> Clear</button>
                                </div>
                                <span class="text-danger">{!! $errors->first('thumbnail') !!}</span>
                                                    </div>
                                                </div>-->
                            <div class="form-group">
                                {!! Form::label('noted','Noted (if any):') !!}
                                {!! Form::text('noted', null, [ 'class' => 'form-control', 'placeholder' => 'Firmware Note here.']) !!}
                            </div>
                            <span class="text-danger">{!! $errors->first('noted') !!}</span>
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
    {!! HTML::script('js/prism.js') !!}
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

        $(document).ready(function () {
            var max_fields = 10; //maximum input boxes allowed
            var wrapper = $(".input_fields_wrap"); //Fields wrapper
            var add_button = $(".add_field_button"); //Add button ID

            var x = 1; //initlal text box count
            $(add_button).click(function (e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment

                    $(wrapper).append('<div style="margin-top:10px"><input type="text" name="download_link[]" class="form-control" placeholder="More Download links here." required="required"/><a href="javascript:void(0)" class="remove_field glyphicon glyphicon-minus-sign remove"></a></div>'); //add input box
                }
            });

            $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
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

