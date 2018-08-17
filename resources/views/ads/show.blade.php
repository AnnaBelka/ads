@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->
    <div class="container">
        <div class="panel-body">
            <div class="form-group">
                <label for="title" class="col-sm-3 control-label">Title</label>

                <div class="col-sm-6">
                    <div class="alert p-3 mb-2 bg-info text-white">
                        {{ $ad->title }}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="description " class="col-sm-3 control-label">Description </label>

                <div class="col-sm-6">
                    <div class="alert p-3 mb-2 bg-info text-white">
                        {{ $ad->description }}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="title" class="col-sm-3 control-label">Author name</label>

                <div class="col-sm-6">
                    <div class="alert p-3 mb-2 bg-info text-white">
                        {{ $author->name }}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="description " class="col-sm-3 control-label">Creation date</label>

                <div class="col-sm-6">
                    <div class="alert p-3 mb-2 bg-info text-white">
                        {{ $ad->created_at }}
                    </div>
                </div>
            </div>
            @if(Auth::user()->id == $ad->user_id)
                <div class="form-group">
                    <div class="col-sm-6">
                        <a class="btn btn-warning" href="{{ url('/edit/'.$ad->id) }}" >Edit</a>
                        <form class="float-right" action="/delete/{{ $ad->id }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" id="delete-task-{{ $ad->id }}" class="btn btn-danger float-right">
                                <i class="fa fa-btn fa-trash"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection