var hoverElement = document.querySelector('.menu-bar');
var targetElement = document.querySelector('.sidebar-mobile');
var closeButton = document.querySelector('.close-side-nav-btn');
var closeButton2 = document.querySelector('.overlay-on-mobile');
var sideNav = document.querySelector('.side-nav-container');
var nav = document.querySelector('.side-nav');
var navLinks = document.querySelectorAll('.sidebar-mobile .nav-link');

hoverElement.addEventListener('click', function () {
    nav.style.width = '100%';
    sideNav.style.zIndex = '9999';
    targetElement.style.left = '0';
    closeButton2.style.display = 'flex';
});

function closeSideNav() {
    targetElement.style.left = '-400px';
    closeButton2.style.display = 'none';
    setTimeout(function() {
        sideNav.style.zIndex = '0';
        nav.style.width = '0';
    }, 400);
}

closeButton.addEventListener('click', closeSideNav);
closeButton2.addEventListener('click', closeSideNav);

navLinks.forEach(function(navLink) {
    navLink.addEventListener('click', function(event) {
        var parentNavItem = navLink.closest('.nav-item.has-treeview');
        var isSubMenuLink = parentNavItem && parentNavItem.querySelector('.nav-treeview');

        if (!isSubMenuLink) {
            closeSideNav();
        }
    });
});

var openDialogButtons = document.querySelectorAll('.open-dialog-btn');
var closeDialogButtons = document.querySelectorAll('.close-dialog-btn');
var popups = document.querySelectorAll('.popup');

var mainBody = document.querySelector('.main-content-wrapper')

openDialogButtons.forEach(function(openDialogButton) {
    openDialogButton.addEventListener('click', function () {
        mainBody.style.zIndex = '2';
    });
});

closeDialogButtons.forEach(function(closeDialogButton) {
    closeDialogButton.addEventListener('click', function () {
        mainBody.style.zIndex = '0';
        popups.forEach(function(popup) {
            popup.style.display = 'none';
        });
    });
});

if (window.innerWidth >= 1024) {
    let isOffScreen = false;
    const topNavBar = document.getElementById('floating-nav');
    const scrollDetector = document.querySelector('.scroll-detector');
    const openTopNavBtn = document.querySelector('.open-top-nav');

    const observer = new IntersectionObserver(
        ([entry]) => {
            isOffScreen = !entry.isIntersecting;
            topNavBar.classList.toggle('active', isOffScreen);
            openTopNavBtn.classList.toggle('active', isOffScreen);
        },
        { threshold: 0.1 }
    );

    if (scrollDetector) {
        observer.observe(scrollDetector);
    }

    window.addEventListener('beforeunload', function () {
        if (scrollDetector) {
            observer.unobserve(scrollDetector);
        }
    });
    
    document.addEventListener('DOMContentLoaded', function() {
        const logo1 = document.querySelector('.logos-1');
        const logo2 = document.querySelector('.logos-2');
        const logo3 = document.querySelector('.logos-3');
    
        logo1.classList.add('animate');
    
        logo2.classList.add('animate');
    
        logo3.classList.add('animate');
    });
}