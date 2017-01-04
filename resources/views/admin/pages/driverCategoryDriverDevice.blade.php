@extends('admin.layouts.base-1cols')

@section('title')
    Driver Category Driver | Free Firmware
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

    .wrapperLabel {
        display: inline-block;
        width: 150px;
        font-weight: 800;
    }

    .writer-profile-box {
    }

    .writer-profile-box h3 {
        text-align: center
    }
</style>


@section('content')
    <div id="faqTop">
        <div class="container">
            <h1 id="pageTitle"> {{ $category->title }} </h1>
            <hr>
            <p class="image-pull-right"><?php echo $category->description; ?></p>
        </div>

    </div>

    <div id="newsWrapper">
        <div class="container">
            <div class="row">
                @foreach ($results as $result)
                    <?php
                    $date = $result->created_at;
                    ?>
                    <div class="col-md-12 perCategoryWrapper">
                        <div class="col-md-2">
                            <div class="writer-profile-box">
                                <a href="" target="_blank">
                                    <img class="img-responsive"
                                         style='max-width: 100px; padding-top:25px; margin: auto;'
                                         src="{{ $result->user_profile()->presenter()->avatar(170) }}"/>
                                </a>
                                <?php $username = $result->user_profile()->first_name; ?>
                                <p>
                                <h3>@if(empty($username) || $username=='')
                                        {{"User"}}
                                    @else
                                        {{ $username }}
                                    @endif
                                </h3>
                                </p>
                            </div>
                        </div>

                        <div class="col-md-10">

                            <h3>{{ $result->driver_model }} </h3>
                            <hr>
                            <p><span class="wrapperLabel">Driver Model </span> : {{ $result->driver_model }}</p>
                            <a href="" target="_blank" class="pull-right temp-image-thumb">
                                <img class="img-responsive"
                                     style='max-width: 100px; padding-top:25px; margin: auto;'
                                     src="/{{ $result->driver()->first()->image }}"/>
                            </a>
                            <p><span class="wrapperLabel">Driver Type </span> :
                                @foreach($result->getDriverTypeName($result->driver_type) as $val)
                                    {{ $val['name'] }},
                                @endforeach
                            </p>
                            <p><span class="wrapperLabel">Supports </span> : {{ $result->supports }}
                            <p><span class="wrapperLabel">Driver For </span> : {{ $result->driver()->first()->name }}
                            </p>
                            <p><span class="wrapperLabel">Download Size </span> : {{ $result->d_sizes }}</p>
                            <p><span class="wrapperLabel">How to Flash </span> :
                                @if(!empty($result->tutorial_id) && $result->tutorial_id !=null)

                                    <a href="{{ route('tutorial.category.tutorial').'/'.$result->tutorial_id }}"
                                       target="_blank">
                                        Click here to get instruction</a>
                                @else
                                    {{ 'No tutorial available!' }}
                                @endif
                            </p>
                            <span class="wrapperLabel">Download Link(s) </span> :
                            <?php
                            $downloadArr = explode(',', $result->d_links);
                            $i = 1;
                            ?>
                            @foreach($downloadArr as $val)
                                <a href="{{$val}}" target="_blank">Download Link {{ $i++ }}</a> ,
                                @endforeach
                                </p>
                                <hr>
                                <p>
                                    <span>Created at {!! date("M d, Y", strtotime($result->created_at)) !!}</span><span
                                            class="pull-right"><a href=""
                                                                  target="_blank">Read More &raquo;</a></span>
                                </p>
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

@section('footer_scripts')
    <script>
        $(document).ready(function (e) {

            $('#faqTop .image-pull-right img').addClass('pull-right');
        })

    </script>

@stop



