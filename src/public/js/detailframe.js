const detailBg = document.getElementById('detail-background');
const detailFrame = document.getElementById('detail-frame');
const detailIframe = document.getElementById('detail-iframe');
const detailSpinner = document.getElementById('detail-spinner');
const closeButton = document.getElementById('close-button');

const animOpen = [{opacity: 0, transform: 'scale(0.7, 0.7) perspective(400px) rotateX(-5deg)'}, {opacity: 1, transform: 'scale(1, 1) perspective(400px) rotateX(0deg)'}];
const animClose = [{opacity: 1, transform: 'scale(1, 1) perspective(400px) rotateX(0deg)'}, {opacity: 0, transform: 'scale(0.7, 0.7) perspective(400px) rotateX(5deg)'}];

const animFadeOpen = [{opacity: 0}, {opacity: 1}];
const animFadeClose = animFadeOpen.slice().reverse();


const animOptions = {duration: 300, easing: 'ease-in-out', iterations: 1};

detailIframe.addEventListener('load', () => {
    detailSpinner.style.display = 'none';
    detailIframe.style.display = 'inline';
});

function showDetails(src){
    detailBg.style.display = 'inline';
    detailFrame.style.display = 'inline';

    if(!detailIframe.src.includes(src)){
        detailIframe.style.display = 'none';
        detailSpinner.style.display = 'inline';
        detailIframe.src = src;
    }
    closeButton.style.pointerEvents = 'auto';
    detailBg.animate(animFadeOpen, animOptions);
    detailFrame.animate(animOpen, animOptions);
}

function hideDetails(){
    closeButton.style.pointerEvents = 'none';

    detailFrame.animate(animClose, animOptions);
    detailBg.animate(animFadeClose, animOptions);
    setTimeout(() => {
        detailBg.style.display = 'none';
        detailFrame.style.display = 'none';
    }, animOptions.duration-20);
}
