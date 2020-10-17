<div class="invoice-details-status">
    <div id="edit-invoice-details">
        <div class="image-invoice-details"><span class="oi oi-wrench font-white"></span></div>
        <div class="details-invoice-details">
            <p class="invoice-details-header">Create Invoice</p>
            <p class="status-invoice-details">
                Status: created on <span class="created-invoice-details">{{date('d-m-Y', strtotime($data["invoices"]->created_at))}}</span>
            </p>
            <div class="buttons-invoice-details">
                <button class="btn-shadow" id="edit-invoice-details-button">Edit</button>
            </div>
        </div>
    </div>
    <div id="send-invoice-details">
        <div class="image-invoice-details"><span class="oi oi-envelope-closed font-white"></span></div>
        <div class="details-invoice-details">
            <p class="invoice-details-header">Send Invoice</p>
            <p class="status-invoice-details">
                Status: <span class="issent-invoice-details">{{$data["invoices"]->isSent}}</span> 
            </p>
            <div class="buttons-invoice-details">
                <button class="btn-shadow" id="mark-sent-invoice-details-button">Mark Sent</button>
                <button class="btn-shadow" id="send-email-invoice-details-button">Send Email</button>
            </div>
        </div>
    </div>
    <div id="get-paid-invoice-details">
        <div class="image-invoice-details"><span class="oi oi-dollar font-white"></span></div>
        <div class="details-invoice-details">
            <p class="invoice-details-header">Get Paid</p>
            <p class="status-invoice-details">
                Status : <span class="ispaid-invoice-details">{{$data["invoices"]->isPaid}}</span>
            </p>
            <div class="buttons-invoice-details">
                <button class="btn-shadow" id="mark-paid-invoice-details-button">Mark Paid</button>
                <button class="btn-shadow" id="add-payment-invoice-details-button">Add Payment</button>
            </div>
        </div>
    </div>
</div>