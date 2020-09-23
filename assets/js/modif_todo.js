
// var selectCatego = document.querySelector('#modif_todo_Categorie');
// var valeurPrecedente = selectCatego.options[selectCatego.selectedIndex].value
// var champsModif = ['modif_todo_BN_Label', 'modif_todo_Label', 'modif_todo_CIS', 'modif_todo_ATC7'];
var champsModif = ['modif_todo_Label', 'modif_todo_CIS', 'modif_todo_ATC7'];

$(document).ready(function() {
    // On récupère la valeur avant modif du select sur la catégorie
    $('#modif_todo_Categorie').on( "focus", function() {
        valeurPrecedente = this.value;
    });

    $('#modif_todo_Categorie').on( "change", function() {
        var valeurSelectionnee = this.value;
        // console.log ("Valeur précédente : " + valeurPrecedente)
        // console.log ("Valeur actuelle : " + valeurSelectionnee)
        if (valeurSelectionnee != 1 && valeurPrecedente == 1) {
            var confirmation = window.confirm ('Attention, si vous sélectionnez une catégorie différente de \'médicament\', les champs renseignés plus bas (BN Label, Label ...) seront effacés.\nVoulez-vous sélectionner une autre catégorie ?')
            if (confirmation === false) {
                // mettre le select a 1
                $('#modif_todo_Categorie').val(1);
                $.each(champsModif, function(index, value){
                    $("#"+ value).prop('readonly', false);
                });
            } else {
                // effacer le contenu des champs : #modif_todo_BN_Label, #modif_todo_Label, #modif_todo_CIS et #modif_todo_ATC7
                // mettre en readonly les champs : #modif_todo_BN_Label, #modif_todo_Label, #modif_todo_CIS et #modif_todo_ATC7
                $.each(champsModif, function(index, value){
                    $("#"+ value).val("");
                    $("#"+ value).prop('readonly', true);
                });
            }
        } else if (valeurSelectionnee = 1) {
            $.each(champsModif, function(index, value){ 
                $("#"+ value).prop('readonly', false);
            });
        }
        valeurPrecedente = valeurSelectionnee
    });
}); 
