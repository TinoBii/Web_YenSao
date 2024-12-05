let icon_up=document.querySelector('.icon_up');
let contact_up=document.querySelector('.contact_up');
window.addEventListener('scroll',()=>{
    console.log(window.pageYOffset);
    if(window.pageYOffset>=300){
        icon_up.classList.add('active');
        contact_up.classList.add('active');
        Scroll.classList.add('active');
    }
    else if(window.pageYOffset<300){
        icon_up.classList.remove('active');
        contact_up.classList.remove('active');
        Scroll.classList.remove('active');
    }
})


let Scroll=document.querySelector('.icon_up');
Scroll.addEventListener('click',()=>{   
    $('body,html').stop().animate({scrollTop: 0}, 900);
})