document.addEventListener('DOMContentLoaded', function() {
    const toast = document.getElementById('toast-message');
    if (toast) {
        setTimeout(() => {
            toast.style.animation = 'slideOut 0.5s ease-out';
            setTimeout(() => {
                toast.remove();
            }, 500);
        }, 3000);
    }
});