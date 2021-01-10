@php
use App\Models\Masseg;
use Carbon\Carbon;
@endphp
@extends('layouts.app')

@section('content')
<div class="container">
    <h4>{{$name}}</h4>
    <h6>count: {{$masseges->count()}}</h6>
    <div class="row justify-content-center">
        <div class="col-12">
            {{$text}}
        </div>
        <div id="message" class="col-md-8">
            @foreach ($masseges->items() as $masseg)
            <div id="card_messag_{{$masseg->messeg_id}}" class="card mb-3">
                <div class="card-header">
                    {{ $masseg->name}}
                    @if ($masseg->user_id == auth()->user()->id)
                        <delete-message :id={{$masseg->messeg_id}}></delete-message>
                    @endif
                </div>
                <div class="card-body">
                    <p class="card-text">{{$masseg->text}}</p>
                </div>
                @auth
                    <div class="card-body text-end">
                    <a href="/quote/{{$masseg->messeg_id}}">quote</a>
                </div>
                @endauth
                @php
                    $massegId = $masseg->messeg_id;
                @endphp
                <div class="card-body ps-5 text-muted">
                    <x-quote-components :list-messages=$comments :masseg-id=$massegId></x-quote-components>
                </div>
                <div class="card-footer text-muted">
                    {{Carbon::parse($masseg->created_at)}}
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
