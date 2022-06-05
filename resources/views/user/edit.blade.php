@extends('layouts.app')
@section('content')
<div class="container">
    <form action="/user/{{$user->id}}" method="POST" enctype="multipart/form-data" class="col-6 mx-auto">
        @method('PUT')
        @csrf
        <div class="form-group row align-items-center mb-5">
            <label class="col-4" for="iconImage"><img class="rounded-sm" src="/storage/sample.jpg" width="75" alt=""></label>
            <input type="file" class="" name="image" id="iconImage">
        </div>
        <div class="form-group row align-items-center mb-5">
            <label class="col-4" for="userName">ニックネーム</label>
            <input type="text" class="border-0 p-2 col-7" name="name" id="userName" placeholder="{{$user->name}}">
        </div>
        <div class="form-group row align-items-center mb-5">
            <label class="col-4" for="email">メールアドレス</label>
            <input type="text" class="border-0 p-2 col-7" name="email" id="email" placeholder="{{$user->email}}">
        </div>
        <input type="submit" class="btn btn-primary offset-10" value="送信">
    </form>
</div>
@endsection