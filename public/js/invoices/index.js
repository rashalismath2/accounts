
function deleteInvoice(invoice_id){

    var spinner=document.getElementById("spinner-"+invoice_id);
    spinner.classList.add("spinner-border")

    axios.delete("http://accounts.me/api/invoice",{
        withCredentials: true,
        data:{
            "invoice_id":invoice_id
        }
    }).then(e=>{
        var node=document.getElementById("invoice-"+invoice_id);
        node.parentElement.removeChild(node)
    })
}

 // delete the row
 function invoiceDeleteBtn(id){
    var element = document.getElementById("invoice-table-body");
    element.removeChild(id);
}

var total=0;
var rawTotal=0;
function updateTotal(val,id){
    
    id.lastElementChild.textContent="$"+val
    console.log(total)
    var qty=id.children[2].firstElementChild.value
    
    var elSub=document.getElementById("invoice_sub_total")
    var elTotal=document.getElementById("invoice_total")

    //when we trying to edit an excisting invoice we have a first total value
    //so abouve total valiable shouldnt be start with 0 rather start with database total
    
    if(total==0){
        total=parseInt(elTotal.firstElementChild.value.substring(1))
        console.log("a ",total)
    }
    
    total=total+parseInt(val*qty);
    
    rawTotal=parseInt(val*qty);
    
    //update total in the raw
    id.lastElementChild.textContent="$"+rawTotal


    if(elSub.textContent.substring(1)!="$"){
        elSub.textContent="$"+total
        elTotal.firstElementChild.value="$"+total
    }
    else{
        
        elSub.textContent=total+parseInt(elSub.textContent.substring(1))
        elSub.textContent="$"+elSub.textContent

        elTotal.firstElementChild.value=total+parseInt(elTotal.firstElementChild.value.substring(1))
        elTotal.firstElementChild.value="$"+elTotal.firstElementChild.value
    }

    rawTotal=0
    
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
        "<td>  <input required name='item"+invoiceTableItems+"' type='text' class='form-control' placeholder='Item' /></td>"+
        "<td>  <input required name='qty"+invoiceTableItems+"' type='text' class='form-control' placeholder='Qty' /></td>"+
        "<td>  <input required onChange='updateTotal(this.value,"+row.id+")' name='price"+invoiceTableItems+"' type='text' class='form-control' placeholder='$0.00' /></td>"+
        "<td>$0.00</td>"
    
        var element = document.getElementById("invoice-table-body");
        var child = document.getElementById("invoice-table-add-btn-row");
        element.insertBefore(row,child);
    
    })
    
}

