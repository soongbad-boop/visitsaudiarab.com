// Mobile navigation toggle
document.addEventListener('DOMContentLoaded', function () {
    var toggle = document.querySelector('.vsa-nav-toggle');
    var nav = document.getElementById('vsa-nav');
    if (toggle && nav) {
        toggle.addEventListener('click', function () {
            var open = nav.classList.toggle('open');
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        });
    }
});
