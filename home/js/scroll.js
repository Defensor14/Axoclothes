document.addEventListener("DOMContentLoaded", function() {
    var scrollToTopLink = document.getElementById('scrollToTop');
    scrollToTopLink.addEventListener('click', function(event) {
        event.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});
