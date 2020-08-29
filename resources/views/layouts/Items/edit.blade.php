@extends('home')

@section('dashboard-content')

    <div id="items-cont">
        <div id="new-items-head-cont">
            <p>Edit Item</p>
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
                <form method="post" action="{{route('save_edit_item')}}"  enctype="multipart/form-data">
                   @method("PUT")
                   @csrf
                   <input type="text" name="item_id" hidden value="{{$item->id}}" />
                    <div class="new-item-item" id="new-items-name">
                        <p>Name<span class="new-items-required-fields">*</span></p>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text oi oi-tag"></span>
                            </div>
                            <input value="{{$item->item_name}}" name="item_name" type="text" class="form-control" placeholder="Enter Name" required aria-label="itemname" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="new-item-item" id="new-items-description">
                        <p>Description</p>
                        <div class="input-group">
                            <textarea name="description" class="form-control" rows="3" cols="50" aria-label="With textarea">{{$item->description}}</textarea>
                        </div>
                    </div>
                    <div class="new-item-item" id="new-items-sale-price">
                        <div>
                            <p>Sale Price<span class="new-items-required-fields">*</span></p>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="oi oi-dollar input-group-text"></span>
                                </div>
                                <input value="{{$item->sale_price}}" name="sale_price" type="text" class="form-control" placeholder="Enter Sale Price" required aria-label="saleprice" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div>
                            <p>Purchase Price<span class="new-items-required-fields">*</span></p>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="oi oi-dollar input-group-text"></span>
                                </div>
                                <input value="{{$item->purchase_price}}" name="purchase_price" type="text" class="form-control" placeholder="Enter Purchase Price" required aria-label="purchaseprice" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                    <dvi class="new-item-item" id="new-items-sale-image">
                        <p>Picture</p>
                        <div class="input-group ">
                            <div class="custom-file">
                                <input type="file" accept="image/*" name="image" class="custom-file-input" id="inputGroupFile02">
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
                            <button type="submit">Edit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection