@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @foreach($fixtures as $fixture)
            <div class="card">
                <div class="card-body">
                    <a class="row justify-content-center" href="http://localhost/board/{{$fixture->id}}">
                        <span>{{$fixture->hometeam_name}}</span>
                        <span class="col-3 text-center" >VS</span>
                        <span>{{$fixture->awayteam_name}}</span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
