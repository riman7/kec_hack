// Star rating click handler
document.querySelectorAll('.stars').forEach(starContainer => {
    starContainer.addEventListener('click', event => {
        if (event.target.tagName === 'SPAN') {
            const value = event.target.getAttribute('data-value');
            const stars = starContainer.querySelectorAll('span');
            
            // Highlight up to the selected star
            stars.forEach(star => {
                if (star.getAttribute('data-value') <= value) {
                    star.classList.add('active');
                } else {
                    star.classList.remove('active');
                }
            });
            
            // Log the rating or send it to your server
            console.log(`Package: ${starContainer.dataset.package}, Rating: ${value}`);
        }
    });
});
