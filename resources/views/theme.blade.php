@extends('layouts.app')

@section('content')
<div class="container">
    <h4>{{$name}}</h4>
        <h6>count: {{$masseges->count()}}</h6>
    <div class="row justify-content-center">
        <div id="message" class="col-md-8">
            @foreach ($masseges->items() as $masseg)
            <div class="card text-center mb-3">
                <div class="card-header">
                   {{ $masseg->name}}
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{$masseg->title}}</h5>
                    <p class="card-text">{{$masseg->text}}</p>
                </div>
                <div class="card-footer text-muted">
                  {{$masseg->created_at}}
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-md-8 mt-3">
            {{ $masseges->onEachSide(5)->links() }}
        </div>
         @auth
        <div class="col-12 col-sm-8 pt-4">
            <div class="card">
                <div class="card-body">
                    <x-form :themeId=$theme_id></x-form>
                </div>
            </div>
        </div>
         @endauth
    </div>
</div>
@endsection

