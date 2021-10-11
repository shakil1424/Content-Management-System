$(document).ready(function () {
    ClassicEditor
        .create( document.querySelector( '#commentBody' ) )
        .catch( error => {
            console.error( error );
        } );
});


