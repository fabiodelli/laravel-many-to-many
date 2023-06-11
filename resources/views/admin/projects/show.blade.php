@extends('layouts.admin')

@section('content')
    <div class="container p-4">
        <div class="row">
            <div class="col ">
                <div class="card d-flex p-3">
                    <h2>{{ $projects->title }}</h2>
                    <img height='400' class="mt-2 mb-2" src="{{ $projects->cover_image }}" alt="{{ $projects->title }}">
                    <strong>Type: {{ $type->type ?? 'N/A' }}</strong>
                    <strong class="mb-3">Technologies:</strong>
                    <div class="d-flex">
                        @foreach ($technologies as $technology)
                            <img class="me-3" height="70" src="{{ $technology->logo ?? 'N/A' }}"
                                alt="{{ $technology->name ?? 'N/A' }}">
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
