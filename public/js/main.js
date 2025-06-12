// Handle booking button clicks in services section
document.addEventListener('DOMContentLoaded', function() {
    const bookingButtons = document.querySelectorAll('.btn-booking');
    
    bookingButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Get the service type from data attribute
            const serviceType = this.getAttribute('data-service');
            
            // Scroll to booking section
            const bookingSection = document.getElementById('booking');
            bookingSection.scrollIntoView({ behavior: 'smooth' });
            
            // Set the selected service in the dropdown
            setTimeout(() => {
                const serviceSelect = document.getElementById('jenis_layanan');
                if (serviceSelect) {
                    serviceSelect.value = serviceType;
                }
            }, 800); // Add a small delay to ensure smooth scrolling completes
        });
    });
}); 