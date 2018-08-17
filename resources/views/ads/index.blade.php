@extends('layouts.app')

@section('content')
<div class="container">

    @guest
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-sm-4 col-form-label text-md-right">{{ __('Username') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    @else
        <ul class="nav">
            <li class="nav-link">{{ Auth::user()->name }}</li>
            <li class="nav-link">
                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
            <li class="nav-link"><a href="{{ url('/edit')}}">Create Ad</a></li>
        </ul>
            @if (count($ads) > 0)
                <div class="panel panel-default">

                    <div class="panel-body">
                        <table class="table table-striped task-table">

                            <!-- Table Headings -->
                            <thead>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Author name</th>
                                <th>Creation date</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </thead>

                            <!-- Table Body -->
                            <tbody>
                            @foreach ($ads as $ad)
                                <tr>
                                    <!-- Task Name -->
                                    <td class="table-text">
                                        <div><a class="nav-link" href="{{ url('/'.$ad->id)}}">{{ $ad->title }}</a></div>
                                    </td>
                                    <td class="table-text">
                                        <div>{{ $ad->description }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $ad->user_name }}</div>

                                    </td>
                                    <td>
                                        <div>{{ $ad->created_at }}</div>
                                    </td>
                                    <td>
                                        @if(Auth::user()->id == $ad->user_id)
                                            <a class="btn btn-warning" href="{{ url('/edit/'.$ad->id) }}" >Edit</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if(Auth::user()->id == $ad->user_id)
                                            <form class="" action="/delete/{{ $ad->id }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" id="delete-task-{{ $ad->id }}" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Delete
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $ads->links() }}
                </div>
            @endif
    @endguest

</div>
@endsection
