function productNameLenghtSlice(claname, lenght) {
    const product_name = document.getElementsByClassName(claname);
    for (let i = 0; i < product_name.length; i++) {
        const element = product_name[i];
        let productName = element.innerText.slice(0, lenght)
        if (element.innerText.length > lenght) {
             element.innerText = productName + "..."
        }

    }
}