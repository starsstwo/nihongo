@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="list-group">
        @foreach ($kotobas as $index => $kotoba)
            <div class="col-md-10">
                <div id="{{'kotoba' . $index}}" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content text-center">
                            <div class="flip" data-id="{{'card' . $kotoba->id}}">
                                <div class="card {{'card' . $kotoba->id}}">
                                    <div class="face front">
                                        <p class="word-name japanese-char">{{ $kotoba->name }}</p>
                                    </div>
                                    <div class="face back">
                                        <div class="word-name japanese-char">{{ $kotoba->name }}</div>
                                        <div class="word-phonetic japanese-char">{{ $kotoba->phonetic }}</div>
                                        <div class="word-mean">
                                            <p><span>意味 : {{ $kotoba->mean }}</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="list-group-item" data-toggle="modal" data-target="{{'#kotoba' . $index}}">{{ $kotoba->name }}</a><br>
            </div>
            <div class="col-md-1">
              <a  href="{{route('kotobas.edit', $kotoba->id)}}" class="btn btn-primary pull-right">Edit</a>
            </div>
            <div class="col-md-1">
              {!! Form::open( array('route' => ['kotobas.destroy', 'id' => $kotoba->id], 'class' => 'form-horizontal', 'method' => 'DELETE', 'files' => 'true')) !!}
                  <input type="submit" name="submit_kotoba_destroy" value="Delete" class="btn btn-danger pull-right">
              {!! Form::close() !!}
            </div>
        @endforeach
        </div>
    </div>
</div>
<script>
$(function($) {
  // $("#card").flip();
  $(".flip").click(function(){
    $("." + $(this).data('id')).toggleClass("flipped");
  })
});
</script>
@endsection
