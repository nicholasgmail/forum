@foreach ($listMessages as $item)
@if ($item['massegs_id'] == $massegId)
<div class="row ms-3 pt-3">
    <div class="col-12 mb-3">
        <p class="blockquote-footer mb-0">{{$item['text']}}</p>
    </div>
    <div class="col-12 col-sm-6">
        <p class='text-start' style="font-size:10px">{{$item['name']}}</p>
    </div>
    <div class="col-12 col-sm-6">
        <p class='text-end' style="font-size:10px">{{$item['created_at']}}</p>
    </div>
    <hr>
</div>
@endif
@endforeach
