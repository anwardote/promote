@extends('admin.layouts.base-1cols')

@section('title')
    Admin area: Contact us
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
    <div class="container">
        <div class="admin-area">
            @foreach( $contact_rows as $key => $home )
                <div class="row">

                    <div class="col-sm-12">
                        <h3 id="pageTitle">{!! setVar($home->title, $dynamic_var) !!}</h3>
                        <?php $content = setVar($home->content, $dynamic_var);
                        $content = explode('[more]', $content);
                        $content = $content[0];
                        echo $content;
                        ?>

                    </div>

                </div>
        </div>

        @endforeach
        <div class="row">
            <div class="col-sm-12">
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