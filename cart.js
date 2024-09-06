let table = document.querySelector('tbody')
let thead = document.querySelector('thead')
let shoppingcarttitle = document.querySelector('.shopping-cart-title')

console.log(shoppingcarttitle);


let tbodydata = ''


// console.log(JSON.parse(localStorage.getItem('items')).length === 0);
if (JSON.parse(localStorage.getItem('items')).length === 0) {
    tbodydata = '<tbody ><tr class = "tbodyNo"><td class = "tdNo"><h3 class="no">No Items found</h3></td></tr></tbody>'
    

    shoppingcarttitle.style.marginBottom = "50px"
    thead.style.display = "none"

    table.style.width = "300px"

    table.innerHTML += tbodydata;


}
else {
    JSON.parse(localStorage.getItem('items')).map(data => {
        tbodydata = '<tbody ><tr><td> <a href="#" onclick=Delete(event);><i class="fas fa-circle-xmark"></a></td><td class="item-id"><h6>' + data.id + '</h6></td><td><img src="' + data.src + '" alt=""></td><td><h6>' + data.name + '</h6></td><td><h6>' + data.price + '</h6></td><td><button class="btn btn-outline-dark">Get Quote</button></td></tr></tbody> '

        table.innerHTML += tbodydata;
        // console.log(data.length);


    })
}


function Delete(event) {

    let items = []
    let deleteId = event.target.parentElement.parentElement.parentElement.children[1].children[0].innerHTML
    JSON.parse(localStorage.getItem('items')).map(data => {
        if (data.id != deleteId) {
            items.push(data);
        }
    });
    localStorage.setItem('items', JSON.stringify(items));
    // window.location.reload();
}
// console.log(tbodydata);

