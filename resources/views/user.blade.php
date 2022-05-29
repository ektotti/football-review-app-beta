@extends('layouts.app')

@section('content')
<div class="container">
    <Profiel 
        :selected-user='@json($selectedUser)'
        :login-user='@json($loginUser)'
        :following-user-amount='@json($followingUserAmount)'
        :followed-user-amount='@json($followedUserAmount)'
        :is-following='@json($isFollowing)'
    >
    </Profiel>
    <post-card :is-index='@json($isIndex)'>
    </post-card>
</div>
<portal-target name="modal"></portal-target>
@endsection