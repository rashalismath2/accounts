@extends('home')

@section('dashboard-content')
    
    <div id="items-cont">
        @include('layouts.Items.header')

        @if (count($items)>0)
            @include('layouts.Items.notEmpty')
        @else
            @include('layouts.Items.empty')
        @endif
        

    </div>


@endsection