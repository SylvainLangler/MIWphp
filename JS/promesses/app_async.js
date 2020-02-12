const fichier_achat = "Achat.json";

const fichier_voiture = "Voiture.json";

const fichier_marque = "Marque.json";

function clearInputs(){
    for(let i = 1; i<document.getElementsByTagName('input').length; i++){
        document.getElementsByTagName('input')[i].value = '';
    }
}

async function getAchat(){
    let response = await fetch(fichier_achat)
    let data = await response.json();
    clearInputs();
    for(let i = 0; i< data.length; i++){
        if(data[i]['ref_achat'] == document.getElementById('ref').value){
            document.getElementById('date_achat').value = data[i]['date_achat'];
            document.getElementById('montant_achat').value = data[i]['montant_achat'];
            document.getElementById('reference').value = data[i]['ref_voiture'];
        }
    }
}

async function getVoiture(){
    let response = await fetch(fichier_voiture)
    let data = await response.json();

    for(let i = 0; i< data.length; i++){
        if(data[i]['ref_voiture'] == document.getElementById('reference').value){
            document.getElementById('nom_modele').value = data[i]['nom_modele'];
            document.getElementById('code_marque').value = data[i]['code_marque'];
        }
    }
}

async function getMarque(){
    let response = await fetch(fichier_marque)
    let data = await response.json();

    for(let i = 0; i< data.length; i++){
        if(data[i]['code_marque'] == document.getElementById('code_marque').value){
            document.getElementById('nom_marque').value = data[i]['nom_marque'];
        }
    }
}

function update(){
    getAchat();
    getVoiture();
    getMarque();
}