@extends('layouts.app')
@section('content')


@section('content')
<section class="container py-5">
    <div class="container rounded-2 container-table">
        <h1 class="fw-bolder">Add a new Trip:</h1>
        <h3>General informations</h3>
        <div id="ls-edit">
            <form action="{{ route('trips.store') }}" method="POST" enctype="multipart/form-data" id="create-apartment-form">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label fs-5 fw-medium">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" maxlength="255" minlength="3">
                </div>
                <h3 class="mt-4">Choose your departure destination and when you'd like to begin</h3>
                <div class="address d-flex justify-content-center flex-column">
                    <div class="mb-3">
                        <div class="d-flex mt-3 align-content-center">
                            <div id="addressResult1" class="address-result"></div>
                            <input class="form-control" type="text" id="address1" name="departure" value="{{ old('address1') }}" required maxlength="255" minlength="7">
                            <button id="edit-btn1" class="btn-2 ms-3 draw-border-2 mt-3"><i class="fa-solid fs-4 fa-pencil"></i></button>
                        </div>
                        <div id="resultsContainer1" class="results-container"></div>
                    </div>
                    <div class="mb-3">
                        <label for="start_datetime1">Start Date and Time:</label>
                        <input type="datetime-local" id="start_datetime1" name="start_date" required>
                    </div>
                </div>
                <h3 class="mt-4">Choose your arrival destination and when you'd like to return.</h3>
                <div class="address d-flex justify-content-center flex-column">
                    <div class="mb-3">
                        <div class="d-flex mt-3 align-content-center">
                            <div id="addressResult2" class="address-result"></div>
                            <input class="form-control" type="text" id="address2" name="arrival" value="{{ old('address2') }}" required maxlength="255" minlength="7">
                            <button id="edit-btn2" class="btn-2 ms-3 draw-border-2 mt-3"><i class="fa-solid fs-4 fa-pencil"></i></button>
                        </div>
                        <div id="resultsContainer2" class="results-container"></div>
                    </div>
                    <div class="mb-3">
                        <label for="start_datetime2">End Date and Time:</label>
                        <input type="datetime-local" id="start_datetime2" name="end_date" required>
                    </div>
                </div>
                <div class="text-center mx-auto justify-content-center d-flex gap-2">
                    <button type="submit" class="btn-2 draw-border-2 p-2 px-3 mt-3 mx-3"><i class="fa-solid fa-plus"></i> Add the Trip</button>
                </div>
            </form>
        </div>
    </div>
</section>
  <script>
  document.addEventListener('DOMContentLoaded', () => {
    const addressInput1 = document.getElementById('address1');
    const addressInput2 = document.getElementById('address2');
    const addressDiv1 = document.getElementById('addressResult1');
    const addressDiv2 = document.getElementById('addressResult2');
    
    const form = document.getElementById('create-apartment-form');
    const editBtn1 = document.getElementById('edit-btn1');
    const editBtn2 = document.getElementById('edit-btn2');

    form.addEventListener('submit', function(event) {
        // Verifica se almeno uno dei campi di indirizzo è visibile
        const isAddressInputVisible = addressInput1.style.display !== 'none' || addressInput2.style.display !== 'none';
        
        if (isAddressInputVisible) {
            event.preventDefault();
        }
    });

    editBtn1.addEventListener('click', (event) => {
        event.preventDefault();
        addressDiv1.style.display = 'none';
        addressInput1.style.display = 'block';
        addressInput1.focus();
    });

    editBtn2.addEventListener('click', (event) => {
        event.preventDefault();
        addressDiv2.style.display = 'none';
        addressInput2.style.display = 'block';
        addressInput2.focus();
    });
});


        //lettura chiave api per la ricerca non tocca 
        window.apiKey = "{{ env('TOMTOM_API_KEY') }}";


    </script>
@endsection






