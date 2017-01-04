@extends('admin.layouts.base-1cols')

@section('title')
    Tutorial | Free Firmware
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
        width: 130px;
        font-weight: 800;
    }

    .writer-profile-box {
    }

    .writer-profile-box h3 {
        text-align: center
    }

    #newsWrapper h3 {
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


@section('content')

    <div id="newsWrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12 perCategoryWrapper">

                    <h3>{{ $result->title }} </h3>
                    <hr>
                    <p><span class="wrapperLabel">Tutorial ID </span> :
                        <?php
                        echo $result->id;
                        ?>
                    </p>
                    <p><span class="wrapperLabel">Requirements </span> :
                        <?php
                        echo $result->requirements;
                        ?>
                    </p>


                    <a href="" target="_blank" class="pull-right temp-image-thumb">
                        <img class="img-responsive"
                             style='max-width: 100px; padding-top:25px; margin: auto;'
                             src="/images/tutorial-icon.png"/>
                    </a>
                    <p><span class="wrapperLabel">Step-by-Step </span> : Please follow Step by steps with carefully.
                    </p>
                    <?php echo $result->description; ?>
                    <p><span class="wrapperLabel">Noted </span>
                        <?php echo $result->noted ?>
                    </p>
                    <hr>
                    <p><span>Created at {!! date("M d, Y", strtotime($result->created_at)) !!}</span></p>


                </div>

            </div>


            <div style="clear:both;"></div>
        </div>
    </div><br>

@stop

