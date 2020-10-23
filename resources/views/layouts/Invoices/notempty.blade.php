<div id="noempty-items">
    <div id="items-results">

        <section id="items-results-table">
            <table class="table table-striped">
                <thead>
                    {{--  --}}
                  <tr>
                    <th scope="col">NUMBER</th>
                    <th scope="col">CUSTOMER</th>
                    <th scope="col">AMOUNT</th>
                    <th scope="col">INVOICE DATE</th>
                    <th scope="col">DUE DATE</th>
                    <th scope="col">STATUS</th>
                    <th scope="col">ACTIONS</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($invoices as $invoice)
                  <tr id="invoice-{{$invoice->id}}">
                    <th>
                        <p class="items-records-name">
                            <form class="item-record-name" method="GET" action="/invoices/details/{{$invoice->invoice_number}}">
                                <button type="submit">{{$invoice->invoice_number}}</button>
                            </form>

                    </th>
                    <td><p class="font-weight-bold">{{$invoice->customers->name}}</p></td>
                    <td><p class="">${{$invoice->amount}}</p></td>
                    <td><p class="items-records-price">{{$invoice->invoice_date}}</p></td>
                    <td><p class="items-records-price">{{$invoice->due_date}}</p></td>
                    <td><p class="badge badge-danger ">{{$invoice->isSent}}</p></td>
                    <td class="items-action-row">
                      <div class="btn-group dropleft">
                          <span type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"></span>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="/invoices/{{$invoice->id}}">Edit</a>
                            <a onclick="deleteInvoice({{$invoice->id}})" id="delete-invoice" class="dropdown-item" >Delete</a>
                          </div>
                      </div>
                      <div id="spinner-{{$invoice->id}}" class="" role="status">
                        <span class="sr-only">Loading...</span>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
        </section>
        <script src="{{asset('js/invoices/index.js')}}"></script>
    </div>
</div>