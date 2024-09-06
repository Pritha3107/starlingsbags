// import {str} from './shop.js';

// console.log(str);
const indicator = document.getElementsByClassName('indicator')
const mainsingleimg = document.querySelector('.main-single-img')

// for (var i = 0; i < indicator.length; i++) {
//     indicator[i].onclick = function () {

//       console.log(i);
//         mainsingleimg.src = indicator[i].src;
//         console.log("jhkg");

//     }
// }

for (let i = 0; i < indicator.length; i++) {

    indicator[i].onclick = function () {

        // console.log(i);
        mainsingleimg.src = indicator[i].src;
    }

}

// indicator[0].onclick = function () {

//     // console.log(i);
//     mainsingleimg.src = indicator[0].src;
// }

// indicator[1].onclick = function () {

//     // console.log(i);
//     mainsingleimg.src = indicator[1].src;
// }

// indicator[2].onclick = function () {

//     // console.log(i);
//     mainsingleimg.src = indicator[2].src;
// }

// indicator[3].onclick = function () {

//     // console.log(i);
//     mainsingleimg.src = indicator[3].src;
// }