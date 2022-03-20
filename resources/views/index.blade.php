@extends('LaravelScaffold::layouts.app')

@section('content')
    <div class="card-header">
        Projects
        <a href="{{ url('add-project') }}" class="btn btn-sm btn-success float-right">
            <i class="fa fa-plus"></i>&nbsp;
            Add
        </a>
    </div>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <table class="table">
        <tr>
            <th>Name</th>
            <th>&nbsp;</th>
        </tr>
        @forelse($projects as $project)
            <tr>
                <td>{{ $project['name'] }}</td>
                <td align="right">
                    <a href="{{ 'view-project/' . $project['id'] }}">
                        <i class="fa fa-search text-standard"></i>
                    </a>&nbsp;
                    <a href="{{ url('edit-project/' .$project['id'] ) }}">
                        <i class="fa fa-edit text-success"></i>
                    </a>&nbsp;
                    <a href="{{ 'delete-project/' . $project['id'] }}">
                        <i class="fa fa-trash text-danger"></i>
                    </a>

                </td>
            </tr>
        @empty
            <td colspan="2" class="text-center">Nothing</td>
        @endforelse
    </table>
@endsection
