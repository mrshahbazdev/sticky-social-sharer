document.addEventListener('DOMContentLoaded', function() {
    const pageUrl = encodeURIComponent(window.location.href);
    const pageTitle = encodeURIComponent(document.title);
    
    // Pinterest ke liye pehli image find karein
    let postImage = document.querySelector('.entry-content img, .post-content img, .article-content img, article img');
    const mediaUrl = postImage ? encodeURIComponent(postImage.src) : '';

    const icons = document.querySelectorAll('.sss-icon');

    icons.forEach(icon => {
        let shareUrl = '#';

        if (icon.classList.contains('sss-facebook')) {
            shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${pageUrl}`;
        } 
        else if (icon.classList.contains('sss-x')) {
            shareUrl = `https://twitter.com/intent/tweet?url=${pageUrl}&text=${pageTitle}`;
        }
        else if (icon.classList.contains('sss-linkedin')) {
            shareUrl = `https://www.linkedin.com/shareArticle?mini=true&url=${pageUrl}&title=${pageTitle}`;
        }
        else if (icon.classList.contains('sss-whatsapp')) {
            shareUrl = `https://api.whatsapp.com/send?text=${pageTitle}%20${pageUrl}`;
        }
        else if (icon.classList.contains('sss-pinterest')) {
            if (mediaUrl) {
                shareUrl = `https://pinterest.com/pin/create/button/?url=${pageUrl}&media=${mediaUrl}&description=${pageTitle}`;
            } else {
                icon.style.display = 'none';
            }
        }
        else if (icon.classList.contains('sss-reddit')) {
            shareUrl = `https://www.reddit.com/submit?url=${pageUrl}&title=${pageTitle}`;
        }
        else if (icon.classList.contains('sss-telegram')) {
            shareUrl = `https://t.me/share/url?url=${pageUrl}&text=${pageTitle}`;
        }

        icon.href = shareUrl;
    });
});