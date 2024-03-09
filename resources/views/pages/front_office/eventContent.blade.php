@extends('layouts.main')

@section('content')
    <x-event-content :event="$event"/>
    <x-home.card :events="$events"/>
@endsection
