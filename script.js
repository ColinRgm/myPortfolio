/* -- navBar --------------------------------------------------------------------------------------------------------

const indicator = document.querySelector('.nav-indicator');
const items = document.querySelectorAll('.nav-item');



function handleIndicator(el) {
    // Boucler sur tout les items -> retirer la classe 'is-active'
    items.forEach(item => {
        item.classList.remove('is-active');
        item.removeAttribute('style');
    })


    // Styliser l'indicateur
    indicator.style.width = `${el.offsetWidth}px`;
    indicator.style.backgroundColor = 'white';
    indicator.style.left = `${el.offsetLeft}px`;

    // Ajouter la classe 'is-active'
    el.classList.add('is-active');
}



items.forEach((item) => {
    item.addEventListener('click', el => {
        handleIndicator(el.target)
    });
    item.classList.contains('is-active') && handleIndicator(item);
});



/* -- Carousel ------------------------------------------------------------------------------------------------------ */

let slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
    showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    if (n > slides.length) {
        slideIndex = 1
    }
    if (n < 1) {
        slideIndex = slides.length
    }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
}



/* -- Mettre l'âge à jour automatiquement ---------------------------------------------------------------------------

---- Charger la date au rechargement de la page ----

function getAge(date) {
    var diff = Date.now() - date.getTime();
    var age = new Date(diff);
    return Math.abs(age.getUTCFullYear() - 1970);
}

alert(getAge(new Date(1999, 8, 11))); -- Date(année, mois, jour) -- */



/* -- Switch --------------------------------------------------------------------------------------------------------
checkbox.addEventListener('click',(event)=>{
    if (checkbox.classList.contains('on')){
    checkbox.setAttribute('aria-checked', 'false');
    } else {
    checkbox.setAttribute('aria-checked', 'true');
    }
        checkbox.classList.toggle('on');
});

const checkbox = document.querySelector(".checkbox"); */