document.addEventListener('DOMContentLoaded', function() {
    const tanggalInput = document.getElementById('tanggal');
    const waktuSelect = document.getElementById('waktu');
    
    // Update available times when date changes
    function updateAvailableTimes() {
        const selectedDate = tanggalInput.value;
        const now = new Date();
        const selectedDateTime = new Date(selectedDate);
        
        // Clear existing options
        waktuSelect.innerHTML = '<option value="">Pilih Waktu</option>';
        
        // If selected date is today, only show times at least 1 hour from now
        if (selectedDateTime.toDateString() === now.toDateString()) {
            const currentHour = now.getHours();
            const currentMinute = now.getMinutes();
            
            // Start from the next hour after current time + 1 hour buffer
            let startHour = currentHour + 1; // Add 1 to ensure 1 hour buffer
            
            // If we have minutes, move to the next hour
            if (currentMinute > 0) {
                startHour += 1;
            }
            
            // Add available hours (assuming salon hours 9:00 - 19:00)
            for (let hour = startHour; hour < 19; hour++) {
                if (hour >= 9) { // Only add if within salon hours
                    const timeString = `${hour.toString().padStart(2, '0')}:00`;
                    waktuSelect.add(new Option(timeString, timeString));
                }
            }
        } else if (selectedDateTime > now) {
            // For future dates, show all salon hours (9:00 - 19:00)
            for (let hour = 9; hour < 19; hour++) {
                const timeString = `${hour.toString().padStart(2, '0')}:00`;
                waktuSelect.add(new Option(timeString, timeString));
            }
        }
        
        // If no times are available, show message
        if (waktuSelect.options.length === 1) {
            waktuSelect.innerHTML = '<option value="">Tidak ada waktu tersedia</option>';
        }
    }
    
    // Set minimum date to today
    const today = new Date().toISOString().split('T')[0];
    tanggalInput.setAttribute('min', today);
    
    // Update times when date changes
    tanggalInput.addEventListener('change', updateAvailableTimes);
    
    // Initial update if date is pre-selected
    if (tanggalInput.value) {
        updateAvailableTimes();
    }
}); 