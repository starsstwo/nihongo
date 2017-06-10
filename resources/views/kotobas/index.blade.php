@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="list-group">
        @foreach ($kotobas as $kotoba)
            <div class="">
            <div class="col-md-11">
            <a href="{{route('kotobas.edit', $kotoba->id) }}" class="list-group-item">{{ $kotoba->name }}</a><br>
            </div>
            <div class="col-md-1">
            {!! Form::open( array('route' => ['kotobas.destroy', 'id' => $kotoba->id], 'class' => 'form-horizontal', 'method' => 'DELETE', 'files' => 'true')) !!}
                <input type="submit" name="submit_kotoba_destroy" value="Delete" class="btn btn-danger pull-right">
            {!! Form::close() !!}
            </div>
            </div>
        @endforeach

        </div>
    </div>
</div>
@endsection
