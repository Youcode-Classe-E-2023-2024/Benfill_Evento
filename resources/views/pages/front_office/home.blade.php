@extends('layouts.main')

@section('content')
    <x-home.categories :categories="$categories"/>
    <x-home.gallery :gallery="$gallery"/>
    <x-home.card :events="$events"/>
    <script src="{{ asset('js/filter.js') }}"></script>
@endsection
