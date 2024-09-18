@extends('layouts.app')

@section('title', 'Chat')

@section('content')
<div class="container">
    <div id="main" data-user="{{ json_encode($user) }}" data-service="{{ json_encode($service) }}"></div>
</div>
@endsection