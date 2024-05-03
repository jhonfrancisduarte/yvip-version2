// document.addEventListener("DOMContentLoaded", function() {
//     var navLinks = document.querySelectorAll(".nav-link");
//     navLinks.forEach(function(link) {
//         link.addEventListener("click", function(event) {
//             event.preventDefault();
//             navLinks.forEach(function(navLink) {
//                 navLink.classList.remove("active");
//             });
//             this.classList.add("active");
//             var href = this.getAttribute("href");
//             var components = href.split("?")[0].split("/");
//             var component = components[components.length - 1];
//             var params = href.split("?")[1];
//             Livewire.emit("navigate", {
//                 component: component,
//                 params: params
//             });
//         });
//     });
// });
