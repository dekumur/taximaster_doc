function toggleToc() {
    const body = document.getElementById('tocBody');
    const btn  = document.getElementById('tocToggle');
    if (!body) return;

    const isHidden = body.classList.toggle('hidden');
    btn.textContent = isHidden ? '[показать]' : '[убрать]';
}

document.addEventListener('DOMContentLoaded', () => {
    const mainItems = document.querySelectorAll('.toc-list > li');

    mainItems.forEach((li, idx) => {
        const mainNum = idx + 1;
        const subItems = li.querySelectorAll('.toc-sublist > li > a');

        subItems.forEach((a, subIdx) => {
            const subNum = subIdx + 1;
            a.innerHTML = `<span class="toc-num">${mainNum}.${subNum}</span> ` + a.innerHTML;
        });
    });
});