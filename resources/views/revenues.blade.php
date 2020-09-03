@extends('home')

@section('dashboard-content')
    
    <div id="items-cont">
        @include('layouts.Revenues.header')

        @if (count($revenues)>0)
            @include('layouts.Revenues.notEmpty')
        @else
            @include('layouts.Revenues.empty')
        @endif
        

    </div>


@endsection