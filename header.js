var home = 'https://starlingbagsni.co.uk/';
var shop = 'https://starlingbagsni.co.uk/shop';
var about = 'https://starlingbagsni.co.uk/about';
var contact = 'https://starlingbagsni.co.uk/contact';
var quote = 'https://starlingbagsni.co.uk/quote';

var list = document.getElementsByClassName('list');

if(window.location.href == home){
    list[0].classList.add('active');
    list[5].classList.add('active');
}

if(window.location.href == shop){
    list[1].classList.add('active');
    list[6].classList.add('active');
}

if(window.location.href == about){
    list[2].classList.add('active');
    list[7].classList.add('active');
}

if(window.location.href == contact){
    list[3].classList.add('active');
    list[8].classList.add('active');   
}

if(window.location.href == quote){
    list[4].classList.add('active');
    list[9].classList.add('active');   
}

menu_click.onclick = function(){
    menu_section.style.left = '0';
}

close_menu.onclick = function(){
    menu_section.style.left = '-285px';    
}

window.onclick = function(event){
    if(!event.target.matches('.menu_bar')){
         if(!event.target.matches('.close_bar')){
            if (document.getElementById('menu_section').contains(event.target)){
                menu_section.style.left = '0';
            }
            else{
             menu_section.style.left = '-285px';
            }
        }
    }
}


search.onkeyup = function(){
    if(search.value.length > 0){
        clk_btn.type = "radio";
    }else{
        clk_btn.type = "checkbox";
    }
}

topscroll.onclick = function(){
    window.scrollTo(0,0);
}

window.onscroll = function(){

    if(scrollY > '135'){
        topscroll.style.top = "85%";
    }
    else{
        topscroll.style.top = "110%";
    }

}

    

    






