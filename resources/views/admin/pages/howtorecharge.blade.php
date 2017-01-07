@extends('admin.layouts.base-1cols')

@section('title')
    How to Recharge | Free Firmware
@stop

@section('head_css')
    <style>
        #faqTop {
            padding-top: 80px;
        }

        #faqTop #topText {
            font-size: 29px;
            margin: 0px;
            padding-top: 20px;
            padding-bottom: 40px;
        }

        #faqsWrap {
            padding-bottom: 20px;
        }

        #faqsWrap .question {
            border-top: solid 1px #9e9fa1;
            background-color: #f3f3f3;
            padding: 17px 10px 17px 0px;
            font-size: 21px;
            background-image: url(../images/faq-plus.png);
            background-repeat: no-repeat;
            background-position: 15px center;
            padding-left: 47px;
            cursor: pointer;
        }

        #faqsWrap .question:hover {
            background-color: #ececec;
        }

        #faqsWrap .question.active:hover {
            background-color: #f3f3f3;
        }

        #faqsWrap .question.active {
            color: #d0112b;
            font-weight: 500;
            background-image: url(images/faq-minus.png);
        }

        #faqsWrap .answer {
            padding: 0px 47px;
            background-color: #f3f3f3;
            padding-bottom: 5px;
            font-size: 19px;
            display: none;
        }

        #faqsWrap .answer p:first-child {
            margin-top: 0px;
        }

        #faqsWrap .answer p:last-child {
            margin-bottom: 15px;
        }

        #faqsWrap #bLine {
            height: 1px;
            background-color: #9e9fa1;
        }

        #faqsWrap h3 {
            margin: 25px 0px;
            padding: 0px;
            color: #d0112b;
            font-size: 31px;
            text-align: center;
            font-family: "Gotham A", "Gotham B";
            font-style: normal;
            font-weight: 400;
        }

        #faqsWrap #disclaimerText {
            font-size: 17px;
        }

        #faqsWrap .question.active {
            color: #d0112b;
            font-weight: 500;
            background-image: url(css/faq-minus.png);
        }

        #faqsWrap .question {
            border-top: solid 1px #9e9fa1;
            background-color: #f3f3f3;
            padding: 17px 10px 17px 0px;
            font-size: 21px;
            background-image: url(css/faq-plus.png);
            background-repeat: no-repeat;
            background-position: 15px center;
            padding-left: 47px;
            cursor: pointer;
        }

        .faqss .question {
            height: auto;
            line-height: normal;
            text-align: left;
            color: #53565a;
        }

        .case-std {
            font-family: 'GothamNarrow-Book';
            color: #53565a;
            float: left;
            font-size: 25px;
            font-weight: 400;
            margin-bottom: 40px;
            margin-left: 16px;
            padding: 0 !important;
        }

        div {
            display: block;
        }

        body {
            margin: 0px;
            padding: 0px;
            font-size: 16px;
            font-family: "Gotham Narrow A", "Gotham Narrow B";
            font-style: normal;
            font-weight: 400;
            letter-spacing: -0.2px;
        }

        .sheets-inner {
            float: left;
            width: 100%;
            margin: 0 0 40px;
            padding: 0 6px 0 0;
        }

        .sheets-inner .right-s-vd {
            float: left;
            width: 55%;
        }

        .sheets-inner {
            float: left;
            width: 100%;
            margin: 0 0 40px;
            padding: 0 6px 0 0;
        }

        .sheets-inner.vvd > a {
            color: #d0112b;
            font-size: 16px;
            text-decoration: none;
            float: left;
            width: 42%;
        }

        .col-md-6 {
            padding-left: 0;
            padding-right: 0;
        }

        .sheets-inner .right-s-vd a {
            color: #d0112b;
            font-size: 16px;
            text-decoration: none;
            display: inline;
            padding-top: 0;
        }

        .right-s-in {
            display: table;
        }

        #howtouse-top h2 {
            margin: 25px 0px;
            padding: 0px;
            color: #d0112b;
            font-size: 31px;
            text-align: center;
            font-family: "Gotham A", "Gotham B";
            font-style: normal;
            font-weight: 400;
        }


    </style>
@stop

@section('content')
    <div id="how-to-use">

        <!---slider----->
        @if(!empty($sliders))
            <div id="howtouse-top">
                <!---carousel---->
                <div id="howtouse-carousel" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">

                        @foreach( $sliders as $key => $slide )
                            <div class="item @if($key == 0) active @endif">
                                <div class="slides">

                                    <div class="com-md-7 col-sm-7 col-xs-12">
                                        <div class="c-txt-left">
                                            <h1>{!! $slide->title !!}</h1>
                                            <p>{!! $slide->content !!}</p>
                                        </div>
                                    </div>
                                    @if ($slide->image)
                                        <div class="com-md-5 col-sm-5 col-xs-12">
                                            <img src="/{!! $slide->image !!}" height="286">
                                        </div>
                                    @else
                                        <?php  $pattern1 = '/watch\?v\=/'; ?>
                                        @if (preg_match($pattern1, $slide->source))
                                            <?php $source = preg_replace($pattern1, 'embed/', $slide->source); ?>
                                        @else
                                            <?php $source = $slide->source; ?>
                                        @endif
                                        <iframe class="com-md-5 col-sm-5 col-xs-12" height="286" src="{!! $source !!}"
                                                frameborder="0" allowfullscreen>
                                        </iframe>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Controls -->
                    <ol class="carousel-indicators" style="margin-top: 20px">
                        @foreach( $sliders as $key => $slide)
                            <li data-target="#howtouse-carousel" data-slide-to="{{ $key }}"
                                @if($key == 0)class="active" @endif></li>
                        @endforeach
                    </ol>
                </div>
            </div>

        @endif


        <div style="height:60px;"></div>

        <div id="faqsWrap" class="faqss">
            <div class="">
                @if(count($rechargeType)!=0 )
                    <?php
                    $i = 1;
                    ?>
                    @foreach ($rechargeType as $a)
                        <h2 class="question pannel-head active"><img style="height: 40px"
                                                                     src="{{ $a->image }}"/>
                            {{ $a->type_name }}</h2>
                        <div class="resource-area">
                            <div class="row">
                                <?php
                                $content = str_replace('[banking_name]', '<span style="color:red">' . $a->type_name . '</span>', $a->description);
                                $content = str_replace('[bank_account]', '<span style="color:red">' . $a->ac_no . '</span>', $content);
                                ?>
                                <div class="col-sm-12">
                                    <div class="sheets-inner">
                                        <img
                                                    style="max-width: 180px"
                                                    src="{{ $a->image }}"/>
                                        <div class="right-s-in">
                                            <?php echo $content ?>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    @endforeach
                @endif
            </div>
        </div>

    </div>
    <div style="height:60px;"></div>
@stop
