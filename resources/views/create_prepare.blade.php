@extends('layouts.app')

@section('content')
<div class="col-md-12 row justify-content-center">
<fixture-card :fixtures='@json($fixtures)'>
</fixture-card>
</div>
@endsection