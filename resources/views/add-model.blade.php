@extends('LaravelScaffold::layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Add Model for <strong>{{ $project['name'] }} </strong></div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="post" action="{{ url('add-model/' . $project['id']) }}">
                Model Name <input type="text" name="name"/>
            <button type="submit" class="btn btn-sm btn-success">
                <i class="fa fa-save"></i>&nbsp;Save</button>
            </form>
        </div>
    </div>
@endsection
