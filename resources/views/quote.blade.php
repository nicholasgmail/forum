@php
    use App\Models\Masseg;
@endphp
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div id="message" class="col-md-8">          
            <div id='card' class="card mb-3">
                <div class="card-header">
                   {{ $user}}
                   <span class="float-end">
                   {{ $theme_name}}
                   </span>
                </div>                
                <div class="card-body">
                    <p class="card-text">{{$messag->text}}</p>
                </div>
                <div class="card-footer text-muted">
                  {{$messag->created_at}}
                </div>
            </div>
        </div>
         @auth
        <div class="col-12 col-sm-8 pt-4">
            <div class="card">
                <div class="card-body">    
                               <form id="formMessag" method="POST" action="/set_message">
        @method('POST')
        @csrf
        <input type="hidden" name="user" value="{{ auth()->user()->id  }}" />
        <input type="hidden" name="masseg" value="{{ $messag->id  }}" />
        <input type="hidden" name="theme" value="{{ $theme_id }}" />
            <div class="mb-3">
                <label for="textForm" class="form-label">Text</label>
                <textarea class="form-control" name="text" id="textForm" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-submit">Submit</button>
    </form>
                </div>
            </div>
        </div>
         @endauth
    </div>
</div>
@endsection

