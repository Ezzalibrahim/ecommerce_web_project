var fillter = document.querySelector(".filter");
var wrapper_filter = document.querySelector(".wrapper-filter")
var product_container = document.querySelector(".product_container")

fillter.addEventListener('click', () => {
    wrapper_filter.classList.toggle("change");
    // product_container.classList.toggle("col-lg-3")
    console.log(wrapper_filter.style.display);



});