@extends('home')

@section('dashboard-content')
    
    <div id="items-cont">
        <div id="new-items-head-cont">
            <p>New Revenue</p>
        </div>
        <div id="new-items-desc-cont">
            <div id="new-items-inputs">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    
                <form action="{{route('save_revenue')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="new-item-item" id="new-items-sale-price">
                        <div>
                            <p>Date<span class="new-items-required-fields">*</span></p>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="oi oi-calendar input-group-text"></span>
                                </div>
                                <input required name="rev_date" type="date" class="form-control" placeholder="Enter Date" required aria-label="saleprice" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div>
                            <p>Amount<span class="new-items-required-fields">*</span></p>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="oi oi-dollar input-group-text"></span>
                                </div>
                                <input required name="rev_amount" type="text" class="form-control" placeholder="$0.00" required aria-label="purchaseprice" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>

                    <div class="new-item-item" id="new-items-sale-price">
                        <div>
                            <p>Account<span class="new-items-required-fields">*</span></p>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="oi oi-box input-group-text"></span>
                                </div>
                                <select name="rev_account" class="form-control custom-select" id="inputGroupSelect03">
                                    @foreach ($data["accounts"] as $acc)
                                        <option >{{$acc->acc_name}}</option>
                                    @endforeach
                                  </select>
                            </div>
                        </div>
                        <div>
                            <p>Customer</p>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="oi oi-person input-group-text"></span>
                                </div>
                                <select name="rev_customer" class="form-control custom-select" id="inputGroupSelect03">
                                    @foreach ($data["customers"] as $cus)
                                        <option >{{$cus->name}}</option>
                                    @endforeach
                                  </select>
                            </div>
                        </div>
                    </div>

                    <div class="new-item-item" id="new-items-description">
                        <p>Description</p>
                        <div class="input-group">
                            <textarea name="rev_description" class="form-control" rows="3" cols="50" aria-label="With textarea"></textarea>
                        </div>
                    </div>

                    <div class="new-item-item" id="new-items-sale-price">
                        <div>
                            <p>Payment Method<span class="new-items-required-fields">*</span></p>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="oi oi-credit-card input-group-text"></span>
                                </div>
                                <select name="rev_payment_methods" class="form-control custom-select" id="inputGroupSelect03">
                                    <option>Cash</option>
                                    <option>Credit</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <p>Recurring</p>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    
                                </div>
                                <input name="rev_recurring" type="text" class="form-control" placeholder="No / Daily / Weekly / Monthly /Yearly" aria-label="purchaseprice" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                    <dvi class="new-item-item" id="new-items-sale-image">
                        <p>Attachment</p>
                            <div class="input-group ">
                                <div class="custom-file">
                                    <input type="file" name="rev_attachment" class="custom-file-input" id="inputGroupFile02">
                                    <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                                </div>
                            </div>
                    </dvi>
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