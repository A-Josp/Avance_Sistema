function toggleMenu() {
    var menuOptions = document.getElementById('menuOptions');
    menuOptions.classList.toggle('show');
}

document.addEventListener
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('showImageBtn').addEventListener('click', function() {
        console.log('Botón "Mostrar Imagen" clicado'); // Mensaje de depuración
        var imageContainer = document.getElementById('imageContainer');
        var uploadedImage = document.getElementById('uploadedImage');
        var uploadedImageName = uploadedImage.getAttribute('data-image-name');
        if (uploadedImageName) {
            uploadedImage.src = "../uploads/" + uploadedImageName;
            imageContainer.classList.remove('hidden');
        } else {
            alert('No hay imagen para mostrar.');
        }
    });
});

