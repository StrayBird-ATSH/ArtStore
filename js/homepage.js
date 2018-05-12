function changeImage() {
    var currentElement = document.getElementsByClassName('slick-current');
    var id = currentElement[0].id;
    switch (id) {
        case 'slick-slide00':
            var newImage = document.getElementById('slick-slide01'),
                newbg = document.getElementById('bg1'),
                oldbg = document.getElementById('bg0');
            break;
        case 'slick-slide01':
            newImage = document.getElementById('slick-slide00');
            newbg = document.getElementById('bg0');
            oldbg = document.getElementById('bg1');
            break;
    }
    newbg.classList.add('is-active');
    oldbg.classList.remove('is-active');
    currentElement[0].style.opacity = "0";
    currentElement[0].style.display = "none";
    currentElement[0].style.left = (currentElement[0].style.left - 1160).toString();
    currentElement[0].classList.remove('slick-current', 'slick-active');
    newImage.classList.add('slick-current', 'slick-active');
    newImage.style.opacity = '1';
    newImage.style.left = (newImage.style.left + 1160).toString();
    newImage.style.display = "block";
    console.log('run')
}

window.onload = function () {
    setInterval("changeImage()", 3000,3000);
};