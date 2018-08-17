@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->
    <div class="container">

        <div class="panel-body">
            <!-- Display Validation Errors -->
            @include('common.errors')


            <form action="/edit/{{ $ad->id }}" method="POST" class="form-horizontal">
                {{ csrf_field() }}


                <div class="form-group">
                    <label for="title" class="col-sm-3 control-label">Title</label>

                    <div class="col-sm-6">
                        <input type="text" name="title" id="title" class="form-control" value="{{ $ad->title }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description " class="col-sm-3 control-label">Description </label>

                    <div class="col-sm-6 date">
                        <textarea name="description" id="description" class="form-control" required>{{ $ad->description }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-plus"></i> Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection