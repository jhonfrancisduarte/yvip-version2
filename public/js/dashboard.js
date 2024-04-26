document.addEventListener("DOMContentLoaded", function() {
    // Get all nav links
    var navLinks = document.querySelectorAll(".nav-link");

    // Add click event listener to each nav link
    navLinks.forEach(function(link) {
        link.addEventListener("click", function(event) {
            // Prevent the default behavior of anchor elements (page reload)
            event.preventDefault();

            // Remove "active" class from all nav links
            navLinks.forEach(function(navLink) {
                navLink.classList.remove("active");
            });

            // Add "active" class to the clicked nav link
            this.classList.add("active");

            // Get the href attribute of the clicked nav link
            var href = this.getAttribute("href");

            // Extract the Livewire component name and parameters from the href
            var components = href.split("?")[0].split("/");
            var component = components[components.length - 1];
            var params = href.split("?")[1];

            // Trigger Livewire navigation
            Livewire.emit("navigate", {
                component: component,
                params: params
            });
        });
    });
});
