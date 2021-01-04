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
        <div id="message" class="col-md-8">
            @foreach ($masseges->items() as $masseg)
            <div id='card-{{$masseg->messeg_id}}' class="card mb-3">
                <div class="card-header">
                   {{ $masseg->name}}
                </div>
                @php
                $ms = Masseg::where('id', $masseg->massegs_id)->get();
                @endphp               
                @if ($masseg->massegs_id > 0)
                <div class="card-body">
                    <div class="ms-3 pt-3">
                    <p class="blockquote-footer mb-0"><small> {{$ms["0"]->text}}</small></p>
                    </div>
                </div>
                @endif

                <div class="card-body">
                    <p class="card-text">{{$masseg->text}}</p>
                </div>
                <div class="card-body text-end">
                <a href="/quote/{{$masseg->messeg_id}}" class="stretched-link">quote</a>
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

