@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-uppercase">Chat rooms</h3>
    <div id="theme" class="row justify-content-start">
        @foreach ($themes as $them)
        <div id="card_theme_{{$them->theme_id}}" class="col-md-6">
                <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                    <a href="{{'theme/' . $them->theme_id}}">
                    <div class="card-body">
                        <h5 class="card-title text-white">{{$them->name}}</h5>
                        <p class="font-monospace text-truncate text-white" style="max-width: 200px;">
                            {{$them->text}}
                        </p>
                    </div>
                    </a>
                    @auth
                        <div class="card-footer">
                                 @if ($them->user_id == auth()->user()->id)
                                    <delete-theme :id={{$them->theme_id}}></delete-theme>
                                 @endif
                         </div>
                    @endauth
                </div>
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
            <create-theme :user={{auth()->user()->id}}></create-theme>
            @endauth
        </div>
    </div>
</div>
@endsection
