
@extends('layouts.app')

@section('title', 'Chats')

@section('content')
<div class="container">
	<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
				<div class="card-header">Listado de Chats</div>
				<div class="card-body">
					<ul>
						@foreach ($chats as $chat)
							<li><a href="{{route('comments.indexUserCreatorService', [Auth::user()->id, $chat->service_id, $chat])}}">{{$chat->user->username .' - '. $chat->created_at }}</a></li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
