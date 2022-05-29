@extends('layouts.app')

@section('content')
<div class="container row">
    <post-card :init-post='@json($post)' :is-index="false">
    </post-card>
</div>
@endsection