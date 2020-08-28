
require('./bootstrap');


var dashuser=document.getElementById("dash-op-user");
dashuser.addEventListener("click",()=>{
    var btn=document.querySelector(".dash-op-user")
    var found=false;
    btn.classList.forEach(e=>{
        if(e=="show-dash-option"){
            btn.classList.remove("show-dash-option")
            found=true;
        }
    })
    if(!found){
        btn.classList.add("show-dash-option")
    }
})