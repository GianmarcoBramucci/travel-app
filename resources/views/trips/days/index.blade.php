@extends('layouts.app')

@section('content')
<section class="container py-5">
    <div class="container rounded-2 container-table">
        <h1 class="fw-bolder">Trip Days</h1>
        
        <div class="days-grid">
            @foreach ($days as $index => $day)
                <a href="{{ route('days.show', $day) }}" class="day-ball">
                    <span>{{$index+1 }}</span>
                </a>
            @endforeach
        </div>
    </div>
</section>

<style>
    .days-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(50px, 1fr));
        gap: 10px;
        justify-items: center;
        margin: 20px 0;
    }

    .day-ball {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #4CAF50; /* Colore della pallina */
        color: white;
        text-decoration: none;
        font-size: 18px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .day-ball:hover {
        background-color: #45a049; /* Colore della pallina al passaggio del mouse */
    }
</style>
@endsection
