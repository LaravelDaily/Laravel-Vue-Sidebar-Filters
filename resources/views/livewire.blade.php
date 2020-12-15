@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @livewire('sidebar')

            @livewire('products')
        </div>
    </div>
@endsection