//Création d'une fonction qui appliquera l'overlay pour le loader
function setOverlay(){
    $('body').append('<div class="overlay"><img src="../img/ajax-loader.svg" alt="ajax-loader"></div>');
}

//Fonction permettant de supprimer l'overlay appliqué
function removeOverlay(){
    $('.overlay').remove();
}

//Si le formulaire est soumis
$('form').submit(function (e) {

    //Blocage de redirection
    e.preventDefault();

    //Suppression des éventuels messages d'erreurs
    $('form').find('div[role=alert]').remove();

    //Variable pointant sur le champs du formulaire
    let memberName = $('#add_members_name');

    //requête Ajax
    $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        dataType: 'json',
        data: $(this).serialize(),
        success: function (data){
            if(data.searchName){

            }
        }

        beforeSend: function () {
            setOverlay();
        },
        complete: function () {
            removeOverlay();
        }

    });
});