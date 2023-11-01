//Menu pegajoso
window.addEventListener('scroll', function() {
    var header = document.querySelector('nav');
    if (window.scrollY > 0) {
        header.style.position = 'fixed';
        header.style.top = '0';
        header.style.width = '100%';
    } else {
        header.style.position = 'relative';
    }
});
