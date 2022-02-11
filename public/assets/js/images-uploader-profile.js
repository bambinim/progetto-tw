$(document).ready(function() {
    let mainContainer = $('#images-uploader')[0];
    let fileInput = $('#images-uploader > input[type="file"]')[0];
    let imagesList = $('#images-uploader > ul')[0];
    $(fileInput).change(function() {
        let selectedFile = $(fileInput).prop('files')[0];
        if (selectedFile != undefined) {
            let formData = new FormData();
            formData.append('image', selectedFile);
            $.ajax({
                url: '/api/images/upload',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    $(imagesList).html(function(index, origHtml) {
                        return createImageListElement(data.imageId);
                    });
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }
    });
});

function createImageListElement(imageId) {
    $(`#uploaded-image-profile`).remove();
    return `
        <li id="uploaded-image-${imageId}" class="position-relative m-2">
            <input name="images[]" value="${imageId}" class="d-none">
            <img src="/images/get?id=${imageId}" class="image-preview">
            <button type="button" class="btn btn-link shadow-none position-absolute top-0 start-100 translate-middle"
                aria-label="elimina immagine" onclick="removeUploadedImage(${imageId})">
                <span class="fas fa-times"></span>
            </button>
        </li>
    `;
}

function removeUploadedImage(imageId) {
    let formData = new FormData();
    formData.append('id', imageId);
    $.ajax({
        url: '/api/images/delete',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false
    });
    $(`#uploaded-image-${imageId}`).remove();
}