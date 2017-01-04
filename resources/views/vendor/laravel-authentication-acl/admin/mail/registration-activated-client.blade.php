
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    {!! HTML::style('packages/jacopo/laravel-authentication-acl/css/mail-base.css') !!}
    {!! HTML::style('//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css') !!}
</head>
<body>

<div>
    <h3>Dear User,</h3>
    <strong>Welcome to {!! Config::get('acl_base.app_name')!!}.</strong>
    <br><br>
    <strong>Your account has been created succesfully.</strong>
    You can now login to the website using the
    <a href="{!! URL::to('/login') !!}">Following link</a>.
    <br>
    <p>Your account details are below.</p>
    <ul>
        <li><strong>Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong> {{ $email }}</li>
        <li><strong>Password :</strong> {{ $password }} </li>
    </ul>
    <p>Please update your password using <a href="{!! URL::route('users.password-update') !!}?expire={{ time()}}&_token={{ $_token }}" >Following link</a>.</p><br>
    
    <p>Thanks and best regards.</p><br><br>
    <strong>Admin</strong><br>
    <strong>{!! Config::get('acl_base.app_name')!!}</strong>
    
</div>
</body>
</html>