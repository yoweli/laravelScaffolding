@extends('LaravelScaffold::layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            Project :: {{ $project['name'] }}
            <div class="float-right">
                <a href="{{ url('scaffold') }}" class="btn btn-sm btn-success">
                    <i class="fa fa-home"></i>&nbsp;
                    Home
                </a>

                <a href="{{ url('add-model/' . $project['id']) }}" class="btn btn-sm btn-success">
                    <i class="fa fa-plus"></i>&nbsp;
                    Add Model
                </a>
                <a href="{{ url('process-project/' . $project['id']) }}" title="Generate" class="btn btn-sm btn-success">
                    <i class="fa fa-paper-plane"></i>&nbsp; Process project
                </a>
            </div>
        </div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="card-body"><strong>Models</strong></div>
        <table class="table">
            @forelse($models as $model)
                <tr>
                    <td>{{ $model['name'] }}</td>
                    <td align="right">
                        </a>&nbsp;
                        <a href="{{ url('delete-model/' . $model['id']) }}">
                            <i class="fa fa-trash text-danger"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr align="center">
                    <td colspan="2">None found</td>
                </tr>
            @endforelse
        </table>
    </div>
@endsection
