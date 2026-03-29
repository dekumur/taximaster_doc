document.addEventListener('DOMContentLoaded', function () {
    const inputs = document.querySelectorAll('.search-box input[type="text"]');

    inputs.forEach(input => {
        const results = document.createElement('div');
        results.classList.add('search-results');
        input.closest('.input-wrap').appendChild(results);

        let timer = null;

        input.addEventListener('input', function () {
            const q = this.value.trim();

            clearTimeout(timer);

            if (q.length < 2) {
                results.classList.remove('active');
                results.innerHTML = '';
                return;
            }

            timer = setTimeout(() => {
                fetch(`php/search.php?q=${encodeURIComponent(q)}`)
                    .then(r => r.json())
                    .then(data => {
                        results.innerHTML = '';

                        if (data.length === 0) {
                            results.innerHTML = '<div class="search-result-empty">Ничего не найдено</div>';
                        } else {
                            data.forEach(item => {
                                const href = buildUrl(item);
                                const a = document.createElement('a');
                                a.classList.add('search-result-item');
                                a.href = href;
                                a.innerHTML = `
                                    <span class="search-result-title">${item.title}</span>
                                    <span class="search-result-section">${item.section_title ?? ''}</span>
                                `;
                                results.appendChild(a);
                            });
                        }

                        results.classList.add('active');
                    })
                    .catch(() => {
                        results.classList.remove('active');
                    });
            }, 300);
        });

        document.addEventListener('click', function (e) {
            if (!input.closest('.search-box').contains(e.target)) {
                results.classList.remove('active');
            }
        });
    });

    function buildUrl(item) {
        const sectionPages = {
            'taximaster': 'taximaster.php',
            'taxophone':  'taxophone.php',
            'tmmarket':   'tmmarket.php',
            'tmdriver':   'tmdriver.php',
            'voice_robot':'robot.php',
            'web_services':'web.php',
        };

        const page = sectionPages[item.section_slug] ?? `section.php?s=${item.section_slug}&`;

        if (page.includes('?')) {
            return `${page}article=${item.slug}`;
        }

        return `${page}?article=${item.slug}`;
    }
});