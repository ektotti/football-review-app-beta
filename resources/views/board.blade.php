@extends('layouts.app')

@section('content')
<tactical-board :init-hometeam-players='@json($hometeamMember)' :init-awayteam-players='@json($awayteamMember)'></tactical-board>
<portal-target name="modal"></portal-target>
@endsection