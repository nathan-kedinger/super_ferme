//variables arrow-up
let arrowTop;

window.onload = () => {

/**
 * 
 * Arrow-top
 * 
 */
 
    arrowTop = document.querySelector('.arrow-top');
 
    window.addEventListener('scroll',arrowAppear);

}



/**
 * 
 * functions
 * 
 */


/**
 * 
 * Arrow-top
 * 
 */

function arrowAppear(){
    if(window.scrollY < 100){
        arrowTop.style.opacity = "0";
        arrowTop.style.transition = "200ms linear";
    }

    if(window.scrollY > 100){
        arrowTop.style.opacity = "1";
        arrowTop.style.transition = "400ms linear";
    }

}