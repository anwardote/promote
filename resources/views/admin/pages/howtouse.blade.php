@extends('admin.layouts.base-1cols')

@section('title')
    How to use | Home Page
@stop
@section('head_css')
    <style>
        #essentials a img {
            border-bottom-right-radius: 0;
        }
    </style>
@stop
@section('content')
    <?php
    function setVar($var, $dynamic_var)
    {
        $search = array('[mobile1]', '[mobile2]', '[email1]', '[email2]');
        $replace = array($dynamic_var['mobile1'], $dynamic_var['mobile2'], $dynamic_var['email1'], $dynamic_var['email2']);
        $var = str_replace($search, $replace, $var);
        return $var;
    }
    ?>
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

                                <div class="com-md-6 col-sm-6 col-xs-12">
                                    <div class="c-txt-left">
                                        <h1>{!! setVar($slide->title, $dynamic_var) !!}</h1>
                                        <p>{!! setVar($slide->content, $dynamic_var) !!}</p>
                                    </div>
                                </div>
                                @if ($slide->image)
                                    <div class="com-md-6 col-sm-6 col-xs-12">
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

    {{--<section class="drak-grey ">--}}
    <section class="drak-grey">
        <div class="container-fluid paddedTop">
            <h1 style="text-align: center; color:white; margin-bottom: 10px">{!! setVar($page->title, $dynamic_var) !!} </h1>
            <h4 style="text-align: center; color:white">{!! setVar($page->content, $dynamic_var) !!}</h4>
        </div>
    </section>
    <section id="essentials">
        @foreach( $home_rows as $key => $home )
            <div class="row">

                <a class="paddedTopBottom" href="{!! route('home.business').'/'.$home->slug !!}">
                    <div class="col-sm-3" style="text-align: center">
                        <img style="width: 270px; vertical-align: text-bottom" alt="thumb-checklist" src="/{!! $home->image !!}">
                    </div>
                    <div class="col-sm-9">
                        <h2>{!! setVar($home->title, $dynamic_var) !!}</h2>
                        {{--{!! setVar($home->content, $dynamic_var) !!}--}}
                        <?php $content= setVar($home->content, $dynamic_var);
                        $content=explode('[more]', $content);
                        $content=$content[0];
                        ?>
                        {{--{!! $content !!}--}}
                        {!!  substr($content, 0, strrpos(substr($content, 0, 850), " ")).' ...' !!} <span style="color:red">Learn more</span>
                    </div>
                </a>
            </div>

        @endforeach

    </section>

@stop
