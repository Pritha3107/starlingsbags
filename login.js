
function validateform(event) {


    var form = document.querySelector('form');

    if (!form.checkValidity()) {

        event.preventDefault();
        form.classList.add('was_validate');

    }
    else {
      const email = document.getElementById("email")
        const password = document.getElementById("password")
        
        const Data = []
        const emmail = email.value
        const passsword = password.value

        Data.push(emmail)

        Data.push(passsword)


        if (remember.checked) {
           window.location.reload()
            localStorage.setItem("Data", JSON.stringify(Data));
        }

    }
}

Data = JSON.parse(localStorage.getItem("Data"));
email.value = Data[0]
password.value = Data[1]
