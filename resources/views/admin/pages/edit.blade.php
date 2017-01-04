@extends('admin.layouts.base-1col-builder')

@section('title')
Admin area: edit template
@stop

@section('content')
<style>
    @if($template->category_id == 11)
    body { margin: 0;font-size: 100%;}
    p, td, li, label { font-size: 14px;line-height: normal;font-weight: 500;    }
    h1, h2, h3, h4, h5, h6 {
        font-family: "Open Sans", sans-serif !important;
        font-weight: 300;
        letter-spacing: 0px;
        line-height: 1.4;
    }
    h2 {
        font-size: 56px;
        margin: 0;
    }
    h3 {
        font-size: 46px;
        line-height: normal;
        font-weight: lighter;
        margin: 0;
    }
    h5 {
        font-size: 34px;
        margin: 0;
    }
    @media all and (max-width: 1080px) {
        .is-container { margin:0; }
    }
    .row {
        margin-left: -1rem;
        margin-right: -1rem;
    }
    a {
        text-decoration: none;
    }
    .row img {
        margin: 1.4em 0 1em;
    }
    img {
        max-width: 100%;
    }
    .row > * {
        min-height: 30px;
    }
    @media all and (min-width: 20rem) {
        .column {
            float: left;
            padding-left: 15px;
            padding-right: 15px;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }
        .column.fourth {
            width: 25%;
        }
        .column.two-fourth {
            width: 75%;
        }
        .column.fifth {
            width: 20%;
        }
        .column.two-fifth {
            width: 80%;
        }
    }
    .btn {
        padding: 7px 25px;
        font-size: 1em;
        line-height: 2em;
        border-radius: 5px;
        letter-spacing: 1px;
        display: inline-block;
        margin-bottom: 0;
        font-weight: normal;
        text-align: center;
        text-decoration: none;
        vertical-align: middle;
        cursor: pointer;
        background-image: none;
        border: 1px solid transparent;
        white-space: nowrap;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }
    .jpg-bn {position: relative;}
    .bn-text{text-align:center;color: #373e44; padding: 0 35px;top: 20px !important;position: absolute;}
    .bn-text p {font-size: 20px;font-weight: 400;color: #777 !important;}
    .bn-text .btn {
        background: #d1102b;
        color: #fff;
        font-size: 24px;
        font-weight: 600;
        padding: 4px 10px;
        text-align: center;
        text-transform: uppercase;
        border-radius: 8px;
    }
    .bn-text .btn .fa-angle-right {
        font-size: 22px;
        font-weight: bold;
        position: relative;
        top: 1px;
    }

    .footer-jpg{position:relative;background:#fff;}
    .footer-jpg .row{padding:0 !important;}
    .footer-jpg .row img {display: block;margin:10px 15px;}
    .red-prt{background: #d1102b;color: #fff;TEXT-ALIGN:right;border-bottom-right-radius:65px;padding:10px 0 !important;}
    .red-prt > a {color: #fff;display: inline-block;font-weight: 300;margin-right: 25px;font-size: 30px;}
    .green-prt{background: #79a93c;color: #fff;TEXT-ALIGN:right;border-bottom-right-radius:65px;padding:46px 0;}
    .green-prt > a {color: #fff;display: inline-block;font-weight: 500;margin-right: 25px;font-size: 26px;text-decoration: none;}
    .mosquito-jp .bn-text{text-align:left;color: #fff;}
    .stress-jp .bn-text , .uti-bn .bn-text{text-align:left;color:#373e44;}
    .dr-t {position: relative;}
    .dr-t img{ position: absolute;top: -21px;left:0;}
    .dr-t p{background: #d1102b;color: #fff !important; margin: 0 auto 0 115px;max-width: 325px;padding: 10px 0;  width: 100%;text-align: center;}
    .uti-bn .btn{border-radius:0;text-transform:uppercase;}
    .summer-banner .eb-right .txt-s{border:none;}
    .btn.communicate{position:absolute;bottom:24px;left:15px;right:0;font-size: 22px;font-weight: bold;color:#fff;padding:0;}
    .btn.tips {font-size:16px;line-height:22px;max-width:290px;padding: 8px 10px;position: relative;text-align: left;width: 100%;}
    .btn.tips i {font-size: 35px;position: absolute;right: 10px;top: 10px;}
    .red-txt {
        color: #d1102b !important;
        font-weight: 400;
    }
    .bn-txt {position: absolute;top: 45px;left:20px;}
    .advice img {float: left;}
    .container-fluid .advice {bottom: 12px;position: absolute;left:20px;}
    .btn.btn-advice {background: #da273a;border-radius: 10px;color: #fff;font-size: 18px;font-weight: bold;padding: 10px 20px;position: relative;text-align: center;top: 45px;float: left;}
    @elseif($template->category_id == 4)
    
    @else
    body{margin-bottom: 35px !important;}
    body ,html{font-family:'GothamBook-Regular';text-align: left;overflow-x: hidden;}
    .page-number {text-align: center;}
    .page-number:before {content: "Page " counter(page);}
    #header #logo img {max-width: 160px;}
    .header{height: 100px;}
    .header nav{margin:0;}
    a:focus{ outline:none !important; }
    h1{ font-size:75px !important;line-height: 75px !important;}
    h2{ font-size:52px !important ;line-height:normal !important;}
    h3{ font-size:41px !important; line-height:normal !important;}
    h4{ font-size:38px !important;line-height:normal !important;}
    h5{ font-size:32px !important;line-height:normal !important;}
    h6{ font-size:18px !important;line-height:normal !important;}
    h1, h2, h3 {margin-top: 40px !important;}
    h4, h5, h6 {margin-top: 55px !important;}
    .container-fluid{padding:0 20px;}
    .row{margin-left:-1rem;margin-right:-1rem;}
    .ash-txt{color: #373e44 !important;}
    .red-txt{color: #d1102b !important;}
    .blue-txt{color: #008dcb !important;}
    .bold-txt{font-weight:bold !important;}
    p{color: #373e44;font-size:14px;}
    a{text-decoration:none;color: #d1102b;}
    .banner{  text-align:left; position:relative;}
    .banner img{max-width:100%;}
    .banner h1{line-height:75px;	font-family:'GothamBook-Regular';}
    .banner  h3{ font-weight: lighter;	font-family:'GothamBook-Regular';}
    .banner  h2{font-weight: lighter;line-height:48px;	font-family:'GothamBook-Regular';}
    .bn-txt{top:10px;left:20px;}
    .bn-txt2{top:65px; left: 20px;}
    .bn-txt3{top:100px; left: 20px;}
    .bn-txt4{top:140px; left: 20px;}
    .bn-txt-with-logo{top:25px;left:20px;}
    img {max-width: 100%;}
    .content{overflow:hidden; width:100%;}
    .content h6 { margin: 6px 0 !important;font-family:'GothamNarrow-Book';line-height:normal;}
    .content p{font-size: 14px;line-height:18px;margin: 8px 0;font-family:'GothamNarrow-Book';}
    .content a{	font-family:'GothamBook-Regular';}
    @page  {size: 8.5in and 11.0in;}
    .right-logo {float: right;right: 20px;top: 35px;} 
     .right-logo .navbar-brand {right: 20px;top: 10px;left: auto;float: right;}
    .online-accnt{color:#fff;clear:both;width:97%;display:block;overflow: hidden;  height: 160px;}
    .online-accnt .row{ margin-left:0;}    
    .active-account{padding:10px 30px;color:#fff;clear: both;background: #e32b23;width:100%;height: 90px;}
    .active-account h5 {margin:0;color:#fff;font-weight:400; margin:0 !important;font-size:30px;}
    .active-account h5 a{color:#fff;text-decoration:none;}
    .active-account p{font-size: 14px; font-weight: 500; margin: 0;color:#fff;}
    .active-account h6{color:#fff;line-height:25px;font-size:21px;font-weight:300;margin:0 !important;}
    /*-------------download app--------------*/
    .download-app{padding:5px 0;color:#373e44;border-bottom-right-radius: 35px; clear: both;background:#f5f5f5;float:left;width:100%;height:60px;}
    .dwn-list > li img {margin:6px 0;}
    .download-app p { display: inline-block; font-size: 14px;  margin: 10px 0 0;font-weight: 500;font-family: 'Lato', sans-serif;}
    .download-app ul {list-style: outside none none;padding: 0;margin:4px 0 0;}
    .download-app .container-fluid > table {margin-top: 15px;}
    .absolute {position: absolute;vertical-align: middle;}
    .page-break {page-break-after: always;}
    .footer{clear:both;width:100%; padding:10px 0;}
    .footer p{font-size:9px;margin:0;font-family:'GothamNarrow-Book';}
    #footer {color: #aaa;}
    .clearfix{clear: both;}
    .right-content-lists {background: #f5f5f5 none repeat scroll 0 0;border-bottom-right-radius: 25px;margin: 10px 0;padding: 10px 10px 25px 15px;}
    .right-content-lists p {font-size: 14px;}
    ul.listred {list-style: url("/vendor/content-builder/images/list.jpg"); margin: 0;padding: 0 0 0 15px;}
    ul.listred li {font-size: 14px;font-weight: 300;line-height:20px;margin: 0;}
    .steps {padding: 0 0 0 18px;}
    .steps li { margin-bottom: 10px;}
    .blue-box {background: #428dcc;top: 130px;color: #fff;max-width:340px;padding: 10px 15px 10px 30px;position: absolute;right: 0;}
    .blue-bar.absolute {left: 0;top: 0;}
  .ac-im > img {left: -25px;position: absolute;top: -66px;max-width: 220px;}
   .ac-im p {left:175px;position: absolute;top: -51px;  font-size: 13px;}
    .navbar-header a:nth-child(2) {float: right;}
    .navbar-header {width: 100%;}
    ul.listred {list-style: outside url("/vendor/content-builder/images/list.jpg") disc;margin: 0;padding: 0 0 0 15px;}
    ul.listred li {font-size: 14px;font-weight: 500;line-height: normal;margin: 0;}
    .appmd{margin-top:-10px;}
     .online-accnt {height: 170px;}
    @endif
    [class^="cb-icon-"]::before, [class*=" cb-icon-"]::before{line-height: 30px !important;}
    #panelCms {width:100%;height:57px;border-top: #eee 1px solid;background:rgba(255,255,255,0.95);position:fixed;left:0;bottom:0;padding:10px;box-sizing:border-box;text-align:center;white-space:nowrap;z-index:10001;}
    #panelCms button {border-radius:4px;padding: 10px 15px;text-transform:uppercase;font-size: 11px;letter-spacing: 1px;line-height: 1;}
    #panelCms .btn.btn-primary {background-color: #d0112b;color: #ffffff;font-size: 14px;line-height: 15px;padding: 10px 20px;text-transform: uppercase;}
    .is-container {  margin:0 auto; max-width:710px; width:100%;box-sizing:border-box; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);background:#fff;}  
    .banner h2, .banner h3, .banner h4, .banner h5, .banner h6 { font-family: "GothamNarrow-Book";}
</style>
<!--<div class="row">-->
{{-- model general errors from the form --}}
@if($errors->has('model') )
<div class="alert alert-danger">{!! $errors->first('model') !!}</div>
@endif

{{-- successful message --}}
<?php $message = Session::get('message'); ?>
@if( isset($message) )
<div class="alert alert-success">{{$message}}</div>
@endif
<div id="err"></div>
<div  id="contentarea">                        
    {!! $template->template_content !!}                             
</div>

<div id="panelCms"><br>
    <a href="{{URL::route("templates.list")}}" class="btn btn-primary" style = "background-color: #d0112b;">Back to template list</a>
    {{ Form::button('Update', array('onclick'=>'save()', 'class' => 'btn btn-primary' , "style" => "background-color: #d0112b;")) }}
</div>
<!--</div>-->
<div class="modal fade" id="saveTemplateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Update your template name</h4>
            </div>            
            {!! Form::open(['url' => [URL::route('templates.edit'), $template->id], 'method' => 'post', 'id' => 'createTemplateForm'] ) !!}
            <div class="modal-body">
                <div id="formmsg"></div>
                <div class="form-group">
                    {!! Form::text('template_name', $template->template_name, ['class' => 'form-control', 'placeholder' => 'Template name']) !!}
                </div>
                <div class="hidden">
                    {!! Form::hidden('id', $template->id) !!}
                    {!! Form::hidden('print', 0, ["id" => "printTemplate"]) !!}
                    {!! Form::hidden('category_id', $template->category_id) !!}                        
                    {!! Form::hidden('template_content', $template->template_content, ["id"=>"hidContent"]) !!}            
                    @if($user_group == "health system")
                    {!! Form::hidden('verticles', 'health_system') !!}
                    @elseif($user_group == "health plan")
                    {!! Form::hidden('verticles', 'health_plan') !!}
                    @elseif($user_group == "employer")
                    {!! Form::hidden('verticles', 'employer') !!}
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="btnPost" style = "background-color: #d0112b;">Update</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@stop

@section('footer_scripts')
@include('content-builder::tpl') 
<script>
    function save() {
        var sContent = $('#contentarea').data('contentbuilder').html();
        if (sContent == "") {
            $("#err").html("<span class='text-danger'>Template content cannot be left empty.</span>");
        } else {
            $("#err").html("");
            $('#hidContent').val(sContent);
            $('#saveTemplateModal').modal('show');
        }
    }

    function printTemplate() {
        var sContent = $('#contentarea').data('contentbuilder').html();
        if (sContent == "") {
            $("#err").html("<span class='text-danger'>Template content cannot be left empty.</span>");
        } else {
            $("#err").html("");
            $('#printTemplate').val("1");
            $('#hidContent').val(sContent);
            $('#saveTemplateModal').modal('show');
        }
    }

    $(document).ready(function () {
        $('#createTemplateForm').on("submit", function (e) {
            e.preventDefault();
            var $form = $("#createTemplateForm");
            var dataString = $form.serialize();
            var formAction = $form.attr('action');
            var printTemplate = $("#printTemplate").val();

            $.ajaxSetup({
                headers: {'X-CSRF-Token': $('input[name=_token]').val()}
            });

            $.ajax({
                type: "post",
                url: formAction,
                data: dataString,
                cache: false,
                success: function (data) {
                    if (printTemplate == 1) {
                        $("#formmsg").fadeIn().html("<div class='alert alert-success'>Your template is printing...</div>");
                        location.href = "/admin/templates/print?id={{ $template->id }}"
                    } else {
                        $("#formmsg").fadeIn().html("<div class='alert alert-success'>Template updated successfully.</div>");
                        setTimeout(function () {
                            location.href = "/admin/templates/list/"
                        }, 1000);
                    }

                },
                error: function (data) {
                    var err = "";
                    if (data.responseJSON.template_name)
                        var err = err + "<span class='text-danger'>Template name is required.</span>";
                    if (data.responseJSON.template_content)
                        var err = err + "<br><span class='text-danger'>Template content cannot be left empty.</span>";
                    if (err != "")
                        $("#formmsg").fadeIn().html(err);
                }
            }, "json");
            return false;
        });
    });
</script>

@stop
