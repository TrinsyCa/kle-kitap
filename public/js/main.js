const mini_products = document.querySelectorAll(".mini-product");
let product_timer;

mini_products.forEach(function(product) {
    product.addEventListener("mouseenter", function() {
        product_timer = setTimeout(() => {
            product.classList.add("hover");
        }, 500);
    });
    product.addEventListener("mouseleave", function() {
        clearTimeout(product_timer);
        product.classList.remove("hover");
    });
    product.addEventListener("mousedown", function() {
        product.classList.add("hover");
    });
    product.addEventListener("mouseup", function() {
        clearTimeout(product_timer);
        product.classList.remove("hover");
    });
});

const titleContainer = document.getElementById("titleContainer");
var topBorder = true;
const navbar = document.getElementById("navbar");

window.addEventListener("scroll", function(){
    var ScrollPosition = window.scrollY || window.pageYOffset;

    if (ScrollPosition <= 0)
    {
        navbar.classList.remove("active");
        if(!topBorder)
        {
            titleContainer.classList.remove("scrolled");
            topBorder = true;
        }
    }
    else
    {
        navbar.classList.add("active");
        if (topBorder)
        {
            titleContainer.classList.add("scrolled");
            topBorder = false;
        }
    }
});

const navLink = document.querySelectorAll(".nav-link");
const navLinkHover = document.querySelectorAll(".nav-link.hover");
let navLink_timer;

navLink.forEach(function(link) {
    link.addEventListener("mouseenter", function(){
        navLinkHover.forEach(function(linkHover) {
            linkHover.classList.remove("hover");
        });

        navLink_timer = setTimeout(() => {
            link.classList.add("hover");
        }, 750);
    });
    link.addEventListener("mouseleave", function(){
        clearTimeout(navLink_timer);
        link.classList.remove("hover");
    });
});