<div class="row margin-bottom-12">
    
    @include('laravel-authentication-acl::admin.firmware.search')
</div>
@if( ! $results->isEmpty() ) 
<table class="table table-hover">
    <thead>
        <tr>
            <th>Category</th>
            <th>Device</th>
            <th>Model</th>
<!--            <th>Version</th>-->
            <th>Status</th>
            <th>Operations</th>
        </tr>
    </thead>
    <tbody>
        @foreach($results as $result) 
        <tr>
            <td style="width:25%">{{ $result->fcategory->title }}</td>
            <td style="width:20%">{{ $result->device->name }}</td>
            <td style="width:15%">{{ $result->device_model }}</td>
<!--            <td style="width:15%">{{-- $result->device_version --}}</td>-->
            <td style="width:10%">{{ ucfirst(strtolower($result->status)) }}</td>
            <td style="width:15%">
                <a href="{{ URL::route('firmware.edit', ['id' => $result->id]) }}"><i class="fa fa-edit fa-2x"></i></a>
                <a href="{{ URL::route('firmware.delete',['id' => $result->id, '_token' => csrf_token()])}}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
                <span class="clearfix"></span>
            </td>
        </tr>
        @endforeach 
    </tbody>
</table>
@else 
<span class="text-warning"><h5>No results found.</h5></span>
@endif 
<div class="paginator">
    {{ $results->appends($request->except(['page']) )->render() }}
</div>

