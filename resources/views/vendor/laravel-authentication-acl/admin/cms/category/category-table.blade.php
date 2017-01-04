<div class="row margin-bottom-12">

    {{--@include('laravel-authentication-acl::admin.tutorial.search')--}}
</div>
@if( ! $results->isEmpty() ) 
<table class="table table-hover">
    <thead>
        <tr>
            <th>SL</th>
            <th>Name</th>
            <th>Parent</th>
            <th>Operations</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        ?>
        <?php
        //dd($results);   
        ?>
        @foreach($results as $result) 
        <tr>
            <td style="width:10%">{{ $i++ }}</td>
            <td style="width:30%">{{ ucfirst($result->name) }}</td>
            <td style="width:30%">
                <?php
                      $cms_category_values=array_prepend($cms_category_values, '-','0')
                    ?>
                {{ $cms_category_values[$result->parent_id] }}
            </td>
            <td style="width:15%">
                <a href="{{ URL::route('category.edit', ['id' => $result->id]) }}"><i class="fa fa-edit fa-2x"></i></a>
                <a href="{{ URL::route('category.delete',['id' => $result->id, '_token' => csrf_token()])}}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
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

