@extends('layouts.main')

@section('content')
    <x-home.categories/>
    <x-home.gallery/>
    <x-home.card :events="$events"/>

@endsection
