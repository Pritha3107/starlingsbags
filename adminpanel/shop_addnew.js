const productImageContainers = {
  mainImage: document.querySelector('.main-img'),
  uploadmainimg: document.getElementById("upload-main-img"),
  mainImgTag: document.querySelector('.uploadMainImg'),
  uploadcopyimg: document.getElementById("upload-copy-img"),
  copyimagescontainer: document.getElementsByClassName("copy-images"),
  copyImage: document.querySelector('.copy-img'),
  copyImgTag:document.getElementsByClassName('uploadCopyImg')
}

// Remove empty image tag from copy image editnew_product.php
for (let i = 0; i < productImageContainers.copyImgTag.length; i++) {
productImageContainers.copyImgTag[i].addEventListener('error', ()=>{
  productImageContainers.copyImgTag[i].style.display='none';
})
  
}
const coloumContainers = {
  imgSectionCard: document.querySelector('.image-section-card'),
  productdetailsCard: document.querySelector('.productname-section-card')
}

productContainerResponsiveSet();
function mainchange() {
  productImageContainers.mainImgTag.src = "";
  productImageContainers.copyImage.style.display = "none"
  productImageContainers.mainImgTag.style.display = "none";
  productImageContainers.mainImage.classList.remove('errorStyle');
  productContainerResponsiveSet()
  let reader = new FileReader();
  if (productImageContainers.uploadmainimg.files[0]) {
    reader.onload = function (event) {
      productImageContainers.mainImgTag.src = event.target.result;
      productImageContainers.mainImgTag.style.display = "block";
      productImageContainers.copyImage.style.display = "flex";
      productContainerResponsiveSet();
    };
    reader.readAsDataURL(productImageContainers.uploadmainimg.files[0]);

  }
}

function copychange() {
  for (let i = 0; i < productImageContainers.copyimagescontainer.length; i++) {
    productImageContainers.copyimagescontainer[i].children[0].style.display = "none"
  }
  // copyimagescontainer.innerHTML = "";

  if (productImageContainers.uploadcopyimg.files.length > 4) {
    productImageContainers.uploadcopyimg.value = ""
    productImageContainers.copyImage.classList.add('errorStyle');
  }

  else {
    productImageContainers.copyImage.classList.remove('errorStyle')
    for (let i = 0; i < productImageContainers.uploadcopyimg.files.length; i++) {
      let reader = new FileReader();
      reader.readAsDataURL(productImageContainers.uploadcopyimg.files[i]);
      reader.onload = () => {
        productImageContainers.copyimagescontainer[i].children[0].style.display = "flex";
        productImageContainers.copyimagescontainer[i].children[0].src = reader.result
      };
    }
  }
}

function productContainerResponsiveSet() {
  if (window.getComputedStyle(productImageContainers.copyImage, null).display === "none") {
    // remove old col class from container
    coloumContainers.imgSectionCard.classList.remove('col-lg-7');
    coloumContainers.productdetailsCard.classList.remove('col-lg-5');
    // add new col class to container
    coloumContainers.imgSectionCard.classList.add('col-lg-5');
    coloumContainers.productdetailsCard.classList.add('col-lg-7');
  } else {
    // remove old col class from container
    coloumContainers.imgSectionCard.classList.remove('col-lg-5');
    coloumContainers.productdetailsCard.classList.remove('col-lg-7');
    // add new col class to container
    coloumContainers.imgSectionCard.classList.add('col-lg-7');
    coloumContainers.productdetailsCard.classList.add('col-lg-5');
  }
}
// ADD INPUT SECTION
const addInfoSection = {
  card: document.querySelector(".card-row"),
  chooseinputtype: document.querySelector(".choose-input-type"),
  inputaddbtn: document.querySelector(".input-add"),
  inputbackbtn: document.querySelector(".input-back"),
  newinputname: document.querySelector(".newinputname"),
  createProductInfo: document.querySelector(".createProductInfo")
}
addInfoSection.inputaddbtn.addEventListener('click', () => {
  addInfoSection.chooseinputtype.style.display = "flex";
  addInfoSection.inputaddbtn.style.display = "none";
})

addInfoSection.inputbackbtn.addEventListener('click', () => {
  addInfoSection.chooseinputtype.style.display = "none";
  addInfoSection.inputaddbtn.style.display = "block";

})

let i = 0;
var lablename = "";
addInfoSection.newinputname.addEventListener("blur", function (e) {
  e.preventDefault();
  if (addInfoSection.newinputname.value.length > 0) {
    addInfoSection.card.insertAdjacentHTML("beforeend", `<div class="p-2 inputs card">
                             <label class="form-label fs-6 text-nowrap"> ${addInfoSection.newinputname.value} </label>
                             <div class="d-flex"><input type="text" class="form-control shadow-none" name="editable_input[]"  placeholder="Info value" required>
                             <button type="button" class="btn editable-inputs-delete-btn shadow-none" title="Delete info."><i class="fa-solid fa-xmark"></i></i></button></div>
                         </div>`)
    addInfoSection.newinputname.value = "";
  }
});

