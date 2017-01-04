@extends('admin.layouts.base-1cols')

@section('title')
Admin area: Contact us
@stop

@section('content')
<div class="container">
    <div class="admin-area">
        <div class="row">
            <div class="col-sm-12">
                <h2 id="pageTitle">Contact us</h2>

                <?php $message = Session::get('message'); ?>
                @if( isset($message) )
                <div class="alert alert-success">{!! $message !!}</div>
                @endif                

                {!! Form::open(array('route' => 'contact.store', 'class' => 'form')) !!}

                <div class="form-group">
                    {!! Form::label('Your Name') !!}
                    {!! Form::text('name', null, 
                    array('class'=>'form-control')) !!}
                    <span class="text-danger">{!! $errors->first('name') !!}</span>
                </div>

                <div class="form-group">
                    {!! Form::label('Your E-mail Address') !!}
                    {!! Form::text('email', null, 
                    array( 
                    'class'=>'form-control', 
                    )) !!}
                    <span class="text-danger">{!! $errors->first('email') !!}</span>
                </div>

                <div class="form-group">
                    {!! Form::label('Your Message') !!}
                    {!! Form::textarea('message', null, 
                    array( 
                    'class'=>'form-control', 
                    )) !!}
                    <span class="text-danger">{!! $errors->first('message') !!}</span>
                </div>

                <div class="form-group">
                    {!! Form::submit('Contact Us!', 
                    array('class'=>'btn btn-info')) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
@stop