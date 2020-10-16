@extends('home')

@section('dashboard-content')

    <div id="items-cont">
        @include('layouts.Invoices.header')
        @if (count($invoices)>0)
            @include('layouts.Invoices.notempty')
        @else
            @include('layouts.Invoices.empty')
        @endif
        
    </div>

@endsection