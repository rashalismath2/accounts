
function deleteInvoice(revenue_id){

    var spinner=document.getElementById("spinner-"+revenue_id);
    spinner.classList.add("spinner-border")

    axios.delete("http://accounts.me/api/revenue",{
        withCredentials: true,
        data:{
            "id":revenue_id
        }
    }).then(e=>{
        // console.log(e)
        var node=document.getElementById("revenue-"+revenue_id);
        node.parentElement.removeChild(node)
    })
}



