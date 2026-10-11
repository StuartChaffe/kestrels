document.addEventListener('DOMContentLoaded', () => {

    // Open accordion matching URL hash on page load
    const hash = window.location.hash.slice(1);
    if (hash) {
        const target = document.getElementById(hash);
        if (target?.classList.contains('accordion__item')) {
            target.setAttribute('open', '');
        }
    }

    document.querySelectorAll('.accordion__show-all').forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();
            const items = btn.closest('.accordion')?.querySelectorAll('.accordion__item');
            if (!items) return;

            const allOpen = [...items].every(d => d.open);
            items.forEach(d => allOpen ? d.removeAttribute('open') : d.setAttribute('open', ''));
            btn.textContent = allOpen ? btn.dataset.show : btn.dataset.close;
        });
    });

});
