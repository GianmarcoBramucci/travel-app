@extends('layouts.app')
@section('content')
<section class="container">
    <div class="d-flex justify-content-between align-content-center">
        <h1>i miei viaggi</h1>
        <a href="{{route('trips.create')}}" class="btn btn-primary">crea nuovo</a>
    </div>
    <ul>
        @foreach ($trips as $trip)
        <li>
            <h2>{{$trip->name}}</h2>
            <p>{{$trip->departure}}</p>
            <p>{{$trip->arrival}}</p>
            <p>{{$trip->start_date}}</p>
            <p>{{$trip->end_date}}</p>
            <a href="{{ route('trips.show',$trip->slug) }}"><i class="fa-solid fa-eye"></i></a>
            <a href="{{ route('trips.edit',$trip->slug) }}"><i class="fa-solid fa-pen"></i></a>
            <form action="{{route('trips.destroy', $trip->slug)}}" method="POST" class="d-inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-button border-0 bg-transparent"  data-item-title="{{ $trip->title }}">
                  <i class="fa-solid fa-trash" style="color: #0A58CA;"></i>
                </button>
              </form>
        </li>
        @endforeach
    </ul>
    
</section>
@include('partials.modal-delete')
@endsection




