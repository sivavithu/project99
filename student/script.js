$(document).ready(function() {
    $(".hamburger .hamburger__inner").click(function() {
        $(".wrapper").toggleClass("active");
    });

    $(".top_navbar .fas").click(function() {
        $(".profile_dd").toggleClass("active");
    })});
    if(window.history.replaceState){
        window.history.replaceState(null,null,window.location.href);}
    

   document.addEventListener("DOMContentLoaded", function() {
            var modal = document.getElementById("myModal");
            var openModalButton = document.getElementById("openModal");
            var closeModalButton = document.querySelector(".close");

            openModalButton.addEventListener("click", function() {
                modal.style.display = "block";
            });

            closeModalButton.addEventListener("click", function() {
                modal.style.display = "none";
            });

            window.addEventListener("click", function(event) {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            });
        });
        