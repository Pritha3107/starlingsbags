const toggles = document.querySelector('.toggle')
const sidebar = document.querySelector('.sidebar')
const menulinkname = document.getElementsByClassName('.menu-link-name')
console.log(menulinkname);
toggles.addEventListener("click",function(){

  // toggle.classList.toggle("active")
  menulinkname.classList.toggle("active")


//    if(toggle.classList.contains("active")){
//     sidebar.style.width ="100px";
//     // menulinkname.className ='active';
//     console.log("true");
//    }
//    else{
//     sidebar.style.width ="250px";
//     menulinkname.classList.remove('active')
//     console.log("false");
//    }
})
