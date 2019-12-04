function Xhr() {
    let obj = null;
    try { obj = new ActiveXObject("Microsoft.XMLHTTP"); } catch (Error) {
        try { obj = new ActiveXObject("MSXML2.XMLHTTP"); } catch (Error) {
            try { obj = new XMLHttpRequest(); } catch (Error) { alert('Impossible de créer l\'objet XMLHttpRequest') }
        }
    }

    return obj;
}

// Fonction ajax qui récupère les villes en passant en paramètre l'input dont on va récupérer la value

function ajaxJSON_villes(input) {
    let req = Xhr();
    
    req.onload = function() {
        if (this.status === 200) {
            afficheVilles(JSON.parse(this.responseText));
        }
    }

    url = 'getVilles.php';
    req.open("POST", url, true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send('debut='+input.value);
}

// Affiche les villes dans la datalist
function afficheVilles(json){

    // Si la datalist est déjà présente, on la supprime pour en créer une nouvelle
    if(document.getElementById('villes')){
        document.getElementsByTagName('main')[0].removeChild(document.getElementById('villes'));
    }

    let datalist = document.createElement('datalist');
    datalist.setAttribute('id','villes');
    

    for(let index in json){

        // On créé l'option
        let option = document.createElement('option');
        option.setAttribute('value',json[index]['nom']);

        datalist.appendChild(option);
    }

    document.getElementsByTagName('main')[0].appendChild(datalist);

}