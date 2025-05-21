// Argon Dashboard JS
document.addEventListener('DOMContentLoaded', function() {
    // Toggle sidenav
    const iconSidenav = document.getElementById('iconSidenav');
    const sidenav = document.getElementById('sidenav-main');
    
    if (iconSidenav) {
        iconSidenav.addEventListener('click', function() {
            sidenav.classList.toggle('show');
        });
    }

    // Close sidenav when clicking outside
    document.addEventListener('click', function(event) {
        if (window.innerWidth < 992) {
            if (!sidenav.contains(event.target) && !iconSidenav.contains(event.target)) {
                sidenav.classList.remove('show');
            }
        }
    });

    // Perfect scrollbar
    if (typeof PerfectScrollbar !== 'undefined') {
        const container = document.querySelector('.sidenav .navbar-collapse');
        if (container) {
            const ps = new PerfectScrollbar(container, {
                wheelSpeed: 2,
                wheelPropagation: true,
                minScrollbarLength: 40
            });
        }
    }

    // Smooth scrollbar
    if (typeof Scrollbar !== 'undefined') {
        const scrollbar = document.querySelector('.smooth-scrollbar');
        if (scrollbar) {
            Scrollbar.init(scrollbar, {
                damping: 0.1,
                renderByPixel: true
            });
        }
    }
}); 