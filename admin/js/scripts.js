$(document).ready(function () {
    ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );
/*text area widget*/

    $('#selectAllBoxes').click(function (event) {
        if(this.checked){
           $('.checkBoxes').each(function () {
               this.checked = true;

           });
        }else{
            $('.checkBoxes').each(function () {
                this.checked = false;

            });
        }


    });




});


