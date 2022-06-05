@extends('layouts.app')

@section('content')
<div class="col-md-9 row justify-content-center">
    <fixture-card :fixtures='@json($fixtures)' :is-post='@json(true)' :list-title='対戦カード'>
    </fixture-card>
</div>
@endsection