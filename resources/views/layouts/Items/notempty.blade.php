<div id="noempty-items">
    <div id="items-results">
        {{-- //TODO - add search and design  --}}
        {{-- <section id="items-search">
            <input type="text" placeholder="Search" />
        </section> --}}
        <section id="items-results-table">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">NAME</th>
                    <th scope="col">SALE PRICE</th>
                    <th scope="col">PURCHASE PRICE</th>
                    <th scope="col">ACTION</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($items as $item)
                  <tr>
                    <th>
                        <img class="item-records-image" src="{{asset('storage/items/'.$item->sale_pic_id)}}" alt="" srcset="">
                        <p class="items-records-name">{{$item->item_name}}</p>
                    </th>
                    <td><p class="items-records-price">${{$item->sale_price}}</p></td>
                    <td><p class="items-records-price">${{$item->purchase_price}}</p></td>
                    <td class="items-action-row">
                        <span class="items-records-action oi oi-ellipses"></span>
                        <div class="item-action-drop items-actions">
                            <div class="dash-drop-op-list-item">
                                <span class="oi oi-pencil"></span>
                                <form method="POST" action="{{ route('edit_item') }}">
                                    <input type="text" value="{{$item->id}}" hidden name="item" />
                                    @csrf
                                    <button>Edit</button>
                                </form>
                            </div>
                            <div class="dash-drop-op-list-item">
                                <span class="oi oi-trash"></span>
                                <form method="POST" action="{{ route('delete_item') }}">
                                    <input type="text" value="{{$item->id}}" hidden name="item" />
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