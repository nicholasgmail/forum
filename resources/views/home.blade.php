@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div> --}}
            @foreach ($masseges as $masseg)
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
        <div class="col-12 col-sm-8 pt-4">
            <div class="card">
                <div class="card-body">
                    <x-form></x-form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

