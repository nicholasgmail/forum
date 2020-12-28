@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <h4>{{$name}}</h4>
        <h6>count: {{$masseges->count()}}</h6>
        <div class="col-md-8">
            @foreach ($masseges->items() as $masseg)
            <div class="card text-center">
                <div class="card-header">
                    Featured
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{$masseg->title}}</h5>
                    <p class="card-text">{{$masseg->text}}</p>
                </div>
                <div class="card-footer text-muted">
                    2 days ago
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-md-8 mt-3">
            {{ $masseges->onEachSide(5)->links() }}
        </div>
        <div class="col-12 col-sm-8 pt-4">
            <div class="card">
                <div class="card-body">
                    <x-form :themeId=$theme_id></x-form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

