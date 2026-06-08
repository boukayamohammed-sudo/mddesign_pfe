// MD Design - Main JavaScript File
document.addEventListener('DOMContentLoaded', () => {
    console.log("MD Design - Initialisé avec succès !");
    
    // Mobile navigation toggle handler
    const mobileToggle = document.querySelector('.mobile-toggle');
    const mainNav = document.querySelector('.main-nav');
    
    if (mobileToggle && mainNav) {
        mobileToggle.addEventListener('click', () => {
            mobileToggle.classList.toggle('active');
            mainNav.classList.toggle('active');
        });
    }
});
