//CSS
require('../css/app.css');

//images
const imagesContext = require.context('../img', true, /\.(png|jpg|jpeg|gif|ico|svg|webp)$/);
imagesContext.keys().forEach(imagesContext);

//Bootstrap
require('bootstrap');

//jQuery
const $ = require('jquery');
global.$ = global.jQuery = $; //global $ and jQuery variables

//AJOUT PANIER
window.addPanier = function(id){

    //Nb article avant modif
    var oldValue = parseInt($('#compteur').html());

    //Requete ajout
    $.ajax({
        url : window.location.origin+'/addpanier/'+id,
        type : "POST",
        data : {
            quantite : $('#selectQte').val()
        },
        
        success : function(){
            //Mise à jour nombre articles dans panier
            $('#compteur').html(parseInt($('#selectQte').val()) + oldValue); 
        },
        
        error : function(){
            console.log("erreur");
        }
    });
}

//UPDATE ARTICLE (id produit,nouvelle quantité)
window.updateArticle = function(id,qte){

    //Requete mise à jour
    $.ajax({
        url : window.location.origin+'/update',
        type : "POST",
        data : {
            id : id,
            quantite : qte
        },
        
        success : function(){
            //Calcul nouveau montant article
            $('#total'+id).html((parseFloat($('#prix'+id).html()) * qte).toFixed(2)+' €');
            
            refresh();
        },
        
        error : function(){
            console.log("erreur");
        }
    });
}

//SUPPRIMERE ARTICLE (id produit)
window.deleteArticle = function(id){

    //Requete
    $.ajax({
        url : window.location.origin+'/remove/'+id,
        type : "GET",
        
        success : function(){
            //Suppression ligne
            $('#line'+id).remove();
            refresh();
        },
        
        error : function(){
            console.log("erreur");
        }
    });
}

//Mise à jour des elements du panier
function refresh(){
    //Calcul nouveau total panier
    var tot = 0;
    $(".panierPrix").each(function() {
        tot = tot + parseFloat($(this).html());
    });
    $('#totalPanier').html(tot.toFixed(2)+' €');
    
    //Mise à jour nombre articles panier
    nbArticles = 0;
    $(".panierQte").each(function() {
        nbArticles = nbArticles + parseInt($(this).val());
    });
    $('#compteur').html(nbArticles);
}

//ECOUTE CHANGEMENT VALEUR PANIER
$(".panierQte").change(function() {
    updateArticle($(this).attr('id'),$(this).val())
  });
