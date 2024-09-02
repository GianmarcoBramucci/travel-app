@extends('layouts.app')
@section('content')
<section class="container">
    <div class="d-flex justify-content-between align-content-center">
        <h1>le miei tappe</h1>
        <a href="{{route('stops.create')}}" class="btn btn-primary">crea nuovo</a>
    </div>
    <ul>
        @foreach ($stops as $stop)
        <li>
            <h2>{{$stop->title}}</h2>
            <p>{{$stop->description}}</p>
            <a href="{{ route('days.stops.edit',$stop) }}"><i class="fa-solid fa-pen"></i></a>
            <form action="{{route('days.stops.destroy', $stop)}}" method="POST" class="d-inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-button border-0 bg-transparent"  data-item-title="{{ $stop->title }}">
                  <i class="fa-solid fa-trash" style="color: #0A58CA;"></i>
                </button>
              </form>
        </li>
        @endforeach
    </ul>
    
</section>
@include('partials.modal-delete')
@endsection

