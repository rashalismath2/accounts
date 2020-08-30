

 // delete the row
 function invoiceDeleteBtn(id){
    var element = document.getElementById("invoice-table-body");
    element.removeChild(id);

}

// invoice table add button
var invoiceTableItems=0
var addBnt=document.getElementById("invoice-table-add-btn");
if(addBnt!=null){
    addBnt.addEventListener("click",()=>{
        invoiceTableItems=invoiceTableItems+1;
        var row = document.createElement("tr");
        row.id=id="invocieItem"+invoiceTableItems
        row.innerHTML="<td ><button onclick='invoiceDeleteBtn("+row.id+")' type='button' class='btn btn-danger'><span class='oi oi-trash'></span></button></td>"+
        "<td>  <input name='item"+invoiceTableItems+"' type='text' class='form-control' placeholder='Item' /></td>"+
        "<td>  <input name='qty"+invoiceTableItems+"' type='text' class='form-control' placeholder='Qty' /></td>"+
        "<td>  <input name='price"+invoiceTableItems+"' type='text' class='form-control' placeholder='$0.00' /></td>"+
        "<td>$0.00</td>"
    
        var element = document.getElementById("invoice-table-body");
        var child = document.getElementById("invoice-table-add-btn-row");
        element.insertBefore(row,child);
    
    })
}

