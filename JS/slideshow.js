const NSLIDE = 3;
const track = document.querySelector('.carosello-track');
const items = Array.from(track.children);
const prevButton = document.getElementById("prev");
const nextButton = document.getElementById("next");
let index = 0;

prevButton.addEventListener('click', () => {
    index = (index -1)%NSLIDE;
    setImg();
});

nextButton.addEventListener('click', () => {
    index = (index +1)%NSLIDE;
    setImg();
});



function setImg(){
    const itemWidth = items[index].getBoundingClientRect().width;
    track.style.transform = `translateX(-${index * itemWidth}px)`;
}