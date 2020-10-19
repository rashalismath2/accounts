<div class="invoice-details-draft-cont">
    @if ($data["invoices"]->isPaid="Awaiting payment")
        <div class="invoice-details-draft-header-draft">
            <p>Draft</p>
        </div>
    @else
        <div class="invoice-details-draft-header-paid">
            <p>Paid</p>
        </div>
    @endif

    <div class="invoice-details-darft">
        
        <div class="invoice-details-draft-customer">
            <div class="draft-customer-img"><span class="oi oi-vertical-align-top"></span></div>
            <div class="draft-customer-details">
                <p class="draft-customer-company-name">{{auth()->user()->company_name}}</p>
                <p class="draft-customer-email">{{auth()->user()->email}}</p>
            </div>
        </div>
        <hr />

        <div class="invoice-details-draft-details">
            <div class="draft-invoice-customer-details">
                <p class="draft-invoice-customer-name"><span>Bill to: </span>{{$data["invoices"]->name}}</p>
                <p class="draft-invoice-customer-email">{{$data["invoices"]->email}}</p>
            </div>
            <ul class="draft-invoice-details">
                <li class="draft-invoice-details-details">
                    <p>Invoice Number:</p>
                    <p>{{$data["invoices"]->invoice_number}}</p>
                </li>
                <li class="draft-invoice-details-details">
                    <p>Order Number:</p>
                    <p>{{$data["invoices"]->order_number}}</p>
                </li>
                <li class="draft-invoice-details-details">
                    <p>Invoice Date:</p>
                    <p>{{$data["invoices"]->invoice_date}}</p>
                </li>
                <li class="draft-invoice-details-details">
                    <p>Due Date:</p>
                    <p>{{$data["invoices"]->due_date}}</p>
                </li>
            </ul>

        </div>
        
        <div class="invoice-details-draft-items">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th class="draft-table-head" scope="col">Items</th>
                    <th class="draft-table-head" scope="col">Quantity</th>
                    <th class="draft-table-head" scope="col">Price</th>
                    <th class="draft-table-head" scope="col">Total</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($data["items"] as $item)
                        <tr>
                            <th scope="row">{{$item->item_name}}</th>
                            <td>{{$item->qty}}</td>
                            <td>${{$item->price}}</td>
                            <td>${{($item->qty)*($item->price)}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="3" scope="row"></th>
                        <td class="invoice-draft-total-border">Subtotal: ${{$data["invoices"]->amount}}</td>
                    </tr>
                    <tr>
                        <th colspan="3" scope="row"></th>
                        <td class="invoice-draft-total-border">Total: ${{$data["invoices"]->amount}}</td>
                    </tr>
                </tbody>
              </table>
        </div>
        <hr />
        //TODO- delete invoice, print invoice
        <div class="draft-details-buttons">
            <button class="btn-shadow draft-edit"><span class="oi oi-pencil"></span> <a href="/invoices/{{$data["items"][0]->invoice_id}}">Edit</a></button>
            <button class="btn-shadow draft-print"><span class="oi oi-print"></span> Print</button>
            <div class="btn-group dropup">
                <button type="button" class="btn-shadow draft-more dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="oi oi-arrow-thick-top"></span> More Actions
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Delete</a>
                    <a class="dropdown-item" href="#">Download PDF</a>

                </div>
            </div>
        </div>

    </div>
</div>