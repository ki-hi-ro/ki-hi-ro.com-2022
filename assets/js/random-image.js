function updateRandomImage() {
    fetch(imageAjax.ajaxUrl + '?action=get_random_image')
        .then(response => response.json())
        .then(data => {
            if (!data) return;

            document.querySelectorAll('.js-random-image').forEach((image) => {
                image.src = data.imageUrl;
                image.alt = data.alt || '';
            });

            document.querySelectorAll('.js-random-image-link').forEach((link) => {
                link.href = data.postUrl || '#';
            });
        })
        .catch(error => console.error(error));
}

updateRandomImage();
setInterval(updateRandomImage, ROTATION_INTERVAL);