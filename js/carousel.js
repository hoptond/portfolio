var activeImageIndex = 0
var carouselImagesCount = document.querySelectorAll('.carouselrow img').length
var imageWidth = 900

document.getElementById('carouselnext').addEventListener('click', function (e) {
    slide(1)
})

document.getElementById('carouselprev').addEventListener('click', function (e) {
    slide(-1)
})

function slide(dir) {
    let images = document.querySelectorAll('.carouselrow img')
    images[activeImageIndex].classList.remove('active')
    images[activeImageIndex].classList.remove('inactive')
    let lastImageIndex = activeImageIndex
    activeImageIndex += dir
    if (activeImageIndex === -1) {
        activeImageIndex = carouselImagesCount - 1
    } else if (activeImageIndex === carouselImagesCount) {
        activeImageIndex = 0
    }
    clearAnimations(images[lastImageIndex])
    clearAnimations(images[activeImageIndex])
    if(images[activeImageIndex].classList.contains('inactive')) {
        images[activeImageIndex].classList.remove('inactive')
    }
    if(dir === 1) {
        images[lastImageIndex].classList.add('offscreenleft')
        images[activeImageIndex].classList.add('onscreenright')
    } else if(dir === -1) {
        images[lastImageIndex].classList.add('offscreenright')
        images[activeImageIndex].classList.add('onscreenleft')
    }
}

function clearAnimations(image) {
    image.classList.remove('offscreenleft', 'offscreenright', 'onscreenleft', 'onscreenright')

}

function sizeCarousel() {

    let width = window.innerWidth
    let carousel = document.getElementById('carousel')
    if(width < imageWidth) {
        carousel.style.width = width + 'px'
    } else {
        carousel.style.width = imageWidth + 'px'
    }
    carousel.style.height = (parseFloat(getComputedStyle(carousel).width) * 0.75) + 'px'
}

sizeCarousel()
window.addEventListener('resize', sizeCarousel)