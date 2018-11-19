var activeProjectIndex = 0
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
    images[activeProjectIndex].classList.remove('active')
    images[activeProjectIndex].classList.remove('inactive')
    let lastImageIndex = activeProjectIndex
    activeProjectIndex += dir
    if (activeProjectIndex === -1) {
        activeProjectIndex = carouselImagesCount - 1
    } else if (activeProjectIndex === carouselImagesCount) {
        activeProjectIndex = 0
    }
    clearAnimations(images[lastImageIndex])
    clearAnimations(images[activeProjectIndex])
    switchProjectLink(activeProjectIndex, true)
    switchProjectLink(lastImageIndex, false)
    fadeText(activeProjectIndex, true)
    fadeText(lastImageIndex, false)
    if(images[activeProjectIndex].classList.contains('inactive')) {
        images[activeProjectIndex].classList.remove('inactive')
    }
    if(dir === 1) {
        images[lastImageIndex].classList.add('offscreenleft')
        images[activeProjectIndex].classList.add('onscreenright')
    } else if(dir === -1) {
        images[lastImageIndex].classList.add('offscreenright')
        images[activeProjectIndex].classList.add('onscreenleft')
    }
}

function clearAnimations(image) {
    image.classList.remove('offscreenleft', 'offscreenright', 'onscreenleft', 'onscreenright')

}

function fadeText(textID, fadeIn) {
    let showcaseText = document.querySelectorAll('.showcasetext')[textID]
    showcaseText.classList.remove('textfadein', 'textfadeout', 'hidden')
    switch (fadeIn) {
        case true:
            showcaseText.classList.add('textfadein');
            break;
        case false:
            showcaseText.classList.add('hidden');
            break;
    }
}

function switchProjectLink(projectID, visible) {
    let projectLink = document.querySelectorAll('.showcasebottom')[projectID]
    switch (visible) {
        case true:
            projectLink.classList.remove('hidden');
            break;
        case false:
            projectLink.classList.add('hidden');
            break;
    }
}