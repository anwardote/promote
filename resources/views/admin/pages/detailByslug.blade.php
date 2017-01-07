@extends('admin.layouts.base-1cols')

@section('title')
    Our Business | Free Firmware
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
        border: 1px solid grey;
        margin-top: 10px;
        padding: 5px;
        border-radius: 4px;
    }

    .perCategoryWrapper hr {
        margin-top: 5px;
        margin-bottom: 5px;
        border-top: 1px solid #eee;
        border: 1px transparent gray;
        color: black;
    }
</style>

@section('content')
    <div id="newsWrappers">
        <div class="containers">
            <div class="col-md-12">
                <br>
            </div>
            <div class="col-md-12 perCategoryWrapper">
                <div class="col-md-12">
                    <p style="display: inline-block">
                    <h2 style="text-align: center">{!!$result->title !!}</h2>
                    <hr>
                    @if ($result->source)
                        <?php  $pattern1 = '/watch\?v\=/'; ?>
                        @if (preg_match($pattern1, $result->source))
                            <?php $source = preg_replace($pattern1, 'embed/', $result->source); ?>
                        @else
                            <?php $source = $result->source; ?>
                        @endif
                        <iframe style="float: right; margin: 0px 15px 15px 0px; max-width: 500px"
                                class="com-md-5 col-sm-5 col-xs-12" height="286" src="{!! $source !!}"
                                frameborder="0" allowfullscreen>
                        </iframe>
                    @else
                        <img style="float: right; margin: 0px 15px 15px 0px; max-width: 500px"
                             src="/{{ $result->image }}" class="img-responsive"/>
                        @endif
                        <?php  echo str_replace('[stop]', ' ', $result->content); ?>
                        </p>
                        @if ($result->source)
                            <?php  $pattern1 = '/watch\?v\=/'; ?>
                            @if (preg_match($pattern1, $result->source))
                                <?php $source = preg_replace($pattern1, 'embed/', $result->source); ?>
                            @else
                                <?php $source = $result->source; ?>
                            @endif
                            <h1>Video Tutorial</h1>
                            <br>
                            <iframe class="com-md-5 col-sm-5 col-xs-12" height="286" src="{!! $source !!}"
                                    frameborder="0" allowfullscreen>
                            </iframe>
                        @endif

                </div>
            </div>
            <div style="clear:both;"></div>
        </div>
    </div><br>

@stop

