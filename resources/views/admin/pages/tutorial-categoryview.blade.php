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
            <div class="row">
                <div class="col-md-12">
            <h1 id="pageTitle">Tutorials</h1>
            <h4>Collection of evergreen step-by-step guides and detailed root tutorials to help you do more on your android, tablets, smartphone, symbian devices.</h4>
        </div>
        </div>
        </div>
    </div>

    <div id="newsWrappers">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                @foreach ($results as $result)

                    <?php
                    $date = $result->created_at;
                    ?>

                    <div class="col-md-12 perCategoryWrapper">
                        <div class="col-md-2">
                            <a href="{{ route('tutorial.category.tutorial') }}/{{ $result->id }}" target="_blank">
                                <img class="img-responsive" style='max-width: 100px; margin: auto; vertical-align: middle' src="/images/tutorial-icon.png"/>
                            </a>
                        </div>

                        <div class="col-md-10">
                            <h3><a href="{{ route('tutorial.category.tutorial') }}/{{ $result->id }}">{!!$result->title !!}</a></h3>
                            <hr>
                            <p>
                                <?php
                                $shortDescription='';
                                if(empty($result->st_instruct) || $result->st_instruct ==''){
                                    $shortDescription = $result->description;
                                } else {
                                    $shortDescription = $result->st_instruct;
                                }
                                echo substr($shortDescription, 0, strrpos(substr($shortDescription, 0, 200), " ")).' ...';
                                ?>

                            </p>
                            <hr>
                            <p><span>Created at  {!! date("M d, Y", strtotime($result->created_at)) !!}</span><span class="pull-right"><a href="{{ route('tutorial.category.tutorial') }}/{{ $result->id }}" target="_blank">Read More &raquo;</a></span></p>
                        </div>
                    </div>
                @endforeach


                <div class="paginator">
                    {{ $results->appends($request->except(['page']) )->render() }}
                </div>
                </div>
            </div>


            <div style="clear:both;"></div>
        </div>
    </div><br>

@stop

