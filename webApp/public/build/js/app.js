function eventListeners(){document.querySelector(".mobile-menu").addEventListener("click",responsiveMenu)}function responsiveMenu(){console.log("click");document.querySelector(".navigation").classList.toggle("show")}document.addEventListener("DOMContentLoaded",()=>{eventListeners()}),setTimeout(()=>{const e=document.querySelector(".alert.success");e&&e.remove()},5e3);