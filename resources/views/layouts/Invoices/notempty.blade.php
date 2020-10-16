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
                  <tr>
                    <th>
                        <p class="items-records-name">
                            <form class="item-record-name" method="GET" action="/invoices/{{$invoice->id}}">
                                        //TODO- send to invoice details page
                                <button type="submit">{{$invoice->invoice_number}}</button>
                            </form>

                    </th>
                    <td><p class="font-weight-bold">{{$invoice->name}}</p></td>
                    <td><p class="">${{$invoice->amount}}</p></td>
                    <td><p class="items-records-price">{{$invoice->invoice_date}}</p></td>
                    <td><p class="items-records-price">{{$invoice->due_date}}</p></td>
                    <td><p class="badge badge-danger ">Sent</p></td>
                    <td class="items-action-row">
                        <span class="items-records-action oi oi-ellipses"></span>
                        <div class="item-action-drop items-actions">
                            <div class="dash-drop-op-list-item">
                                <span class="oi oi-pencil"></span>
                                <form  method="GET" action="/invoices/{{$invoice->id}}">
                                    <button type="submit">Edit</button>
                                </form>
                            </div>
                            <div class="dash-drop-op-list-item">
                                <span class="oi oi-trash"></span>
                                <form  method="GET" action="/invoices/{{$invoice->id}}">
                                    <input type="text" value="{{$invoice->id}}" hidden name="item" />
                                    @method("DELETE")
                                    @csrf
                                    <button>Delete</button>
                                </form>
                            </div>
                        </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
        </section>
    </div>
</div>