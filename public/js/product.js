function changeImage(element, imagePath) {
    const mainImage = document.getElementById('mainImage');
    mainImage.style.opacity = '0';

    setTimeout(() => {
        mainImage.src = imagePath;
        mainImage.style.opacity = '1';
    }, 200);

    document.querySelectorAll('.thumbnail-item').forEach(item => {
        item.classList.remove('active');
    });
    element.classList.add('active');
}

function toggleAccordion(header) {
    const item = header.parentElement;
    const isActive = item.classList.contains('active');

    document.querySelectorAll('.accordion-item').forEach(accordionItem => {
        accordionItem.classList.remove('active');
    });

    if (!isActive) {
        item.classList.add('active');
    }
}
