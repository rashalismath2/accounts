@extends('home')

@section('dashboard-content')

    <div id="items-cont">
        <div id="invoice-details-cont">
            <p>Invoice: {{$data["invoices"]->invoice_number}}</p>
        </div>

        @include('layouts.Invoices.details.status')
        @include('layouts.Invoices.details.draft')
       
    </div>

@endsection