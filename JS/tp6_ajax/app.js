function Xhr() {
    let obj = null;
    try { obj = new ActiveXObject("Microsoft.XMLHTTP"); } catch (Error) {
        try { obj = new ActiveXObject("MSXML2.XMLHTTP"); } catch (Error) {
            try { obj = new XMLHttpRequest(); } catch (Error) { alert('Impossible de créer l\'objet XMLHttpRequest') }
        }
    }

    return obj;
}

function ajaxXML_categories() {
    let req = Xhr();
    req.onload = function() {
        if (this.status === 200) {
            afficheCategories(this.responseXML);
            console.log(this.responseXML);
        }
    }

    url = 'getCategories.php';
    req.open("GET", url, true);
    req.send(null);
}

function ajaxJSON_produits() {
    let req = Xhr();
    
    req.onload = function() {
        if (this.status === 200) {
            afficheProduits(JSON.parse(this.responseText));
        }
    }

    url = 'getProduits.php';
    req.open("POST", url, true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send('cat='+document.getElementById('categories').value);
}

function afficheCategories(xml){
    let items = xml.getElementsByTagName('categories');

    // Création du select et ajout au form
    let select = document.createElement('select');
    select.setAttribute('name','categories');
    select.setAttribute('id','categories');
    select.setAttribute('onchange', 'ajaxJSON_produits()');

    document.getElementsByTagName('form')[0].appendChild(select);

    // Ajout de l'option choisir au select
    let optionChoisir = document.createElement('option');
    optionChoisir.setAttribute('value','');

    let optionChoisirTexte = document.createTextNode("Choisir");
    optionChoisir.appendChild(optionChoisirTexte);
    
    select.appendChild(optionChoisir);

    // Double boucle reutilisable pour un certain format de fichier XML
    for(let i = 0; i < items.length; i++){
        for(let j = 0; j < items[i].childNodes.length; j++){

            // Création de l'option
            let option = document.createElement('option');
            option.setAttribute('value', items[i].childNodes[j].childNodes[1].textContent);

            // Texte de l'option
            let optionTexte = document.createTextNode(items[i].childNodes[j].childNodes[2].textContent);
            option.appendChild(optionTexte);

            // Ajout de l'option au select
            select.appendChild(option);
        }
    }
}

function afficheProduits(json){

    // Si il y a déjà un élément ayant pour id produits, qui est normalement un select, on le supprime
    if(document.getElementById('produits')){
        document.getElementsByTagName('form')[0].removeChild(document.getElementById('produits'));
    }

    // Si la catégorie choisie est différente de "choisir"
    if(document.getElementById('categories').value){

        // On créé le select 
        let select = document.createElement('select');
        select.setAttribute('id','produits');
        document.getElementsByTagName('form')[0].appendChild(select);
        
        for(let index in json){

            // On créé l'option
            let option = document.createElement('option');
            option.setAttribute('value',json[index]['nom']);
    
            // Text de l'option
            optionTexte = document.createTextNode(json[index]['nom']);
            option.appendChild(optionTexte);

            // Ajout de l'option au select
            document.getElementById('produits').appendChild(option);
        }
    }
    
}


window.onload = ajaxXML_categories();



/* FONCTIONS POUR LE DEBUT DU TP (RECUPERATION ET AFFICHE DES DONNEES DES FICHIERS SOURCE.XML, .JSON, .TXT)


/* Fonction générique qui va récupérer un fichier .txt
function ajaxHTML() {
    let req = Xhr();

    req.open("GET", "sourceHtml.txt", false);
    req.send(null);

    document.getElementById("resultat1").innerHTML = req.responseText;
}

*/

/* Fonction générique qui va récupérer un fichier XML

function ajaxXML() {
    let req = Xhr();
    req.onreadystatechange = function() {
        if (this.readyState == 4) {
            afficheXML(this.responseXML);
        }
    }

    req.open("GET", "source.xml", true);
    req.send(null);
}

*/


/* Fonction qui affiche dans un tableau les informations d'un XML formé d'une certaine manière (source.xml)

function afficheXML(xml) {
    let items = xml.getElementsByTagName('client');
    let ch = '<table>';
    for (let i = 0; i < items.length; i++) {
        ch += '<tr>';
        for (let j = 0; j < items[i].childNodes.length; j++) {
            if (items[i].getElementsByTagName(items[i].childNodes[j].nodeName)[0]) {
                ch += '<td>' + items[i].getElementsByTagName(items[i].childNodes[j].nodeName)[0].textContent + '</td>';
            }
        }
        ch += '</td>';
    }
    ch += '</table>';

    document.getElementById('resultat2').innerHTML = ch;
}

*/

/* Fonction qui affiche dans un tableau les informations du fichier json source.json

function afficheJSON(json) {
    let ch = '<table>'
    for (let index in json) {
        ch += '<tr>'
        ch += '<td>' + json[index]['nom'] + '</td>';
        ch += '<td>' + json[index]['prenom'] + '</td>';
        ch += '<td>' + json[index]['age'] + ' ans</td>';
        ch += '</tr>';
    }

    ch += '</table>';

    document.getElementById('resultat3').innerHTML = ch;
}

*/


//ajaxHTML();

//ajaxXML();

//ajaxJSON();