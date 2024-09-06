const invpsd = document.getElementsByClassName("invalid_psd");
const invmsg = document.getElementsByClassName("invalid_msg");
const pw1 = document.getElementById("pswd1");
const pw2 = document.getElementById("pswd2");
const opeye = document.getElementsByClassName("fa-eye");
const cleye = document.getElementsByClassName("fa-eye-slash");

function validateform() {

  var form = document.querySelector('form');

  if (!form.checkValidity()) {
      event.preventDefault();
      form.classList.add('was_validate');
  }
  validateConPwd();
}

newpasswrd_visible.onclick = function () {
  if (pw1.type === "password") {
    pw1.type = "text";
    opeye[0].style.display = "block";
    cleye[0].style.display = "none";
  } else {
    pw1.type = "password";
    cleye[0].style.display = "block";
    opeye[0].style.display = "none";
  }
};
function validateConPwd() {
  console.table(pw2.value);
  if (pw1.value === pw2.value) {
    pw2.style.borderColor = '#022C43';
    pw2.style.boxShadow = '0px 0px 2px 0px #000';
    invmsg[0].style.visibility = 'hidden'
  }else{
    event.preventDefault();
    pw2.style.boxShadow = '0px 0px 2px 0px #f00';
    pw2.style.borderColor = '#f00';
    invmsg[0].style.visibility = 'visible';
  }
}
