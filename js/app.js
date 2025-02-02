document.addEventListener('DOMContentLoaded', () => {
    let nextDom = document.getElementById('next');
    let prevDom = document.getElementById('prev');
    let carouselDom = document.querySelector('.carousel');
    let SliderDom = carouselDom.querySelector('.list');
    let thumbnailBorderDom = document.querySelector('.thumbnail');
    let timeDom = document.querySelector('.time');

    let timeRunning = 4000; // 4 seconds for each image
    let timeAutoNext = 4000; // 4 seconds for each image

    nextDom.onclick = function(){
        showSlider('next');    
    }

    prevDom.onclick = function(){
        showSlider('prev');    
    }

    let runTimeOut;
    let runNextAuto = setTimeout(() => {
        nextDom.click();
    }, timeAutoNext);

    function showSlider(type){
        let SliderItemsDom = SliderDom.querySelectorAll('.item');
        let activeItem = SliderDom.querySelector('.item.active');
        let newIndex;

        if(type === 'next'){
            newIndex = (Array.from(SliderItemsDom).indexOf(activeItem) + 1) % SliderItemsDom.length;
        } else {
            newIndex = (Array.from(SliderItemsDom).indexOf(activeItem) - 1 + SliderItemsDom.length) % SliderItemsDom.length;
        }

        activeItem.classList.remove('active');
        SliderItemsDom[newIndex].classList.add('active');

        clearTimeout(runTimeOut);
        runTimeOut = setTimeout(() => {
            carouselDom.classList.remove('next');
            carouselDom.classList.remove('prev');
        }, timeRunning);

        clearTimeout(runNextAuto);
        runNextAuto = setTimeout(() => {
            nextDom.click();
        }, timeAutoNext);
    }

    // Initialize the first item as active
    SliderDom.querySelector('.item').classList.add('active');
});