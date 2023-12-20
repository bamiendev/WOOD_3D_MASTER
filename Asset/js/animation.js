/*-------------------------------------------------------Button---------------------------------------------------------------------- */
const ratingButtons = document.querySelectorAll('.rating-button');

function createStars(button) {
    for (let i = 1; i <= 6; i++) {
        const starDiv = document.createElement('div');
        starDiv.className = `star-${i}`;

        const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
        svg.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
        svg.setAttribute('viewBox', '0 0 784.11 815.53');
        svg.style.cssText = 'shape-rendering: geometricPrecision; text-rendering: geometricPrecision; image-rendering: optimizeQuality; fill-rule: evenodd; clip-rule: evenodd';

        const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
        path.setAttribute('d', 'M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z');

        svg.appendChild(path);
        starDiv.appendChild(svg);
        button.appendChild(starDiv);
    }
}

ratingButtons.forEach(button => {
    createStars(button);
});




