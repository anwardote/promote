<div class="row margin-bottom-12">
    
    {{--@include('laravel-authentication-acl::admin.tutorial.search')--}}
</div>
@if( ! $results->isEmpty() ) 
<table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Requirements</th>
            <th>Creator</th>
            <th>Operations</th>
        </tr>
    </thead>
    <tbody>
        @foreach($results as $result) 
        <tr>
            <td style="width:10%">{{ $result->id }}</td>
            <td style="width:30%">{{ $result->title }}</td>
            <td style="width:25%">{{ $result->requirements }}</td>
            <td style="width:30%">{{ $result->user->email }}</td>
            <td style="width:15%">
                <a href="{{ URL::route('tutorial.edit', ['id' => $result->id]) }}"><i class="fa fa-edit fa-2x"></i></a>
                <a href="{{ URL::route('tutorial.delete',['id' => $result->id, '_token' => csrf_token()])}}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
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

