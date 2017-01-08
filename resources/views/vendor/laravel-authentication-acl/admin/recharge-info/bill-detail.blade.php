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
        table .lefttd{
            width: 40%;
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
                    <h3 class="panel-title bariol-bold"><i class="fa fa-users"></i> Details Information</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <h3 style="padding: 10px; text-align: center">Bill Details Information </h3>
                            <table class="table table-hover">

                                <tr>
                                    <td class="lefttd">ID</td>
                                    <td>{{ $data->id }}</td>
                                </tr>

                                <tr>
                                    <td class="lefttd">Billing Date</td>
                                    <td>{{ $data->date}} - (YY-MM-DD)</td>
                                </tr>

                                <tr>
                                    <td class="lefttd">Billing Subject</td>
                                    <td>{{ $data->subject }}</td>
                                </tr>

                                <tr>
                                    <td class="lefttd">Billing Subject</td>
                                    <td><?php echo $data->description; ?></td>
                                </tr>

                                <tr>
                                    <td class="lefttd">Billing Amount (Tk.)</td>
                                    <td>{{ number_format($data->amount, 2, '.', ',') }} Tk.</td>
                                </tr>
                                <tr>
                                    <td class="lefttd">Status</td>
                                    <td>{{ $data->status }}</td>
                                </tr>

                                <tr>
                                    <td class="lefttd">Bill For</td>
                                    <td>{{ $data->user_created_for()->first()->email }}</td>
                                </tr>
                                <tr>
                                    <td class="lefttd">Created By</td>
                                    <td>{{ $data->user_created_by()->first()->email }}</td>
                                </tr>


                                <tr>
                                    <td class="lefttd">Created Time</td>
                                    <td>{{ $data->created_at }}</td>
                                </tr>


                            </table>
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

