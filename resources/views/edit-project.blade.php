@extends('LaravelScaffold::layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Add Project</div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="post" action="{{ url('edit-project/' . $project['id']) }}">

                Project Name <input type="text" value="{{ $project['name'] }}" name="name"/>
            <button type="submit" class="btn btn-sm btn-success">
                <i class="fa fa-save"></i>&nbsp;Save</button>
            </form>
        </div>
    </div>
@endsection
