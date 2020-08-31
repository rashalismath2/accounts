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
      <tr id="invoice-table-add-btn-row">
        <td><button id="invoice-table-add-btn" type="button" class="btn btn-success"><span class="oi oi-plus"></span></button></td>
        <td colspan="4"></td>
      </tr>
      <tr>
        <th  class="text-right" colspan="4">Subtotal</th>
        <td id="invoice_sub_total" >$0.00</td>
      </tr>
      <tr>
        <th  class="text-right" colspan="4">Total</th>
        <td id="invoice_total">$0.00</td>
      </tr>
    </tbody>
    <script src="{{asset('js/invoices/index.js')}}"></script>
  </table>