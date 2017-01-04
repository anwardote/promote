@extends('admin.layouts.base-1cols')

@section('title')
    Firmware Category | Free Firmware
@stop


<style>

    #getStartedFormWrapper #formWrap input[type="submit"], form.wpcf7-form input[type="submit"] {
        height: 50px !important;
        width: 180px !important;
        font-size: 18px !important;
    }

    #TagPopup_FormContainerBody p.modalform {
        margin: 5px 0;
        font-size: 14px;
    }

    .wpcf7-form-control-wrap textarea {
        height: 80px;
        resize: none;
    }

    .modalform .wpcf7-form-control-wrap input {
        height: 25px;
    }

    #TagPopup_FormContainerBody form div {
        border: medium none;
        margin: 5px 0;
        padding: 0;
        text-align: left;
    }

    /*#newsWrap {*/
    /*width:745px;*/
    /*float:left;*/
    /*border-right:solid 2px #b4b4b4;*/
    /*padding-right:60px;*/
    /*}*/
    /*#pressWrap {*/
    /*float:right;*/
    /*width:350px;*/
    /*}*/
    /*#newsWrapper {*/
    /*padding:30px 0px;*/
    /*}*/
    /*#newsWrapper .newsArtWrap {*/
    /*margin-bottom:35px;*/
    /*}*/
    /*#newsWrapper .newsArtWrap.lp {*/
    /*margin-bottom:20px;*/
    /*}*/
    /*#newsWrapper .newsArtWrap .picWrap {*/
    /*width:100px;*/
    /*float:left;*/
    /*}*/
    /*#newsWrapper .newsArtWrap .newsInfo {*/
    /*float:right;*/
    /*max-width:550px;*/
    /*font-size:17px;*/
    /*}*/

    /*@media only screen and (max-width: 580px){*/
    /*#newsWrapper .newsArtWrap .newsInfo {*/
    /*max-width:350px;*/
    /*}*/
    /*#newsWrapper .newsArtWrap .newsInfo {*/
    /*float:right;*/
    /*max-width:550px;*/
    /*font-size:17px;*/
    /*}*/
    /*}*/
    /*#newsWrapper .newsArtWrap .newsInfo.wide {*/
    /*width:870px;*/
    /*}*/
    /*#newsWrapper .newsArtWrap .newsInfo .newsDate {*/
    /*color:#000000;*/
    /*}*/
    /*#newsWrapper .newsArtWrap .newsInfo h3 {*/
    /*color:#d0112b;*/
    /*font-size:19px;*/
    /*font-family: "Gotham Narrow A", "Gotham Narrow B";*/
    /*font-style: normal;*/
    /*font-weight: 400;*/
    /*margin:0px;*/
    /*padding:0px;*/
    /*}*/
    /*#newsWrapper .newsArtWrap .newsInfo p {*/
    /*margin:0px;*/
    /*padding:0px;*/
    /*}*/
    /*#newsWrapper .newsArtWrap .newsInfo a {*/
    /*color:#d0112b;*/
    /*text-decoration:none;	*/
    /*}*/
    /*#newsWrapper .pressWrapItem {*/
    /*margin-bottom:20px;*/
    /*}*/
    /*#newsWrapper .pressWrapItem h3 {*/
    /*font-family: "Gotham Narrow A", "Gotham Narrow B";*/
    /*font-style: normal;*/
    /*font-weight: 400;*/
    /*font-size:17px;*/
    /*margin:0px;*/
    /*padding:0px;*/
    /*}*/
    /*#newsWrapper .pressWrapItem h3 a {*/
    /*color:#d0112b;*/
    /*text-decoration:none;*/
    /*}*/
    /*h1#pageTitle {*/
    /*margin: 0px;*/
    /*padding: 0px;*/
    /*color: #d0112b;*/
    /*font-size: 56px;*/
    /*font-family: "Gotham A", "Gotham B";*/
    /*font-style: normal;*/
    /*font-weight: 400;}*/
    /*#faqTop {*/
    /*padding-top: 60px;*/
    /*padding-bottom: 20px;*/
    /*}*/
    .perCategoryWrapper {
        border:1px solid grey;
        margin-top:10px;
        padding:5px;
        border-radius: 4px;
    }
    .perCategoryWrapper hr {
        margin-top: 5px;
        margin-bottom: 5px;
        border-top: 1px solid #eee;
        border: 1px transparent gray;
        color:black;
    }
</style>


@section('content')
    <div id="faqTop">
        <div class="container">
            <h1 id="pageTitle">For {{ ucwords($request->deviceType) }} Phone</h1>
        </div>
    </div>

    <div id="newsWrapper">
        <div class="container">
            <div class="row">

                @foreach ($results as $result)

                    <?php
                    $date = $result->created_at;
                    $content = preg_replace('#<img[^>]*>#i', '', $result->description);
                    ?>

                    <div class="col-md-12 perCategoryWrapper">
                        <div class="col-md-2">
                            <a href="{{ route('firmware.category.firmware') }}/{{ $result->id }}" target="_blank">
                                <img class="img-responsive" style='max-width: 100px; margin: auto; vertical-align: middle' src="/assets/icons/{{$request->deviceType}}-category-icon.png"/>
                            </a>
                        </div>

                        <div class="col-md-10">
                            <h3><a href="{{ route('firmware.category.firmware') }}/{{ $result->id }}">{!!$result->title !!}</a></h3>
                            <hr>
                            <p>  {!!  substr($content, 0, strrpos(substr($content, 0, 250), " ")).' ...' !!} <a target="_blank" href="{{ route('firmware.category.firmware') }}/{{ $result->id }}">Learn more</a></p>
                            <hr>
                            <p><span>Created at  {!! date("M d, Y", strtotime($result->created_at)) !!}</span></p>
                        </div>
                    </div>
                @endforeach


                <div class="paginator">
                    {{ $results->appends($request->except(['page']) )->render() }}
                </div>
            </div>


            <div style="clear:both;"></div>
        </div>
    </div><br>

@stop

