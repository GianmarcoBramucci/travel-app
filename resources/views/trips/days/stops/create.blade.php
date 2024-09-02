@extends('layouts.app')
@section('content')



<section class="container py-5">
    <div class="container rounded-2 container-table">
        <h1 class="fw-bolder">Add a new Apartment:</h1>
        <div id="ls-edit">
            <form action="{{ route('stops.store') }}" method="POST" enctype="multipart/form-data" id="create-apartment-form">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label fs-5 fw-medium">title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" maxlength="255" minlength="3">
                </div>
                <div class="mb-3">
                    <label for="descripion" class="form-label fs-5 fw-medium">Descripion</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}" maxlength="255" minlength="3">
                </div>
                <div class="text-center mx-auto justify-content-center d-flex gap-2">
                    <button type="submit" class="btn-2 draw-border-2 p-2 px-3 mt-3 mx-3"><i class="fa-solid fa-plus"></i> Add the Apartment</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection






