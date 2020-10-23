@extends('home')

@section('dashboard-content')

    <div id="items-cont">
        <div id="new-items-head-cont">
            <p>Edit Invoice</p>
        </div>
        <div id="new-items-desc-cont">
            <div id="new-items-inputs">
                @include('layouts.error')
                <form action="{{route('update_invoice')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="new-item-item new-item-inline">
                        <div>
                            <p>Customer<span class="new-items-required-fields">*</span></p>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text oi oi-person"></span>
                                </div>
                                <select name="customer_id" class="form-control custom-select" id="inputGroupSelect03">
                                    
                                    @foreach ($data["customers"] as $cus)
                                        @if ($data['invoices']->name==$cus->name)
                                            <option selected>{{$data['invoices']->name}}</option>
                                        @else
                                            <option >{{$cus->name}}</option>
                                        @endif
                                    @endforeach
                                  </select>
                            </div>
                        </div>
                        <div>
                            <p>Currency<span class="new-items-required-fields">*</span></p>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text oi oi-dollar"></span>
                                </div>
                                <select name="currency_id" class="form-control custom-select" id="inputGroupSelect03">
                                    @foreach ($data["currencies"] as $cur)
                                        @if ($data['invoices']->currency_name==$cur->currency_name)
                                            <option selected>{{$data['invoices']->currency_name}}</option>
                                        @else
                                            <option >{{$cur->currency_name}}</option>
                                        @endif
                                    @endforeach
                                  </select>
                            </div>
                        </div>
                    </div>

                    <div class="new-item-item new-item-inline" >
                        <div>
                            <p>Invocie Date<span class="new-items-required-fields">*</span></p>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text oi oi-calendar"></span>
                                </div>
                                <input value="{{$data['invoices']->invoice_date}}" name="invoice_date" type="date" class="form-control" placeholder="Customer" required aria-label="saleprice" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div>
                            <p>Due Date<span class="new-items-required-fields">*</span></p>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text oi oi-calendar"></span>
                                </div>
                                <input value="{{$data['invoices']->due_date}}" name="due_date" type="date" class="form-control" placeholder="Currency" required aria-label="purchaseprice" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>

                    <div class="new-item-item new-item-inline" >
                        <div>
                            <p>Invoice Number<span class="new-items-required-fields">*</span></p>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text oi oi-file"></span>
                                </div>
                                <input value="{{$data['invoices']->invoice_number}}" readonly="readonly" name="invoice_number" type="text" class="form-control" placeholder="INV-00002" required aria-label="saleprice" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div>
                            <p>Order Number</p>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text oi oi-cart"></span>
                                </div>
                                <input value="{{$data['invoices']->order_number}}" name="order_number" type="text" class="form-control" placeholder="Enter Order Number" aria-label="purchaseprice" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                    <div class="new-item-item" >
                        <p>Items</p>
                        <div class="input-group">
                            
                            @include('layouts.Invoices.table')
                        </div>
                    </div>
                    <div class="new-item-item" >
                        <p>Notes</p>
                        <div class="input-group">
                            <textarea name="notes" class="form-control" rows="3" cols="50" aria-label="With textarea">{{$data['invoices']->notes}}</textarea>
                        </div>
                    </div>

                    <div class="new-item-item new-item-inline" >
                        <div>
                            <p>Attachment</p>
                            <div class="input-group ">
                                <div class="custom-file">
                                    <input type="file" name="attachment" class="custom-file-input" id="inputGroupFile02">
                                    <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <p>Recurring</p>
                            <div class="input-group ">
                                <input value="{{$data['invoices']->recurring}}" name="recurring" type="text" class="form-control" placeholder="No / Daily / Weekly / Monthly /Yearly" aria-label="purchaseprice" aria-describedby="basic-addon1">
                            </div>
                                
                        </div>
                    </div>
                    <hr>
                    <div class="new-item-item" id="new-items-submits">
                        <div id="new-item-cancel">
                            <span class="oi oi-trash"></span>
                            <button>Cancel</button>
                        </div>
                        <div id="new-item-submit">
                            <span class="oi oi-circle-check"></span>
                            <button type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection