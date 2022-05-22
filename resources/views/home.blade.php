@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <post-infinite-scroll></post-infinite-scroll>
        <div class="col-md-4">
            <fixture-card
                :fixtures='@json($recentFixtures)'
            > 
            </fixture-card>
        </div>
        <div class="col-md-4">
            <fixture-card
                :fixtures='@json($comingSoonFixtures)'
            >
            </fixture-card>
        </div>
    </div>
</div>
@endsection