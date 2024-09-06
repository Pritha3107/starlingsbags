

             // Bestseller
// const Bestseller = document.querySelector(".Bestseller-card")

// Bestseller.addEventListener('mousedown', function (e) {
//     pressed = true
//     Bestseller.classList.add('active')
//     startX = e.pageX - Bestseller.offsetLeft;
//     scrollLeft = Bestseller.scrollLeft;
    
// })

// window.addEventListener('mouseleave', function (e) {
//     pressed = false
//     Bestseller.classList.remove('active')

// })
// window.addEventListener('mouseup', function (e) {
//     pressed = false
//     Bestseller.classList.remove('active')
    
// })
// Bestseller.addEventListener('mousemove', function (e) {
//     if (!pressed) return;
//     e.preventDefault();
//     const x = e.pageX - Bestseller.offsetLeft;
//     const walk = x - startX;
//     Bestseller.scrollLeft = scrollLeft - walk;
// })
const product_name = document.querySelectorAll("#product_name")


for (let i = 0; i < product_name.length; i++) {

    console.log(product_name[i].innerHTML.length);
    if (product_name[i].innerHTML.length > 40) {
        product_name[i].innerHTML = product_name[i].innerHTML.substring(0,40)+"..."
    }
}
