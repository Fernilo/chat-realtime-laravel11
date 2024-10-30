
@extends('layouts.app')

@section('title', $service->name)

@section('content')
<div class="container">
	<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
				<div class="card-header">{{ $service->name }}</div>
				<div class="card-body">
					<img class="img-fluid mb-2" width="500" src="{{ Storage::url('instrumental.webp')}}" alt="Imagen instrumental">
					<p>{{ $service->description }}</p>

					@if (Auth()->user()->services()->exists())
						<a href="{{ route('chats.index', [Auth()->user()->id ,$service->id]) }}" class="btn btn-secondary btn-lg">Ver todos los chats</a>
					@elseif($chat)
						<a href="{{ route('comments.index', [Auth()->user()->id ,$service->id, $chat]) }}" class="btn btn-secondary btn-lg">Ver chat</a>
					@else
						<a href="{{ route('comments.index', [Auth()->user()->id ,$service->id, $chat]) }}" class="btn btn-secondary btn-lg">Iniciar Chat</a>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
