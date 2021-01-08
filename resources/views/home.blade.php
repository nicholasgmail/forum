@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-uppercase">Chat rooms</h3>
    <div id="theme" class="row justify-content-start">
        @foreach ($themes as $them)
        <div class="col-md-6">
            <a href="{{'theme/' . $them->id}}">
                <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{$them->name}}</h5>
                        <p class="font-monospace text-truncate" style="max-width: 200px;">
                            {{$them->text}}
                        </p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-8 mt-3">
            {{ $themes->onEachSide(5)->links() }}
        </div>
    </div>
    <div class="row row-cols-sm-2">
        <div class="col">
            @auth
            <create-theme></create-theme>
            @endauth
        </div>
    </div>
</div>
@endsection
