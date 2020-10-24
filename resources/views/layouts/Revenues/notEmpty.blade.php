<div id="noempty-items">
    <div id="items-results">

        <section id="items-results-table">
            <table class="table table-striped">
                <thead>
                    {{--  --}}
                  <tr>
                    <th scope="col">DATE</th>
                    <th scope="col">AMOUNT</th>
                    <th scope="col">CUSTOMER</th>
                    <th scope="col">ACCOUNT</th>
                    <th scope="col">ACTIONS</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($revenues as $revenue)
                  <tr id="revenue-{{$revenue->id}}">
                    <th>
                        <p class="items-records-name">
                            <a href="/revenues/{{$revenue->id}}">{{$revenue->date}}</a>
                        </p>   

                    </th>
                    <td><p >${{$revenue->amount}}</p></td>
                    <td><p class="font-weight-bold">{{$revenue->customer->name}}</p></td>
                    <td><p class="">{{$revenue->account->acc_name}}</p></td>
                    
                    <td class="items-action-row">
                      <div class="btn-group dropleft">
                          <span type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"></span>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="/revenues/{{$revenue->id}}">Edit</a>
                            <a onclick="deleteInvoice({{$revenue->id}})" id="delete-revenue" class="dropdown-item" >Delete</a>
                          </div>
                      </div>
                      <div id="spinner-{{$revenue->id}}" class="" role="status">
                        <span class="sr-only">Loading...</span>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
        </section>
        <script src="{{asset('js/revenues/index.js')}}"></script>
    </div>
</div>