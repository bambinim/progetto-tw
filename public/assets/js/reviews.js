$('#review-form').submit(function(e) {
    e.preventDefault();
    let formData = new FormData(document.getElementById('review-form'));
    $.ajax({
        url: '/api/reviews/new',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
            bootstrap.Modal.getInstance(document.getElementById('review-modal')).hide();
            let content = $('#alert-container').html();
            content += `
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    La recensione è stata salvata
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            $('#alert-container').html(content);
            $('#review-form')[0].reset();
        },
        error: function(data) {
            bootstrap.Modal.getInstance(document.getElementById('review-modal')).hide();
            let content = $('#alert-container').html();
            content += `
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    C'è stato un errore durante l'invio della recensione. Riprova più tardi
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            $('#alert-container').html(content);
        }
    });
});