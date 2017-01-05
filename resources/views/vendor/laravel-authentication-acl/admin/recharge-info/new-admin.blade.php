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
                    <h3 class="panel-title bariol-bold"><i class="fa fa-users"></i> New Recharge</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            {{-- group base form --}}

                            {!! Form::open(
                            array(
                            'route' => 'recharge.new',
                            'class' => '',
                            'files' => true)) !!}

                            <div class="form-group">
                                {!! Form::label('recharge_type_id','Banking Name: *') !!}
                                {!! Form::select('recharge_type_id', $recharge_type_output_values, $recharge_types->id, ["class"=>"form-control"]) !!}
                                <span class="text-danger">{!! $errors->first('recharge_type_id') !!}</span>
                            </div>

                            <div class="form-group">
                                {!! Form::label('date','Recharge Date: *') !!}
                                {!! Form::date('date', null, [ 'class' => 'form-control', 'placeholder' => 'Recharge Date here.']) !!}
                                <span class="text-danger">{!! $errors->first('date') !!}</span>
                            </div>

                            <div class="form-group">
                                {!! Form::label('ac_from','Recharge From: *') !!}
                                {!! Form::text('ac_from', null, [ 'class' => 'form-control', 'placeholder' => 'Recharge From ACCOUNT Number here.']) !!}
                                <span class="text-danger">{!! $errors->first('ac_from') !!}</span>
                            </div>

                            <div class="form-group">
                                {!! Form::label('ac_to','Recharge To: *') !!}
                                {!! Form::text('ac_to', $recharge_types->ac_no, [ 'class' => 'form-control', 'placeholder' => 'Recharge to ACCOUNT Number here.', 'readonly' => 'readonly']) !!}
                                <span class="text-info">Our {{ $recharge_types->type_name  }} Banking Account Number {{$recharge_types->ac_no }}</span>
                                <span class="text-danger">{!! $errors->first('ac_to') !!}</span>
                            </div>

                            <div class="form-group">
                                {!! Form::label('amount','Recharge Amount: *') !!}
                                {!! Form::text('amount', null, [ 'class' => 'form-control', 'placeholder' => 'Recharge Amount here.']) !!}
                                <span class="text-danger">{!! $errors->first('amount') !!}</span>
                            </div>

                            <div class="form-group">
                                {!! Form::label('trans_no','Recharge Transaction NO (If have): ') !!}
                                {!! Form::text('trans_no', null, [ 'class' => 'form-control', 'placeholder' => 'Recharge Transaction Number here.']) !!}
                                <span class="text-danger">{!! $errors->first('trans_no') !!}</span>
                            </div>

                                   <div class="form-group">
                                {!! Form::label('admin_reply','Admin Message to the User: ') !!}
                                {!! Form::textarea('admin_reply', null, [ 'class' => 'form-control', 'placeholder' => 'Admin Message for Users here.']) !!}
                                <span class="text-danger">{!! $errors->first('admin_reply') !!}</span>
                            </div>

                            <div class="form-group">
                                {!! Form::label('requested_for','Request For: *') !!}
                                {!! Form::select('requested_for', $user_info_output_values, '', ["class"=>"form-control permission-select chosen-select"]) !!}
                                <span class="text-danger">{!! $errors->first('requested_for') !!}</span>
                            </div>

                            <div class="form-group">
                                {!! Form::label('status','Select status: *') !!}
                                {!! Form::select('status', $status_values, '', ["class"=>"form-control "]) !!}
                                <span class="text-danger">{!! $errors->first('status') !!}</span>
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

        $("#recharge_type_id").change(function () {
            var recharge_type = $(this).val();
            var url = '<?php route("recharge.new");?>?recharge_type=' + recharge_type
            window.location = url;
        })

    </script>

@stop

