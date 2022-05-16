@extends('layouts.app')

@section('content')
    <create-post :csrf="{{json_encode(csrf_token())}}"></create-post>
@endsection