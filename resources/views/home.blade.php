@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <post-card
            :is-index='@json($isIndex)'
        >
        </post-card>
        <div class="col-md-4 text-center">
            <div class="mb-4">
                <fixture-card
                    :fixtures='@json($recentFixtures)'
                    :list-title="'最近の試合'"
                > 
                </fixture-card>
            </div>
            <div class="">
                <fixture-card
                    :fixtures='@json($comingSoonFixtures)'
                    :list-title="'もうすぐキックオフ！'"
                >
                </fixture-card>
            </div>
        </div>
    </div>
</div>
@endsection