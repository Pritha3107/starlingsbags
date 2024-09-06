const inputCntainer = document.getElementById("cusInput");
const checkBoxCon = document.getElementById("checkBoxContainer");
let inputGroups = [];
function fetchNormalFormData() {
  $.ajax({
    url: "fetch-products.php",
    method: "GET",
    data: {
      fetchform: "fetch form data",
      quotetype: "normal"
    },
    success: function (response) {
      console.log(response)
      if (response == "") {
        formElement = "";
      } else {
        var formElement = JSON.parse(response);
        inputGroups = formElement || [];
        fetchInputTags();
      }
    },
  });
}

function fetchProductFormData() {
  $.ajax({
    url: "fetch-products.php",
    method: "GET",
    data: {
      fetchform: "fetch form data",
      quotetype: "product"
    },
    success: function (response) {
      console.log(response)
      if (response == "") {
        formElement = "";
      } else {
        var formElement = JSON.parse(response);
        inputGroups = formElement || [];
        fetchInputTags();
      }
    },
  });
}
// fetchFormData();

function fetchInputTags() {
  inputGroups.forEach((inputGroup) => {
    // input group div tag
    const container = document.createElement(
      inputGroup.inputContainer.elementName
    );
    for (let attribute in inputGroup.inputContainer.elementNameAttribute) {
      container.setAttribute(
        attribute,
        inputGroup.inputContainer.elementNameAttribute[attribute]
      );
    }
    // input lable tag
    const lable = document.createElement(inputGroup.inputLable.lab);
    lable.innerHTML = inputGroup.inputLable.labelName;
    for (let attribute in inputGroup.inputLable.labelAttribute) {
      lable.setAttribute(
        attribute,
        inputGroup.inputLable.labelAttribute[attribute]
      );
    }
    // input tag
    const cElement = document.createElement(inputGroup.inputTags.name);
    for (let attribute in inputGroup.inputTags.inputAttribute) {
      cElement.setAttribute(
        attribute,
        inputGroup.inputTags.inputAttribute[attribute]
      );
    }
    // set value to check box
    if (inputGroup.inputTags.inputAttribute.type == "checkbox") {
      cElement.setAttribute("value", inputGroup.inputLable.labelAttribute.for);
    }

    if (inputGroup.inputTags.name == "select") {
      for (let i = 0; i < inputGroup.inputTags.optionTagValue.length; i++) {
        const element = inputGroup.inputTags.optionTagValue[i];
        const createOptionTag = document.createElement("option");
        createOptionTag.setAttribute("value", element);
        createOptionTag.text = element;
        cElement.appendChild(createOptionTag);
      }
    }

    container.appendChild(cElement);
    container.appendChild(lable);
    if (inputGroup.inputTags.inputAttribute.type == "checkbox") {
      checkBoxCon.appendChild(container);
    } else {
      inputCntainer.appendChild(container);
    }
  });

  const selectTags = document.getElementsByTagName("select");
  for (let s = 0; s < selectTags.length; s++) {
    const selectTag = selectTags[s];
    selectTag.addEventListener("focusout", () => {
      if (!selectTag.value == "") {
        let inputStyles = `
          border-radius: 5px;
          border: 2px solid#022C43;
        `;
        let labelStyle = `
          font-weight: 600;
          background: #ffffff;
          color: #022C43;
          transform: scale(0.8) translateY(-30px);
          opacity: 1;
        `;

        // console.log("hi");
        selectTag.style = inputStyles;
        selectTag.parentElement.getElementsByTagName("label")[0].style =
          labelStyle;
      } else {
        selectTag.removeAttribute("style");
        selectTag.parentElement
          .getElementsByTagName("label")[0]
          .removeAttribute("style");
      }
    });
  }
}

// upload image file name show container
upload.onchange = function () {
  uplname.innerHTML = "";

  if (upload.files.length > 4) {
    uplname.innerHTML = "Maximum 4 files only allowed";
    uplname.style.color = "#f00";
  } else {
    for (let i = 0; i < upload.files.length; i++) {
      uplname.innerHTML += upload.files[i].name + `</br>`;
      uplname.style.color = "#022C43";
    }
  }
};


function validateform() {
  var form = document.querySelector("form");
  if (!form.checkValidity()) {
    event.preventDefault();
    form.classList.add("was_validate");
  } else {
    formSubmit();
  }
}
// $(".quoteformaction")[0].reset();
function formSubmit() {
  $(document).on("submit", ".quoteformaction", function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    formData.append("submit", "quoteForm");
    console.log(formData);
    $(".quoteSubmit").prop("disabled", true);
    $(".loaderMainContainer").css("display", "inline-block");
    $.ajax({
      method: "POST",
      url: "quoteformaction.php",
      data: formData,
      contentType: false,
      processData: false,
      cache: false,
      success: function (responses) {
        console.log(responses);
        if (responses == "Error") {
          $(".quoteSubmit").prop("disabled", false);
          $(".loaderMainContainer").css("display", "none");
          Swal.fire({
            title: "SORRY!!!",
            text: "Try Again Later",
            icon: "error",
            confirmButtonText: "Close",
          });
        } else if (responses == "Success") {
          location.href = "shop.php";
        }
      },
    });
  });
}
