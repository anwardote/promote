@extends('laravel-authentication-acl::admin.layouts.baseauth')
@section('title')
Update Password
@stop
@section('container')
<style>
    
</style>

<div class="row centered-form">
    <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title bariol-bold">Welcome to {!!Config::get('acl_base.app_name')!!}</h3>
            </div>
            <?php $message = Session::get('message'); ?>
            @if( isset($message) )
            <div class="alert alert-success">{{$message}}</div>
            @endif
            @if(isset($errors) && count($errors)>0)
            @foreach($errors as $keyerror=>$valerror)
            <div class="alert alert-danger">{{$valerror}}</div>
            @endforeach
            @endif
            <div class="panel-body">
                {!! Form::open(array('url' => URL::route("users.password-update"), 'method' => 'post') ) !!}
              
                <div class="form-group">
                    <div class="input-group">
                        {!! Form::label('password','Password: *') !!}
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        {!! Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Password', 'required', 'autocomplete' => 'off']) !!}
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="input-group">
                        {!! Form::label('re-password','Re-Password: *') !!}
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        {!! Form::password('re-password', ['id' => 're-password', 'class' => 'form-control', 'placeholder' => 'Re- Password', 'required', 'autocomplete' => 'off']) !!}
                    </div>
                </div>
                <input type="hidden" value="{{ $user['id'] }}" name="id"/> 
                <input type="hidden" value="{{ $user['email'] }}" name="email"/> 
                <input type="hidden" value="{{ $user['user_token'] }}" name="user_token"/> 
                <input type="submit" value="Save" class="btn btn-info btn-block">
                {!! Form::close() !!}
                <div class="row">
                    <div class="col-sm-6 margin-top-10">
                        {!! link_to_route('user.admin.login','Login?') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
@section('footer_scripts')
<script>
    jQuery("#email").focus();
    jQuery('#example').popover()
</script>
@stop













