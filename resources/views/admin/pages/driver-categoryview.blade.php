@extends('admin.layouts.base-1cols')

@section('title')
    Driver Category | Free Firmware
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
            <h1 id="pageTitle">For {{ ucwords($request->driverType) }}</h1>
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
                            <a href="{{ route('driver.category.driver') }}/{{ $result->id }}" target="_blank">
                                <img class="img-responsive" style='max-width: 100px; margin: auto; vertical-align: middle' src="/images/drivers.ico"/>
                            </a>
                        </div>

                        <div class="col-md-10">
                            <h3><a href="{{ route('driver.category.driver') }}/{{ $result->id }}">{!!$result->title !!}</a></h3>
                            <hr>
                            <p>  {!!  substr($content, 0, strrpos(substr($content, 0, 250), " ")).' ...' !!} <a target="_blank" href="{{ route('driver.category.driver') }}/{{ $result->id }}">Learn more</a></p>
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

