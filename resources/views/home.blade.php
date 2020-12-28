@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        <h3 class="text-uppercase">Chat rooms</h3>

        @foreach ($themes as $them)
        <div class="col-md-6">
            <a href="{{'theme/' . $them->id}}">
                <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{$them->name}}</h5>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
