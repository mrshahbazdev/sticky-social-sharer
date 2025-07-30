document.addEventListener('DOMContentLoaded', function() {
    // Current page ka URL aur Title hasil karein
    const pageUrl = encodeURIComponent(window.location.href);
    const pageTitle = encodeURIComponent(document.title);

    // Social media links ke elements ko select karein
    const facebookLink = document.querySelector('.sss-facebook');
    const twitterLink = document.querySelector('.sss-twitter');
    const linkedinLink = document.querySelector('.sss-linkedin');
    const whatsappLink = document.querySelector('.sss-whatsapp');

    // Har link ka href attribute set karein
    if (facebookLink) {
        facebookLink.href = `https://www.facebook.com/sharer/sharer.php?u=${pageUrl}`;
    }

    if (twitterLink) {
        twitterLink.href = `https://twitter.com/intent/tweet?url=${pageUrl}&text=${pageTitle}`;
    }

    if (linkedinLink) {
        linkedinLink.href = `https://www.linkedin.com/shareArticle?mini=true&url=${pageUrl}&title=${pageTitle}`;
    }

    if (whatsappLink) {
        whatsappLink.href = `https://api.whatsapp.com/send?text=${pageTitle}%20${pageUrl}`;
    }
});