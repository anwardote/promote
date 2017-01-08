<div class="row margin-bottom-12">

    {{--@include('laravel-authentication-acl::admin.recharge.search')--}}
</div>
@if( ! $results->isEmpty() )
    <table class="table table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Subject</th>
            <th>Amount (Tk.)</th>
            <th>Status</th>
            <th>Operations</th>
        </tr>
        </thead>
        <tbody>
        @foreach($results as $result)
            <tr>
                <td style="width:10%">{{ $result->id }}</td>
                <td style="width:20%">{{ $result->date }}</td>
                <td style="width:25%">{{ $result->subject }}</td>
                <td style="width:25%">{{  number_format($result->amount, 2, '.', ',') }}</td>
                <td style="width:10%">{{ ucfirst(strtolower($result->status)) }}</td>
                <td style="width:15%">
                    <a href="{{ URL::route('userbill.detail', ['id' => $result->id]) }}" title="Details"><i
                                class="fa fa-bars fa-2x"></i></a>
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

