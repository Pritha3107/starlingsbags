// CATEGORIES

const categoriesrow = document.querySelector(".categories-row");

const addcategoriesbtn = document.querySelector(".add-categories-btn");

const addcategoriespopupcard = document.querySelector(
  ".add-categories-popup"
);

const addcategoriestitle = document.querySelector(".add-categories-title");

const addcategorieslabel = document.querySelector(".add-categories-label");

const uploadtext = document.querySelector(".upload-text");

const uploadedtext = document.querySelector(".uploaded-text");

const uploadaddcategoriesimg = document.querySelector(
  "#upload-add-categories-img"
);

const addcategoriespopupbackbtn = document.querySelector(
  ".add-categories-popup-back-btn"
);

const addcategoriespopupsubmitbtn = document.querySelector(
  ".add-categories-popup-submit-btn"
);

const addedcategoriesdeletebtn = document.querySelectorAll(
  ".added-categories-delete-btn"
);

const deletepopupcard = document.querySelector(".delete-popup-card");
const uploadedimg = document.querySelector('.uploadedimg')

addcategoriesbtn.addEventListener("click", function () {
  addcategoriesbtn.classList.add("active");

  addcategoriespopupcard.classList.remove("active");
  window.addEventListener('click', (e)=>{
    if (e.target== addcategoriespopupcard) {
      addcategoriespopupcard.classList.add("active");
      addcategoriesbtn.classList.remove("active");
    }
  })
});
addcategoriespopupbackbtn.addEventListener("click", function () {
  addcategoriesbtn.classList.remove("active");
  addcategoriespopupcard.classList.add("active");
});

function categoriesuploadimg() {
    const reader = new FileReader();
    if (uploadaddcategoriesimg.value != "") {
      reader.onload = function (event){
        uploadedimg.src = event.target.result;
        uploadedimg.style.display="block"
      }
      reader.readAsDataURL(uploadaddcategoriesimg.files[0])
    uploadedtext.classList.add("active");

    uploadtext.classList.add("active");
  }else{
    uploadedimg.style.display="none"
  }
}

addcategoriespopupsubmitbtn.addEventListener("click", function () {
  if (
    addcategoriestitle.value.length > 1 &&
    uploadaddcategoriesimg.value != ""
  ) {
    addcategoriesbtn.classList.remove("active");
    //addcategoriespopupcard.classList.add("active");

    let reader = new FileReader();
    reader.readAsDataURL(uploadaddcategoriesimg.files[0]);
    //console.log(uploadaddcategoriesimg.files[0]);

    reader.onload = () => {
      //     categoriesrow.innerHTML += `<div class="card col-lg-2 col-md-3 col-sm-4 col-6 m-3">
      //     <div class="card-header">
      //         <h4>${addcategoriestitle.value}</h4>
      //     </div>
      //     <div class="card-body">
      //         <img src="${reader.result}" alt="" height="200">
      //     </div>
      //     <div class="card-foot d-flex justify-content-evenly">
      //         <button class="btn btn-outline-dark added-categories-edit-btn">Edit</button>
      //         <button class="btn btn-outline-dark added-categories-delete-btn">Delete</button>
      //     </div>
      // </div>`
      addcategoriestitle.value = "";
      uploadaddcategoriesimg.value = "";
    };

    uploadedtext.classList.remove("active");

    uploadtext.classList.remove("active");
  } else {
    // alert("You need to fill the inputs");
  }
});

for (let i = 0; i < addedcategoriesdeletebtn.length; i++) {
  addedcategoriesdeletebtn[i].addEventListener("click", function () {
    deletepopupcard.classList.remove("active");
  });
}

// LISTING

const addlistinginput = document.querySelector(".add-listing-input");

const addlistingbtn = document.querySelector(".add-listing-btn");

const addedlisting = document.querySelector(".added-listing");

const addedlistingcard = document.querySelectorAll(".added-listing-card");

const addedlistingdeletebtn = document.querySelector(
  "#added-listing-delete-btn"
);

const deletepopupnobtn = document.querySelector(".delete-popup-no-btn");

// addlistingbtn.addEventListener("click", function () {
//   if (addlistinginput.value.length > 1) {
//     addedlisting.innerHTML += `  <div class="card text-center added-listing-card">
//     <div class="card-header">
//         <h3 class="added-list-title"> ${addlistinginput.value}</h3>
//     </div>

//     <div class="card-body w-100">
//         <div class="w-100">
//             <button class="btn btn-outline-dark added-listing-edit-btn" id="added_listing_edit_btn">Edit</button>
//             <button class="btn btn-outline-dark added-listing-delete-btn" id="added-listing-delete-btn">Delete</button>
//         </div>

//     </div>
// </div>`;
//   }

//   //addlistinginput.innerHTML = "";
// });

// for (let i = 0; i < addedlisting.children.length; i++) {
// console.log(addedlisting.children[i]);
//  console.log("hgjyf");
// addedlistingdeletebtn.addEventListener("click", function () {
//   // console.log("hgjyf");
//   deletepopupcard.classList.remove("active");
// });

// deletepopupnobtn.addEventListener("click", function () {
//   deletepopupcard.classList.add("active");
// });

// addcategorieseditpopup

const addedcategorieseditbtn = document.querySelectorAll(
  ".added-categories-edit-btn"
);

const addcategorieseditpopupcard = document.querySelector(
  ".add-categories-edit-popup-card"
);

const addcategorieseditpopupdiscardbtn = document.querySelector(
  ".add-categories-edit-popup-discard-btn "
);

const addcategorieseditpopupchangebtn = document.querySelector(
  ".add-categories-edit-popup-change-btn "
);

const addcategoriesedittitle = document.querySelector(
  ".add-categories-edit-title "
);

const uploadaddcategorieseditimg = document.querySelector(
  "#uploadaddcategorieseditimg "
);

const edituploadtext = document.querySelector(".edit-upload-text");

const edituploadedtext = document.querySelector(".edit-uploaded-text");

//console.log(addedcategorieseditbtn);

for (let j = 0; j < addedcategorieseditbtn.length; j++) {
  addedcategorieseditbtn[j].addEventListener("click", function () {
    addcategorieseditpopupcard.classList.remove("active");
    console.log(
      addedcategorieseditbtn[j].parentElement.parentElement.children[1]
        .children[0].src
    );
    addcategoriesedittitle.value =
      addedcategorieseditbtn[
        j
      ].parentElement.parentElement.children[0].children[0].innerHTML;

    addcategorieseditpopupchangebtn.onclick = function () {
      addedcategorieseditbtn[
        j
      ].parentElement.parentElement.children[0].children[0].innerHTML =
        addcategoriesedittitle.value;

      addcategorieseditpopupcard.classList.add("active");

      let editreader = new FileReader();
      editreader.readAsDataURL(uploadaddcategorieseditimg.files[0]);

      editreader.onload = () => {
        addedcategorieseditbtn[
          j
        ].parentElement.parentElement.children[1].children[0].src =
          editreader.result;
      };
    };
  });
}

addcategorieseditpopupdiscardbtn.onclick = function () {
  addcategorieseditpopupcard.classList.add("active");
};

function categoriesuploadeditimg() {
  if (uploadaddcategorieseditimg.value != "") {
    edituploadedtext.classList.add("active");

    edituploadtext.classList.add("active");
  }
}
///////////////////////////////////

// addcategoriespopupsubmitbtn.addEventListener('click', function () {

//     if (addcategoriestitle.value.length > 1 && uploadaddcategoriesimg.value != "") {

//         addcategoriesbtn.classList.remove('active')
//         addcategoriespopupcard.classList.add('active')

//         let reader = new FileReader();
//         reader.readAsDataURL(uploadaddcategoriesimg.files[0]);
//         console.log(uploadaddcategoriesimg.files[0])

//         reader.onload = () => {
//             categoriesrow.innerHTML += `<div class="card col-lg-2 col-md-3 col-sm-4 col-6 m-3">
//         <div class="card-header">
//             <h3>${addcategoriestitle.value}</h3>
//         </div>
//         <div class="card-body">
//             <img  src="${reader.result}" alt="" height="200">
//         </div>
//         <div class="card-footer">
//         <button class="btn btn-outline-dark">Delete</button>
//     </div>
//     </div>`
//             addcategoriestitle.value = ""
//             uploadaddcategoriesimg.value = ""
//         }

//         uploadedtext.classList.remove('active')

//         uploadtext.classList.remove('active')
//     }
//     else {
//         alert("you need to fill the inputs")
//     }
// })

// addedlistingeditpopup

const addedlistingeditpopupcard = document.querySelector(
  ".added-listing-edit-popup-card"
);

const addedlistingeditbtn = document.querySelectorAll(
  "#added_listing_edit_btn"
);

const addedlisttitle = document.querySelectorAll(".added-list-title");

const addedlistingedittitle = document.querySelector(
  ".added-listing-edit-title"
);

const addedlistingeditpopupdiscarbtn = document.querySelector(
  ".added-listing-edit-popup-discard-btn"
);

const addedlistingeditpopupchangebtn = document.querySelector(
  ".added-listing-edit-popup-change-btn"
);

addedlistingeditbtn.forEach((listedit) => {
  listedit.addEventListener("click", function () {
    addedlistingeditpopupcard.classList.remove("active");
    addedlistingedittitle.value =
      listedit.parentElement.parentElement.parentElement.children[0].children[0].innerHTML;
    // console.log(listedit.parentElement.parentElement.children[0].children[0].innerHTML);
    addedlistingeditpopupchangebtn.onclick = function () {
      listedit.parentElement.parentElement.parentElement.children[0].children[0].innerHTML =
        addedlistingedittitle.value;
      addedlistingeditpopupcard.classList.add("active");
    };
  });
});
addedlistingeditpopupdiscarbtn.onclick = function () {
  addedlistingeditpopupcard.classList.add("active");
};
