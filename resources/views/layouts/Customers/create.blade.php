@extends('home')

@section('dashboard-content')

    <div id="items-cont">
        <div id="new-items-head-cont">
            <p>New Customer</p>
        </div>
        <div id="new-items-desc-cont">
            <div id="new-items-inputs">
                @include('layouts.error')
                    
                <form action="{{route('save_customer')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="new-item-item new-item-inline">
                        <div>
                            <p>Name<span class="new-items-required-fields">*</span></p>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text oi oi-person"></span>
                                </div>
                                <input name="name" type="text" class="form-control" placeholder="Enter Name" required aria-label="saleprice" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div>
                            <p>Email</p>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text oi oi-envelope-closed"></span>
                                </div>
                                <input name="email" type="text" class="form-control" placeholder="Enter Email" required aria-label="saleprice" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>

                    <div class="new-item-item new-item-inline" >
                        <div>
                            <p>Currency<span class="new-items-required-fields">*</span></p>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text oi oi-dollar"></span>
                                </div>
                                <select name="currency" class="form-control custom-select" id="inputGroupSelect03">
                                    @foreach ($data["currencies"] as $cur)
                                        <option >{{$cur->name}}</option>
                                    @endforeach
                                  </select>
                            </div>
                        </div>
                        <div>
                            <p>Phone</p>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text oi oi-phone"></span>
                                </div>
                                <input name="phone" type="text" class="form-control" placeholder="Enter Phone" required aria-label="purchaseprice" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>

                    <div class="new-item-item new-item-inline" >
                        <div>
                            <p>Address</p>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text oi oi-location"></span>
                                </div>
                                <input name="address" type="text" class="form-control" placeholder="Enter Address" required aria-label="saleprice" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div>
                            <p>Website</p>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text oi oi-globe"></span>
                                </div>
                                <input name="website" type="text" class="form-control" placeholder="Enter Website" aria-label="purchaseprice" aria-describedby="basic-addon1">
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