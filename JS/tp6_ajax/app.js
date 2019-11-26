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

    req.open("GET", "sourceHtml.txt", false);
    req.send(null);

    document.getElementById("resultat1").innerHTML = req.responseText;
}

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















// OK
function ajaxXML_categories() {
    let req = Xhr();
    req.onload = function() {
        if (this.status === 200) {
            afficheCategories(this.responseXML);
        }
    }

    url = 'getCategories.php';
    req.open("GET", url, true);
    req.send(null);
}

function ajaxJSON_produits() {
    let req = Xhr();
    
    req.onreadystatechange = function() {
        if (this.readyState == 4 && this.status === 200) {
            afficheProduits(JSON.parse(this.responseText));
            console.log(this.responseText);
        }
    }

    url = 'getProduits.php';
    req.open("POST", url, true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    // console.log(document.getElementById('categories').value);
    req.send('cat='+document.getElementById('categories').value);
}



// OK
function afficheCategories(xml){
    let items = xml.getElementsByTagName('categories');
    let ch = '<option value="">Choisir</option>';
    for(let i = 0; i < items.length; i++){
        for(let j = 0; j < items[i].childNodes.length; j++){
            ch += '<option value="'+items[i].childNodes[j].childNodes[1].textContent+'">'+items[i].childNodes[j].childNodes[2].textContent+'</option>';
        }
    }
    document.getElementById('categories').innerHTML = ch;
}

function afficheProduits(json){
    // let select = document.createElement('select');

    /*let ch = '';
    for(let index in json){
        ch += '<option value="'+json[index]['codeCat']+'">'+json[index]['nom']+'</option>';
        console.log(json[index]['nom']);
    }
    document.getElementById('categories').innerHTML = ch;*/
    
}

ajaxXML_categories();

//ajaxHTML();

//ajaxXML();

//ajaxJSON();