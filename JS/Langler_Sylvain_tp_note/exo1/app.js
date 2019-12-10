function Xhr() {
    let obj = null;
    try { obj = new ActiveXObject("Microsoft.XMLHTTP"); } catch (Error) {
        try { obj = new ActiveXObject("MSXML2.XMLHTTP"); } catch (Error) {
            try { obj = new XMLHttpRequest(); } catch (Error) { alert('Impossible de créer l\'objet XMLHttpRequest') }
        }
    }

    return obj;
}

function ajaxHTML() {
    let req = Xhr();

    document.getElementById('info').innerHTML = "chargement des livres en cours";

    req.open("GET", "biblio.xml", false);

    req.send(null);

    if(req.responseXML){

        document.getElementById('info').innerHTML = "";

        return req.responseXML;

    }

}

// Affiche les livres du fichier XML, en fonction de si dispo est true ou false, entre min et max 
function affiche(xml, dispo, min, max){
    let items = xml.getElementsByTagName('livre');
    let table = document.createElement('table');
    table.setAttribute('style','margin-top:30px; text-align:center')
    let tr_head = document.createElement('tr');

    let th_titre = document.createElement('th');
    th_titre.setAttribute('style','width: 150px;');
    let th_titre_texte = document.createTextNode('Titre');
    th_titre.appendChild(th_titre_texte);

    let th_auteur = document.createElement('th');
    th_auteur.setAttribute('style','width: 150px;');
    let th_auteur_texte = document.createTextNode('Auteur');
    th_auteur.appendChild(th_auteur_texte);

    let th_genre = document.createElement('th');
    th_genre.setAttribute('style','width: 150px;');
    let th_genre_texte = document.createTextNode('Genre');
    th_genre.appendChild(th_genre_texte);

    let th_editeur = document.createElement('th');
    th_editeur.setAttribute('style','width: 150px;');
    let th_editeur_texte = document.createTextNode('Editeur');
    th_editeur.appendChild(th_editeur_texte);

    let th_disponibilite = document.createElement('th');
    th_disponibilite.setAttribute('style','width: 150px;');
    let th_disponibilite_texte = document.createTextNode('Disponibilité');
    th_disponibilite.appendChild(th_disponibilite_texte);

    tr_head.appendChild(th_titre);
    tr_head.appendChild(th_auteur);
    tr_head.appendChild(th_genre);
    tr_head.appendChild(th_editeur);
    tr_head.appendChild(th_disponibilite);

    table.appendChild(tr_head);
    
    // Création de 2 tableaux 
    // tab_dispo va recevoir tous les livres qui sont disponibles
    let tab_dispo = [];
    // tab_not_dispo 
    let tab_not_dispo = [];

    // On remplit les tableaux
    for(let i = 0; i < items.length; i++){

        if(items[i].getElementsByTagName('disponible')[0].textContent == "oui"){
             
            tab_dispo.push(items[i]);

        }

        if(items[i].getElementsByTagName('disponible')[0].textContent == "non"){

            tab_not_dispo.push(items[i]);
        }

    }

    // On affiche ou cache le bouton suivant 
    if(max == Math.ceil(tab_dispo.length/10)*10){
        document.getElementById('right').style.display = 'none';
    }
    else{
        document.getElementById('right').style.display = 'initial';
    }

    // Si max est inférieur à la taille du tableau, max reçoit la taille du tableau
    if(dispo && tab_dispo.length < max){
        max = tab_dispo.length;
    }
    
    if(!dispo && tab_not_dispo.length < max){
        max = tab_not_dispo.length;
    }

    // Affichage des livres
    if(dispo){
        for(let i = min; i < max; i++){
            let ligne = document.createElement('tr');

            for(let j = 0; j < tab_dispo[i].childNodes.length; j++){
                if(tab_dispo[i].childNodes[j].nodeName != "#text"){
                    let td = document.createElement('td');
                    let td_texte = document.createTextNode(tab_dispo[i].childNodes[j].textContent);
                    td.appendChild(td_texte);
                    ligne.appendChild(td);
                }
            }
            table.appendChild(ligne);
        }
    }
    else{
        for(let i = min; i < max; i++){
            
            let ligne = document.createElement('tr');

            for(let j = 0; j < tab_not_dispo[i].childNodes.length; j++){
                if(tab_not_dispo[i].childNodes[j].nodeName != "#text"){
                    let td = document.createElement('td');
                    let td_texte = document.createTextNode(tab_not_dispo[i].childNodes[j].textContent);
                    td.appendChild(td_texte);
                    ligne.appendChild(td);
                }
            }
            table.appendChild(ligne);
        }
    }
    testDisplayPreviousImage();
    document.getElementById('biblio').appendChild(table);
}

let dispo = true;

// à chaque fois que l'input est modifié, on récupère sa valeur et on affiche les livres en conséquence
function verifInput(){
    if(document.getElementById('dispo').checked){
        document.getElementById('biblio').removeChild(document.getElementsByTagName('table')[0]);
        dispo = true;
        max = 10;
        min = 0;
        affiche(xml, dispo, min, max);
        
    }
    else{
        document.getElementById('biblio').removeChild(document.getElementsByTagName('table')[0]);
        dispo = false;
        max = 10;
        min = 0;
        affiche(xml, dispo, min, max);
    }
}

// Fonction appelée sur le bouton next
function next(){
    document.getElementById('biblio').removeChild(document.getElementsByTagName('table')[0]);
    affiche(xml, dispo, min+=10, max+=10);
}

// Fonction appelée sur le bouton prev
function previous(){
    if(min-=10 < 0){
        document.getElementById('biblio').removeChild(document.getElementsByTagName('table')[0]);
        affiche(xml, dispo, min-=10, max-=10);
    }
}

// Test si on doit afficher ou pas le bouton previous
function testDisplayPreviousImage(){
    if(min <= 0){
        document.getElementById('left').style.display = 'none';
    }
    else{
        document.getElementById('left').style.display = 'initial';
    }
}

let min = 0;

let max = 10;

testDisplayPreviousImage();

let xml = ajaxHTML();

affiche(xml, true, min, max);