@extends('admin.layouts.base-1cols')

@section('title')
    Tool List | Free Firmware
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
            <h1 id="pageTitle">Tool</h1>
            <h4>Collection of most popular tools. You can download and share those tool for you and your friends.</h4>
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
                            <a href="{{ route('tool.category.tool') }}/{{ $result->id }}">
                                <img class="img-responsive" style='max-width: 100px; margin: auto; vertical-align: middle' src="/images/tool.png"/>
                            </a>
                        </div>

                        <div class="col-md-10">
                            <h3><a href="{{ route('tool.category.tool') }}/{{ $result->id }}">{!!$result->title !!}</a></h3>
                            <hr>
                            <p>
                                <?php
                                    $shortDescription = $result->instructions;

                                 echo substr($shortDescription, 0, strrpos(substr($shortDescription, 0, 200), " ")).' ...';
                                ?>

                            </p>
                            <hr>
                            <p><span>Created at  {!! date("M d, Y", strtotime($result->created_at)) !!}</span><span class="pull-right"><a href="{{ route('tool.category.tool') }}/{{ $result->id }}" >Read More &raquo;</a></span></p>
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

