/* Default action */

function stopDefAction(e) {
    let windowWidth = document.body.clientWidth;

    if (windowWidth < 992) {
        e.preventDefault();
    }
}

function stopDefActionButtons(e) {
    e.preventDefault();
}

/* Open child category */

function openChildCategory() {
    let links = document.getElementsByClassName('submenu__link');
    let close = document.getElementsByClassName('submenu__close');
    let elements = document.getElementsByClassName('submenu__element');

    for (let i = 0; i < links.length; i++) {
        if (links[i].tagName == 'BUTTON') {
            links[i].addEventListener('click', stopDefActionButtons, false);
        }
        links[i].addEventListener('click', stopDefAction, false);
        links[i].addEventListener('click', function () {
            elements[i].classList.add('menuDropdown__wrapper-open');
        }, false);
        close[i].addEventListener('click', function () {
            elements[i].classList.remove('menuDropdown__wrapper-open');
        }, false);
    }
}

/* Open-close slide navigation */

let slideNavPositionY;

function openSlideNav() {
    let nav = document.getElementsByClassName('listMenu__wrapperOut')[0];
    nav.classList.add('listMenu__wrapperOut-open');

    slideNavPositionY = window.pageYOffset;
    
    setTimeout(() => {
        let doc = document.querySelectorAll('html, body');
        for (let i = 0; i < doc.length; i++) {
            doc[i].classList.add('no-scroll');
        }
    }, 200);
}

function closeSlideNav() {
    let nav = document.getElementsByClassName('listMenu__wrapperOut')[0];
    nav.classList.remove('listMenu__wrapperOut-open');

    let doc = document.querySelectorAll('html, body');
    for (let i = 0; i < doc.length; i++) {
        doc[i].classList.remove('no-scroll');
    }

    window.scroll(0, slideNavPositionY);
}

/* Open-close main links */

function openSection(i) {
    let section = document.getElementsByClassName(i)[0];
    section.classList.add('listMenu__wrapperOut-open');
}

function closeSection(i) {
    let link = document.getElementsByClassName(i)[0];
    link.classList.remove('listMenu__wrapperOut-open');
}

/* Export */

function header() {
    openChildCategory();
}