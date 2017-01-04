<form id="live-search-area">

    <div class="col-md-12">
        <div class="col-md-3">
            <div class="form-group">
                <?php
                array_unshift($fcategory_output_values, 'Category');
                ?>
                {!! Form::select('fcategory_id', $fcategory_output_values, '', ["class"=>"form-control"]) !!}
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <?php
                array_unshift($device_output_values, 'Device');
                ?>
                {!! Form::select('device_id', $device_output_values, '', ["class"=>"form-control"]) !!}
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <?php
                array_unshift($country_output_values, 'Country');
                ?>
                {!! Form::select('country_id', $country_output_values, '', ["class"=>"form-control"]) !!}
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <?php
                array_unshift($status_values, 'Status');
                ?>
                {!! Form::select('status', $status_values, '', ["class"=>"form-control"]) !!}
            </div>            
        </div>
    </div>


    <div class="col-md-12">
        <div class="col-md-3">
            <div class="form-group">
                <input type="text" name="device_model" value="{!! $request['device_model'] !!}" id="contentkeyword" placeholder="Model search" class="form-control liveSearch" />
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <div class="form-group">
                    <input type="text" name="device_version" value="{!! $request['device_version'] !!}" id="contentkeyword" placeholder="Version search" class="form-control liveSearch" />
                </div>
            </div>
        </div>


        <div class="col-md-3">
            <div class="form-group">
                <div class="form-group">
                    <input type="text" name="user_id" value="{!! $request['user_id'] !!}" id="contentkeyword" placeholder="User search" class="form-control liveSearch" />
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <div class="form-group">
                    {{ Form::checkbox('featured', 1, null, ['class' => 'field', 'id'=>'featured']) }}
                    {!! Form::label('featured','Featured') !!}
                </div>
            </div>
        </div>
    </div>

    <div style="padding-left: 30px; padding-right: 30px">
        <a href="{!! URL::route('firmware.new') !!}" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add New</a>

        <span class="btn btn-info pull-left submitSearchBtn"><i class="fa fa-search"></i> Search</span>
    </div>
</form>