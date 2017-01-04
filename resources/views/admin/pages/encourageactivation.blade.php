@extends('admin.layouts.base-1cols')

@section('title')
Encourage Activarion | MDLive Marketing
@stop

@section('content')
<div id="encourage-activation-bn" class="banner" style='background: rgba(0, 0, 0, 0) url("/{!! $page->banner_image!!}") repeat scroll right top / cover;height: 458px;'>
    <div class="container-fluid">
        <h1>{!! $page->banner_title !!}</h1>
        {!! $page->banner_description !!}
    </div>
</div>
<div class="contents encourage">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="details">
                    {!! $page->content !!}
                    <!--                    <h2>Consumer Overview</h2>
                                        <p class="itemdesc"><strong>What is it?</strong>   Concise overview of MDLIVE and the non-emergency and behavioral health conditions we treat so members and/or employees know when to use the virtual care service.  English and Spanish language versions available.</p>  
                                        <p class="itemdesc"><strong>How to use it:</strong>  Distribute to all members and/or employees that are eligible to use the MDLIVE virtual care service.  Attach to all new employee emails and include in digital Welcome Kits and benefits packages. Choose the overview that matches the MDLIVE benefit your organization offers:  medical only or medical and behavioral health combined.</p>
                                        <ul>
                                                <li><a target="_blank" href="http://www.mdlivemarketing.com/wp-content/uploads/2016/05/MDLIVE-Consumer-Overview-MEDICAL-ENG.pdf">Medical Only (English)</a></li>
                                                <li><a target="_blank" href="http://www.mdlivemarketing.com/wp-content/uploads/2016/05/MDLIVE-Consumer-Overview-THERAPY-ENG.pdf">Medical &amp; Behavioral Health (English)</a></li>
                                                <li><a target="_blank" href="http://www.mdlivemarketing.com/wp-content/uploads/2016/04/MDLIVE-Consumer-Overview-MEDICAL-SPA.pdf">Medical Only (Spanish)</a></li>
                                                <li><a target="_blank" href="http://www.mdlivemarketing.com/wp-content/uploads/2016/04/MDLIVE-Consumer-Overview-THERAPY-SPA.pdf">Medical &amp; Behavioral Health (Spanish)</a></li>
                                        </ul>-->
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="details">
                    {!! $page->FAQ !!}
                    <!--                    <h2>FAQs</h2>
                                        <p class="itemdesc"><strong>What is it?</strong> Common questions members and/or employees ask about MDLIVE.</p>  
                                        <p class="itemdesc"><strong>How to use it:</strong> Distribute to all members and/or employees that are eligible to use the MDLIVE virtual care service.  Attach to all new employee emails and include in digital Welcome Kits and benefits packages.</p>
                                        <ul>
                                                <li><a target="_blank" href="http://www.mdlivemarketing.com/wp-content/uploads/2016/04/MDLIVE-FAQs_Medical.pdf">Medical Only</a></li>
                                                <li><a target="_blank" href="http://www.mdlivemarketing.com/wp-content/uploads/2016/04/MDLIVE-FAQs_Therapy-1.pdf">Behavioral Health Only</a></li>
                                        </ul>-->

                </div>
            </div>
        </div>
    </div>
</div>
@stop

@if( count($user_data->user_profile()->first()) > 0 && (strtolower($user_data->groups()->first()->name)=="health system" || strtolower($user_data->groups()->first()->name)=="health plan" || strtolower($user_data->groups()->first()->name)=="employer"))
@section('footer_scripts') 
<script>
    $(document).ready(function () {
        var ajpath = window.location.href;
        $.ajax({
            dataType: "json",
            url: '/admin/pagelog/',
            data: {log_name: 'encourage-activation-page', title: 'Encourage Activation page', path:ajpath},
            success: function (result) {
            },
        });
    });
</script>
@stop
@endif