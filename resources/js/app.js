
require('./bootstrap');

// clicking on nav user button
var dashuser=document.getElementById("dash-op-user");
dashuser.addEventListener("click",()=>{
    const btn=document.querySelector(".dash-op-user")
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

// clicking on items records actions span
var action=document.querySelector(".items-records-action");
if(action){
    action.addEventListener("click",()=>{
        const btn=document.querySelector(".items-actions")    
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
}