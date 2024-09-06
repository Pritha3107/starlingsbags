


const productname = document.querySelectorAll(".product-name");

for (let i = 0; i < productname.length; i++) {
  //console.log(productname[i].innerHTML.length);
  if (productname[i].innerHTML.length > 40) {
    productname[i].innerHTML =
      productname[i].innerHTML.substring(0, 40) + "...";
  }
}

//console.log(productname);


// Filter-functionality

const allFilterItems = document.querySelectorAll('.shop-item')
const allfilterBtns = document.querySelectorAll('.filter-btn')

window.addEventListener("DOMContentLoaded", () => {
  allfilterBtns[0].classList.add("active-btn");
});

allfilterBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    showFillteredContent(btn);
  });
});

function showFillteredContent(btn) {
  allFilterItems.forEach((item) => {
    if (item.classList.contains(btn.id)) {
      resetfilterbtn();
      btn.classList.add("active-btn");
      item.style.display = "flex";

      console.log(item.classList);
    } else {
      item.style.display = "none";
      //console.log("none");
    }
  });
}

function resetfilterbtn() {
  allfilterBtns.forEach((btn) => {
    btn.classList.remove("active-btn");
  });
}

//cart functionality

// const shopcartbtn = document.querySelectorAll(".shop-cart-btn");

// let items = [];

// let i = 0;

// for (let i = 0; i < shopcartbtn.length; i++) {
//   shopcartbtn[i].addEventListener("click", function (e) {
//     // console.log(e.target.parentElement.parentElement.children[1].src);
//     // if (typeof (storage) !== 'undefined') {
//     let item = {
//       id: i + 1,
//       src: e.target.parentElement.parentElement.children[1].children[0].src,
//       name: e.target.parentElement.parentElement.children[2].children[0]
//         .textContent,
//       price:
//         e.target.parentElement.parentElement.children[2].children[1]
//           .textContent,
//       no: 1,
//     };

//     if (JSON.parse(localStorage.getItem("items")) === null) {
//       items.push(item);
//       localStorage.setItem("items", JSON.stringify(items));
//       window.location.reload();
//     } else {
//       const localItems = JSON.parse(localStorage.getItem("items"));
//       localItems.map((data) => {
//         console.log(data);
//         if (item.id == data.id) {
//           item.no = data.no + 1;
//         } else {
//           items.push(data);
//           // console.log(items);
//         }
//       });
//       items.push(item);
//       localStorage.setItem("items", JSON.stringify(items));
//       // window.location.reload();
//     }
//     // } else {
//     //     alert('local storage is not working on your browser')
//     // }
//   });
// }


const shop_items = document.getElementsByClassName("shop-items")

// for (let i = 0; i < array.length; i++) {
//   const element = array[i];
  
// }


function chilleng(){
  console.log(shop_items[0].childElementCount);
}