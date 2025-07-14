$(function () {
    // Setup CSRF token for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Initialize Knob plugin only if elements exist
    if ($(".knob").length) {
        $(".knob").knob();
    }

  

    // Enable table search filtering if elements exist
    if ($('#searchInput').length && $('#searchTable tbody tr').length) {
        $('#searchInput').on('keyup', function () {
            const value = $(this).val().toLowerCase();
            $('#searchTable tbody tr').filter(function () {
                $(this).toggle($(this).text().toLowerCase().includes(value));
            });
        });
    }

    // Helper function to show SweetAlert notifications (DRY principle)
    function showAlert(icon, message, timer) {
        if (!message) return;
        Swal.fire({
            position: 'top-end',
            icon: icon,
            title: message,
            showConfirmButton: false,
            timer: timer,
            toast: true,
            timerProgressBar: true,
        });
    }

    // Show success and error messages if available
    showAlert('success', window.successMessage, 3000);
    showAlert('error', window.errorMessage, 5000);
});
