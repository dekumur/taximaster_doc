const cards = document.querySelectorAll('.card');
const container = document.getElementById('videoContainer');
const frame = document.getElementById('videoFrame');

cards.forEach(card => {
    card.addEventListener('click', () => {
        const video = card.getAttribute('data-video');

        if (container.classList.contains('active') && frame.src === video) {
            container.classList.remove('active');
            frame.src = '';
            return;
        }
        frame.src = video;
        container.classList.add('active');

        container.scrollIntoView({ behavior: 'smooth', block: 'center' });
    });
});