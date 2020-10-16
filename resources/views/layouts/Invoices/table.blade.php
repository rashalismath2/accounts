<table class="table table-bordered">
    <thead class="thead-light">
      <tr>
        <th scope="col">ACTIONS</th>
        <th scope="col">NAME</th>
        <th scope="col">QUENTITY</th>
        <th scope="col">PRICE</th>
        <th scope="col">TOTAL</th>
      </tr>
    </thead>
    <tbody id="invoice-table-body">
      @if ($data["items"])
      <tr>
        //TODO- update total in js, send delete query via ajax
          @foreach ($data["items"] as $item)
            <td ><button onclick='invoiceDeleteBtn("+row.id+")' type='button' class='btn btn-danger'><span class='oi oi-trash'></span></button></td>
            <td>  <input value="{{$item->item_name}}" required name='item"+invoiceTableItems+"' type='text' class='form-control' placeholder='Item' /></td>
            <td>  <input value="{{$item->qty}}" required name='qty"+invoiceTableItems+"' type='text' class='form-control' placeholder='Qty' /></td>
            <td>  <input  value="{{$item->price}}" required onChange='updateTotal(this.value,"+row.id+")' name='price"+invoiceTableItems+"' type='text' class='form-control' placeholder='$0.00' /></td>
            <td>${{($item->qty)*($item->price)}}</td>"
          @endforeach
        </tr>
      @endif
      <tr id="invoice-table-add-btn-row">
        <td><button id="invoice-table-add-btn" type="button" class="btn btn-success"><span class="oi oi-plus"></span></button></td>
        <td colspan="4"></td>
      </tr>
      <tr>
        <th  class="text-right" colspan="4">Subtotal</th>
        <td id="invoice_sub_total" >${{$data["invoices"]->amount}}</td>
      </tr>
      <tr>
        <th  class="text-right" colspan="4">Total</th>
        <td id="invoice_total"><input disabled type="text" name="total_amount" value="${{$data["invoices"]->amount}}" /></td>
      </tr>
    </tbody>
    <script src="{{asset('js/invoices/index.js')}}"></script>
  </table>