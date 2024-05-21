document.addEventListener("DOMContentLoaded", function() {
    var images = document.querySelectorAll(".info-item img");
    var currentIndex = 0;

    function zoomImage() {
        // Reset previous image
        images[currentIndex].classList.remove("zoom-in");

        // Move to the next image
        currentIndex = (currentIndex + 1) % images.length;

        // Zoom in on the current image
        images[currentIndex].classList.add("zoom-in");
    }

    // Zoom in on the first image initially
    images[currentIndex].classList.add("zoom-in");

    // Zoom in on each image every 5 seconds
    setInterval(zoomImage, 5000);
});