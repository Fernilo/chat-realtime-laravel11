
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
					<a href="{{ route('comments.index', [Auth()->user()->id ,$service->id]) }}" class="btn btn-secondary btn-lg">Chat</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
 