@extends('layouts.app')

@section('content')
<tactical-board 
:is-post='@json($isPost)'
:init-hometeam-players='@json($hometeamMember)' 
:init-awayteam-players='@json($awayteamMember)'
:selected-fixture='@json($selectedFixture)'
></tactical-board>
<portal-target name="modal"></portal-target>
@endsection