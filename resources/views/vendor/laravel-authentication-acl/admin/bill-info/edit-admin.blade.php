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
                    <h3 class="panel-title bariol-bold"><i class="fa fa-users"></i> Modify Information</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="summary-table" style="display: none">
                            @include('laravel-authentication-acl::admin.recharge-info.summary')
                        </div>
                        <div class="col-md-12 col-xs-12">

                            {{-- group base form --}}
                            {!! Form::model($data, [ 'url' => [URL::route('bill.edit'), $data->id], 'method' => 'post', 'files' => true] ) !!}

                            <div class="form-group">
                                {!! Form::label('created_for','Bill For: *') !!}
                                {!! Form::select('created_for', $user_info_output_values, $data->created_for, ["class"=>"form-control permission-select chosen-select"]) !!}
                                <span class="text-danger">{!! $errors->first('created_for') !!}</span>
                            </div>

                            <div class="form-group">
                                {!! Form::label('date','Billing Date: *') !!}
                                {!! Form::date('date', \Carbon\Carbon::now(), [ 'class' => 'form-control', 'placeholder' => 'Billing Date here.']) !!}
                                <span class="text-danger">{!! $errors->first('date') !!}</span>
                            </div>

                            <div class="form-group">
                                {!! Form::label('subject','Subject: *') !!}
                                {!! Form::text('subject', null, [ 'class' => 'form-control', 'placeholder' => 'Billing Subject here.']) !!}
                                <span class="text-danger">{!! $errors->first('subject') !!}</span>
                            </div>


                            <div class="form-group">
                                {!! Form::label('description','Description: *') !!}
                                {!! Form::textarea('description', null, [ 'class' => 'form-control tinymce', 'placeholder' => 'Billing description here.']) !!}
                                <span class="text-danger">{!! $errors->first('description') !!}</span>
                            </div>

                            <div class="form-group">
                                {!! Form::label('amount','Bill Amount: *') !!}
                                {!! Form::text('amount', null, [ 'class' => 'form-control', 'placeholder' => 'Bill Amount here.']) !!}
                                <span class="text-danger">{!! $errors->first('amount') !!}</span>
                            </div>

                            <div class="form-group">
                                {!! Form::label('status','Select status: *') !!}
                                {!! Form::select('status', ['PUBLISHED'=>'Published', 'DRAFT' => 'Draft'], $data->status, ["class"=>"form-control "]) !!}
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
            var url = '<?php route("recharge.new");?>?id={{$data->id}}&&recharge_type=' + recharge_type
            window.location = url;
        })

        $(document).ready(function (e) {
            $('#created_for').change(function (e) {
                var user_id=$(this).val();
                var url = '{{route('summarybalance')}}?user_id='+ user_id;
                $.ajax(url, {
                    success: function (data) {
                        $(".summary-table .recharge_amount").html(data.recharge_amount);
                        $(".summary-table .bill_amount").html(data.bill_amount);
                        $(".summary-table .balance_amount").html(data.balance_amount);
                        $('.summary-table').show(200)
                    },
                    error: function () {
                        alert('Someting wrong.');
                    }
                });
            })
        })
    </script>

@stop

