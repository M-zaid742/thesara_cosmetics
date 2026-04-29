/**
 * Category management scripts
 */

function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('image-preview').style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
        input.nextElementSibling.innerText = input.files[0].name;
    }
}
