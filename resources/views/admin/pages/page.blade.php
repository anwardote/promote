@extends('admin.layouts.base-1cols')

@section('title')
    Welcome | Home Page
@stop

@section('content')
    <!---slider----->
    @if(!empty($sliders))
        <div id="mdlive-slider" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                @foreach( $sliders as $key => $slide)
                    <li data-target="#mdlive-slider" data-slide-to="{{ $key }}"
                        @if($key == 0)class="active" @endif></li>
                @endforeach
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                @foreach( $sliders as $key => $slide )
                    <div class="item @if($key == 0) active @endif">
                        <div class="slides"
                             style='height:380px;background: rgba(0, 0, 0, 0) url("/{{ $slide->image }}") no-repeat scroll 0 0 / cover ;'>
                            @if($slide->title !='.')
                                <h1>{!! $slide->title !!}</h1>
                            @endif
                            <p>{!! $slide->content !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else

        <div id="mdlive-slider" class="carousel slide">
            <div class="item active">
                <div class="slides"
                     style='height:380px;background: rgba(0, 0, 0, 0) url("/{{ $page->banner_image }}") no-repeat scroll 0 0 / cover ;'>
                    @if($page->banner_title !='.')
                        <h1>{!! $page->banner_title !!}</h1>
                    @endif
                    <h1>{!! $page->banner_title !!}</h1>
                    <p>{!! $page->banner_description !!}</p>
                </div>
            </div>


        </div>

    @endif

    <section class="drak-grey ">
        <div class="container-fluid paddedTop">
            <h2>{!! $page->title !!} </h2>
            {!! $page->content !!}
        </div>
    </section>
    <section id="essentials">
        @foreach( $home_rows as $key => $home )
            <a class="paddedTopBottom" href="{!! $home->slug !!}">
                <div class="row">
                    <div class="col-sm-3"><img class="alignnone size-full wp-image-773 mdliveShape"
                                               alt="thumb-checklist" src="/{!! $home->image !!}"></div>
                    <div class="col-sm-9 ">
                        <h2>{!! $home->title !!}</h2>
                        {!! $home->content !!}

                    </div>
                </div>
            </a>
        @endforeach

    </section>

@stop
