const labelsNames = document.getElementsByTagName("label");
let labelsNameGroup = [];
const inputTypes = document.getElementsByName("inputTypeChoose");
const inputCntainer = document.getElementById("cusInput");
const checkBoxCon = document.getElementById("checkBoxContainer");
const inputBtn = document.getElementById("creInput");
const createLabel = document.getElementById("inputLabel");
let inputGroups = [];
// let summa=fetchFormData();
let CreateinputTag;
const optionLength = document.getElementById("numberOfLength");
const optionTagLengthContainer = document.querySelector(".optionTagsContainer");
const optionTagAddBtn = document.getElementById("numberOfLengthAddBtn");
const optionContainer = document.getElementById("choosetagValueGet");
const optionValue = document.querySelectorAll(".optioninputTags");
const deleteButton = document.getElementsByClassName("delete-btn");
const editBtton = document.getElementsByClassName("select-option-add-btn");
const saveChanges = document.getElementById("saveChanges");
const addInputTagContainer = document.querySelector(".addInputTagContainer");
const addOptionContainer = document.querySelector(".optionContainer");
const addInputParentContainer = document.querySelector(
  ".addInputParentContainer"
);
const customizeBtn = document.getElementById("customize");
var mul_col = document.getElementsByClassName("multiple_color");

function fetchFormData() {
  $.ajax({
    url: "product-controller.php",
    method: "GET",
    data: {
      fetchform: "fetch form data",
      quotetype: $('#quotetypeId').val()
    },
    success: function (response) {
      if (response == "") {
        dataForm = "";
      } else {
        dataForm = $.parseJSON(response);
        // console.log(dataForm);
        // formstrure = response;
        // JSON.stringify(response)
        // return JSON.parse(response);
        // console.log(jsonObject);
        inputGroups = dataForm || [];
        // inputGroups = JSON.parse(localStorage.getItem("inputGroupes")) || [];
        fetchInputTags();
        colectlabelname();
      }
      // lableNamefindout();
      //console.log(inputGroups);
    },
  });
}
fetchFormData();
// fetchInputTags();

// summa.forEach((fo)=>{
//   console.log(fo);;
// })
// enable disable option tag length input tag
inputTypes.forEach((inputType) => {
  inputType.addEventListener("change", () => {
    if (inputType.value == "select") {
      optionTagLengthContainer.classList.replace("d-none", "d-flex");
      optionContainer.classList.replace("d-none", "d-flex");
    } else {
      optionTagLengthContainer.classList.replace("d-flex", "d-none");
      optionContainer.classList.replace("d-flex", "d-none");
    }
  });
});

optionTagAddBtn.addEventListener("click", () => {
  for (let i = 0; i < optionLength.value; i++) {
    const createTagforOption = document.createElement("input");
    createTagforOption.setAttribute("type", "text");
    createTagforOption.setAttribute(
      "class",
      "form-control shadow-none mb-3 optioninputTags"
    );
    createTagforOption.setAttribute("placeholder", "Enter select value");
    optionContainer.appendChild(createTagforOption);
  }
});
const invalidText = document.getElementById("invalidText");
inputBtn.addEventListener("click", () => {
  if (createLabel.value != "") {
    if (!lableNamefindout(createLabel.value)) {
      inputTypes.forEach((inputType) => {
        if (inputType.checked) {
          // console.log(inputType.value);
          switch (inputType.value) {
            case "text":
            case "number":
            case "checkbox":
              CreateinputTag = {
                inputContainer: {
                  elementName: "div",
                  elementNameAttribute: {
                    class: inputContainerAttribute(inputType.value),
                  },
                },
                inputTags: {
                  name: "input",
                  inputAttribute: {
                    placeholder: " ",
                    type: inputType.value,
                    class: inputTagClass(inputType.value),
                    id: createLabel.value.split(" ").join(""),
                    name: "additonal_input_groups[]",
                  },
                },
                inputLable: {
                  lab: "label",
                  labelName: createLabel.value,
                  labelAttribute: {
                    class: labelTagClass(inputType.value),
                    for: createLabel.value.split(" ").join(""),
                  },
                },
                removeBtn: {
                  elementName: "button",
                  elementNameAttribute: {
                    class: "btn delete-btn shadow-none",
                    type: "button",
                    "data-input-Value": createLabel.value.split(" ").join(""),
                  },
                  nestedElement: {
                    elementName: "i",
                    elementNameAttribute: {
                      class: "fa-solid fa-circle-xmark",
                    },
                  },
                },
              };

              break;
            case "select":
              CreateinputTag = {
                inputContainer: {
                  elementName: "div",
                  elementNameAttribute: {
                    class: inputContainerAttribute(inputType.value),
                  },
                },
                inputTags: {
                  name: "select",
                  inputAttribute: {
                    // placeholder: " ",
                    // type: inputType.value,
                    // class: inputTagClass(inputType.value),
                    id: createLabel.value.split(" ").join(""),
                    name: "additonal_input_groups[]",
                  },
                  // optionTagName:"option",
                  optionTagValue: [""],
                },
                inputLable: {
                  lab: "label",
                  labelName: createLabel.value,
                  labelAttribute: {
                    class: labelTagClass(inputType.value),
                    for: createLabel.value.split(" ").join(""),
                  },
                },
                removeBtn: {
                  elementName: "button",
                  elementNameAttribute: {
                    class: "btn delete-btn shadow-none",
                    type: "button",
                    "data-input-Value": createLabel.value.split(" ").join(""),
                  },
                  nestedElement: {
                    elementName: "i",
                    elementNameAttribute: {
                      class: "fa-solid fa-circle-xmark",
                    },
                  },
                },
                editBtn: {
                  elementName: "button",
                  elementNameAttribute: {
                    class: "btn select-option-add-btn shadow-none",
                    type: "button",
                    "data-input-Value": createLabel.value.split(" ").join(""),
                  },
                  nestedElement: {
                    elementName: "i",
                    elementNameAttribute: {
                      class: "fa-solid fa-square-plus",
                    },
                  },
                },
              };

              // push option tag value in array
              for (let i = 0; i < optionContainer.children.length; i++) {
                const element = optionContainer.children[i].value;
                if (element != "") {
                  CreateinputTag.inputTags.optionTagValue.push(element);
                  // console.log(element);
                }
              }

              break;
          }
          // console.log(optionContainer.children.length);
          inputGroups.push(CreateinputTag);
          checkBoxCon.innerHTML = "";
          inputCntainer.innerHTML = "";
          fetchInputTags();
          saveChanges.removeAttribute("disabled");
        }
      });
      colectlabelname();
      createLabel.value = null;
      inputTypes[0].checked = true;
      optionTagLengthContainer.classList.replace("d-flex", "d-none");
      optionContainer.classList.replace("d-flex", "d-none");
      optionContainer.innerHTML = " ";
      optionLength.value = null;
    } else {
      // alert("That name already exist :)");
      invalidText.innerText = "That name already exist";
      invalidText.classList.replace("d-none", "d-block");
      createLabel.classList.add("invalidStyle");
      createLabel.addEventListener("input", () => {
        createLabel.classList.remove("invalidStyle");
        invalidText.classList.replace("d-block", "d-none");
      });
    }
  } else {
    invalidText.innerText = "Please enter some value";
    invalidText.classList.replace("d-none", "d-block");
    createLabel.classList.add("invalidStyle");
    createLabel.addEventListener("input", () => {
      createLabel.classList.remove("invalidStyle");
      invalidText.classList.replace("d-block", "d-none");
    });
  }
});

saveChanges.addEventListener("click", () => {
  // localStorage.setItem("inputGroupes", JSON.stringify(inputGroups));
  // console.log(inputGroups);
  addInputTagContainer.classList.remove("d-none");
  addOptionContainer.classList.add("d-none");
  addInputParentContainer.classList.replace("d-flex", "d-none");
  customizeBtn.style.display = null;
  // saveChanges.disabled = true;
  // window.location.reload();
});

customizeBtn.addEventListener("click", () => {
  // console.log("hi");
  customizeBtn.style.display = "none";
  addInputParentContainer.classList.replace("d-none", "d-flex");
});
closeBtn.addEventListener("click", () => {
  // console.log("hello");
  addInputParentContainer.classList.replace("d-flex", "d-none");
  customizeBtn.style.display = null;
});
function fetchInputTags() {
  // fetchFormData();
  // console.log(inputGroups);
  inputGroups.forEach((inputGroup) => {
    // console.log("inputGroup");
    // inputGroup.addEventListener("click", ()=>{
    //   console.log(inputGroups.indexOf(inputGroup));
    // })
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
      // console.log(inputGroup.inputLable.labelAttribute.for  );
      cElement.setAttribute("value", inputGroup.inputLable.labelAttribute.for);
    }

    // Remove button
    const removeButtonDiv = document.createElement(
      inputGroup.removeBtn.elementName
    );
    for (let attribute in inputGroup.removeBtn.elementNameAttribute) {
      removeButtonDiv.setAttribute(
        attribute,
        inputGroup.removeBtn.elementNameAttribute[attribute]
      );
    }
    const removeButtonIcon = document.createElement(
      inputGroup.removeBtn.nestedElement.elementName
    );
    for (let attribute in inputGroup.removeBtn.nestedElement
      .elementNameAttribute) {
      removeButtonIcon.setAttribute(
        attribute,
        inputGroup.removeBtn.nestedElement.elementNameAttribute[attribute]
      );
    }
    removeButtonDiv.appendChild(removeButtonIcon);

    // edit button
    let editButtonDiv;
    if (inputGroup.inputTags.name == "select") {
      editButtonDiv = document.createElement(inputGroup.editBtn.elementName);
      for (let attribute in inputGroup.editBtn.elementNameAttribute) {
        editButtonDiv.setAttribute(
          attribute,
          inputGroup.editBtn.elementNameAttribute[attribute]
        );
      }
      // console.log(inputGroup.editBtn);
      const editButtonIcon = document.createElement(
        inputGroup.editBtn.nestedElement.elementName
      );
      for (let attribute in inputGroup.editBtn.nestedElement
        .elementNameAttribute) {
        editButtonIcon.setAttribute(
          attribute,
          inputGroup.editBtn.nestedElement.elementNameAttribute[attribute]
        );
      }
      editButtonDiv.appendChild(editButtonIcon);
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

    // console.log(inputGroup.inputTags.name=="select");
    container.appendChild(cElement);
    container.appendChild(lable);
    container.appendChild(removeButtonDiv);
    if (inputGroup.inputTags.name == "select") {
      container.appendChild(editButtonDiv);
    }
    if (inputGroup.inputTags.inputAttribute.type == "checkbox") {
      checkBoxCon.appendChild(container);
    } else {
      inputCntainer.appendChild(container);
    }

    const checkBoxInput = document.getElementsByTagName("input");
    var clr_opt = document.getElementsByClassName("color_option");
    for (let c = 0; c < checkBoxInput.length; c++) {
      if (checkBoxInput[c].type == "checkbox") {
        checkBoxInput[c].addEventListener("click", () => {
          if (
            checkBoxInput[c].value.toLowerCase() == "color" ||
            checkBoxInput[c].value.toLowerCase() == "colour" ||
            checkBoxInput[c].value.toLowerCase() == "colors" ||
            checkBoxInput[c].value.toLowerCase() == "colours"
          ) {
            if (checkBoxInput[c].checked == true) {
              clr_opt[0].style.height = "7rem";
              console.log(checkBoxInput[c]);
            } else {
              clr_opt[0].style.height = "0";
              mul_col[0].textContent = "";
            }
          }
        });
        rem[0].onclick = function () {
          if (exm.length > 1) {
            exm[exm.length - 1].remove();
          }
        };
      }
    }
  });

  const selectTags = document.getElementsByTagName("select");
  for (let s = 0; s < selectTags.length; s++) {
    const selectTag = selectTags[s];
    selectTag.addEventListener("focusout", () => {
      if (!selectTag.value == "") {
        let inputStyles = `
          border-radius: 5px;
          border: 2px solid#017971;
        `;
        let labelStyle = `
          font-weight: 600;
          background: #ffffff;
          color: #017971;
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

  // delete button
  for (let d = 0; d < deleteButton.length; d++) {
    deleteButton[d].addEventListener("click", (e) => {
      addInputTagContainer.classList.remove("d-none");
      addOptionContainer.classList.add("d-none");
      let indexOfRemove = inputGroups.findIndex(
        (obj) =>
          obj.removeBtn.elementNameAttribute["data-input-Value"] ===
          e.target.parentElement.dataset.inputValue
      );
      e.currentTarget.parentElement.remove();
      inputGroups.splice(indexOfRemove, 1);
      // remove label name form labelsNameGroup array
      let labelIndex = labelsNameGroup.indexOf(
        e.currentTarget.parentElement.children[1].innerText
      );
      labelsNameGroup.splice(labelIndex, 1);
      console.log(labelIndex);
      saveChanges.removeAttribute("disabled");
    });
  }

  // option tag edite button
  for (let e = 0; e < editBtton.length; e++) {
    editBtton[e].addEventListener("click", (ev) => {
      const optionsContainer = document.querySelector(".optionsContainer");
      const OptionInputAddBtn = document.getElementById("OptionInputAddBtn");
      const addOptionInput = document.getElementById("addOptionInput");
      customizeBtn.style.display = "none";
      addInputParentContainer.classList.replace("d-none", "d-flex");
      // console.log(addInputTagContainer.classList);
      // console.log(addOptionContainer.classList);

      const optionLabelName = document.querySelector(".labelName");
      let indexForedit = inputGroups.findIndex(
        (objVal) =>
          objVal.editBtn &&
          objVal.editBtn.elementNameAttribute &&
          objVal.editBtn.elementNameAttribute["data-input-Value"] ===
            ev.target.parentElement.dataset.inputValue
      );
      if (indexForedit < 0) {
        return false;
      }
      optionsContainer.innerHTML = "";

      addInputTagContainer.classList.add("d-none");
      addOptionContainer.classList.remove("d-none");
      // option label names
      // console.log(indexForedit);
      optionLabelName.innerText =
        inputGroups[indexForedit].inputLable.labelName;
      const inputLabelNames =
        inputGroups[indexForedit].inputTags.optionTagValue;

      // let optionCont=function(){}
      for (let i = 0; i < inputLabelNames.length - 1; i++) {
        let element = inputLabelNames[i + 1];

        let parentoptionTag = document.createElement("span");
        let childoptionTag = document.createElement("span");
        let childIconTag = document.createElement("i");

        childIconTag.setAttribute("class", "fa-solid fa-circle-xmark closeBtn");
        childoptionTag.innerHTML = element;
        parentoptionTag.appendChild(childoptionTag);
        parentoptionTag.appendChild(childIconTag);
        optionsContainer.appendChild(parentoptionTag);
        closeOption(indexForedit);
      }
      OptionInputAddBtn.addEventListener("click", () => {
        if (
          addOptionInput.value != "" &&
          !inputGroups[indexForedit].inputTags.optionTagValue.includes(
            addOptionInput.value
          )
        ) {
          saveChanges.removeAttribute("disabled");
          inputGroups[indexForedit].inputTags.optionTagValue.push(
            addOptionInput.value
          );

          let parentoptionTag = document.createElement("span");
          let childoptionTag = document.createElement("span");
          let childIconTag = document.createElement("i");

          childIconTag.setAttribute(
            "class",
            "fa-solid fa-circle-xmark closeBtn"
          );
          childoptionTag.innerHTML += addOptionInput.value;
          parentoptionTag.appendChild(childoptionTag);
          parentoptionTag.appendChild(childIconTag);
          optionsContainer.appendChild(parentoptionTag);
          closeOption(indexForedit);
        } else {
          // alert("entere some value idiot");
          // invalidText.innerText = "That name already exist"
          // invalidText.classList.replace("d-none", "d-block")
          addOptionInput.classList.add("invalidStyle");
          addOptionInput.addEventListener("input", () => {
            addOptionInput.classList.remove("invalidStyle");
            // invalidText.classList.replace("d-block", "d-none")
          });
        }
      });
      // })
    });
  }
}

// input Container class value set
function inputContainerAttribute(checkValue) {
  switch (checkValue) {
    case "text":
    case "number":
      return "form-quote_input w-100 my-3 mb-4 position-relative";
      break;
    case "checkbox":
      return "form-check ps-0 pe-2 mb-4 position-relative";
      break;
    default:
      return "form-quote_option w-100 mb-4 my-3 position-relative";
      break;
  }
}

// input tag class value set
function inputTagClass(checkValue) {
  switch (checkValue) {
    case "text":
    case "number":
      return " ";
      break;
    case "checkbox":
      return "d-none";
      break;
    default:
      return " ";
      break;
  }
}

// input label tag class value set
function labelTagClass(checkValue) {
  switch (checkValue) {
    case "text":
    case "number":
      return " ";
      break;
    case "checkbox":
      return "shadow p-1 px-3";
      break;
    default:
      return " ";
      break;
  }
}

function colectlabelname() {
  for (let lb = 0; lb < labelsNames.length; lb++) {
    const labelsName = labelsNames[lb];
    labelsNameGroup.push(labelsName.innerText.toLowerCase());
  }
}
function lableNamefindout(val) {
  return labelsNameGroup.includes(val.toLowerCase());
}

function closeOption(indexForedit) {
  let colseBtn = document.getElementsByClassName("closeBtn");
  let indexOfRevedElement;
  for (let c = 0; c < colseBtn.length; c++) {
    colseBtn[c].addEventListener("click", (e) => {
      indexOfRevedElement = inputGroups[
        indexForedit
      ].inputTags.optionTagValue.indexOf(
        e.target.parentElement.children[0].innerText
      );
      e.target.parentElement.remove();
      inputGroups[indexForedit].inputTags.optionTagValue;

      if (
        inputGroups[indexForedit].inputTags.optionTagValue[
          indexOfRevedElement
        ] == e.target.parentElement.children[0].innerText
      ) {
        inputGroups[indexForedit].inputTags.optionTagValue.splice(
          indexOfRevedElement,
          1
        );
      }

      // saveChanges.disabled = true;
      saveChanges.removeAttribute("disabled");
    });
  }
}

Coloris({
  el: ".coloris",
  swatches: [
    "#264653",
    "#2a9d8f",
    "#e9c46a",
    "#f4a261",
    "#e76f51",
    "#d62828",
    "#023e8a",
    "#0077b6",
    "#0096c7",
    "#00b4d8",
    "#48cae4",
  ],
});

/** Instances **/

Coloris.setInstance(".instance1", {
  theme: "pill",
  themeMode: "dark",
  formatToggle: true,
  closeButton: true,
  clearButton: true,
  swatches: ["#067bc2", "#84bcda", "#80e377", "#ecc30b", "#f37748", "#d56062"],
});

Coloris.setInstance(".instance2", {
  theme: "polaroid",
});

Coloris.setInstance(".instance3", {
  theme: "polaroid",
  swatchesOnly: true,
});
var exm = document.getElementsByClassName("example");
var add = document.getElementsByClassName("fa-plus");
var rem = document.getElementsByClassName("fa-minus");
add[0].addEventListener("click", function () {
  if (exm.length < 5) {
    mul_col[0].insertAdjacentHTML(
      "beforeend",
      `<div class="example circle">
  <div class="clr-field" style = "color:#000">
    <button type="button"></button>
    <input type="text" class="coloris instance2" value="#000">
  </div>
  </div>`
    );
  } else {
    alert("Maximum 5 colors only");
  }
});
fetchInputTags();
