@extends('layouts.app')

@section('content')
@foreach($fixtures as $fixture)
            <div class="card">
                <div class="card-body">
                    <a class="row justify-content-center" href="http://localhost/create/board/{{$fixture->id}}">
                        <span>{{$fixture->hometeam_name}}</span>
                        <span class="col-3 text-center" >VS</span>
                        <span>{{$fixture->awayteam_name}}</span>
                    </a>
                </div>
            </div>
            @endforeach
@endsection