/*let slideIndex = 1; 

document.addEventListener("DOMContentLoaded", () => {
    showSlides(slideIndex); 
    updateSelectedImage();

});

function plusSlides(n) {
    //console.log("ok");
    showSlides(slideIndex += n);
    updateSelectedImage();
}

function currentSlide(n) {
    showSlides(slideIndex = n);
    updateSelectedImage();
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    //console.log(slides);
    if (n > slides.length) {slideIndex = 1}    
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
    }
    slides[slideIndex-1].style.display = "block";  
}

function updateSelectedImage() {
    const slides = document.getElementsByClassName("mySlides");
    const currentImage = slides[slideIndex - 1].querySelector("img").src;

    const imageName = currentImage.substring(currentImage.lastIndexOf("/") + 1);

    document.getElementById("image").value = imageName;
    //console.log(imageName);
}*/