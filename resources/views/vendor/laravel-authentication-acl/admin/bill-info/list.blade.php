@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
    Admin area: Firmware list
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="col-md-12">
            {{-- print messages --}}
            <?php $message = Session::get('message'); ?>
            @if( isset($message) )
                <div class="alert alert-success">{!! $message !!}</div>
            @endif
            {{-- print errors --}}
            @if($errors && ! $errors->isEmpty() )
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{!! $error !!}</div>
                @endforeach
            @endif
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin"><i class="fa fa-group"></i> {{ $request->all() ? 'Search results:' : 'Bill Histories'}}</h3>
                </div>
                <div class="panel-body">
                    <div class="summary-table" style="display: none">
                        @include('laravel-authentication-acl::admin.recharge-info.summary')
                    </div>
                    <button type="submit" class="btn btn-info summary-btn">Show Amount Summary</button>

                    @include('laravel-authentication-acl::admin.bill-info.bill-table')
               </div>
           </div>
        </div>
    </div>
</div>
@stop

@section('footer_scripts')
    <script>
        $(".delete").click(function(){
            return confirm("Are you sure to delete this item?");
        });
        $(document).ready(function (e) {
            $('.summary-btn').click(function (e) {
                var url = '{{route('summary')}}?summary=on';
                $.ajax(url, {
                    success: function (data) {
                        $(".summary-table .recharge_amount").html(data.recharge_amount);
                        $(".summary-table .bill_amount").html(data.bill_amount);
                        $(".summary-table .balance_amount").html(data.balance_amount);

                        $('.summary-table').show(200)
                        $('.summary-btn').hide(100)
                    },
                    error: function () {
                        alert('Someting wrong.');
                    }
                });


            })
        })
    </script>
@stop