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
        top:-25px;
        right:10px;
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
                        'route' => 'tool.new', 
                        'class' => '', 
                        'files' => true)) !!}

                        <div class="form-group">
                            {!! Form::label('title','Tool Title: *') !!}
                            {!! Form::text('title', null, [ 'class' => 'form-control', 'placeholder' => 'Supported Driver Models here.']) !!}
                            <span class="text-danger">{!! $errors->first('title') !!}</span>
                        </div>

                        <div class="form-group">
                            {!! Form::label('supports','Select Supports: *') !!}
                            {!! Form::select('supports', $tool_support_output_values, '', ["class"=>"form-control "]) !!}
                            <span class="text-danger">{!! $errors->first('supports') !!}</span>
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
                                <input type="text" name="download_link[]" value="{{ $v }}" class="form-control" placeholder="More Download links here." required="required"/>
                                @else
                                <input type="text" name="download_link[]" value="{{ $v }}" class="form-control" placeholder="More Download links here." required="required"/><a href="javascript:void(0)" class="remove_field glyphicon glyphicon-minus-sign remove"></a>
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
                            {!! Form::label('instructions','Instruction: *') !!}
                            {!! Form::textarea('instructions', null, [ 'class' => 'form-control tinymce', 'placeholder' => 'Starting Instruction here.']) !!}
                            <span class="text-danger">{!! $errors->first('instructions') !!}</span>
                        </div>
                        <div class="form-group">
                            {!! Form::label('status','Select status: *') !!}
                            {!! Form::select('status', $status_values, '', ["class"=>"form-control "]) !!}
                            <span class="text-danger">{!! $errors->first('status') !!}</span>
                        </div>

                        <div class="form-group">
                            {{ Form::checkbox('featured', 1, null, ['class' => 'field', 'id'=>'featured']) }}
                            {!! Form::label('featured','Featured') !!}
                        </div>   

                        <div class="form-group">
                            {!! Form::label('noted','Noted (if any):') !!}
                            {!! Form::text('noted', null, [ 'class' => 'form-control', 'placeholder' => 'Tool Note here.']) !!}
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

