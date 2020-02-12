const fichier_achat = "Achat.json";

const fichier_voiture = "Voiture.json";

const fichier_marque = "Marque.json";

function clearInputs(){
    for(let i = 1; i<document.getElementsByTagName('input').length; i++){
        document.getElementsByTagName('input')[i].value = '';
    }
}

function update(){

    // CHARGEMENT DU PREMIER FICHIER: ACHAT.JSON
    fetch(fichier_achat)
    .then((response) =>{
        response.text()
        .then((text)=>{
            let data = JSON.parse(text);
            clearInputs();
            for(let i = 0; i< data.length; i++){

                // SI LA REFERENCE EXISTE

                if(data[i]['ref_achat'] == document.getElementById('ref').value){
                    document.getElementById('date_achat').value = data[i]['date_achat'];
                    document.getElementById('montant_achat').value = data[i]['montant_achat'];
                    document.getElementById('reference').value = data[i]['ref_voiture'];
                    
                    
                    // CHARGEMENT DU DEUXIEME FICHIER: VOITURE.JSON
                    fetch(fichier_voiture)
                    .then((response) =>{
                        response.text()
                        .then((text)=>{
                            let data = JSON.parse(text);
                            for(let i = 0; i< data.length; i++){
                                if(data[i]['ref_voiture'] == document.getElementById('reference').value){
                                    document.getElementById('nom_modele').value = data[i]['nom_modele'];
                                    document.getElementById('code_marque').value = data[i]['code_marque'];

                                    // CHARGEMENT DU TROISIEME FICHIER: MARQUE/JSON

                                    fetch(fichier_marque)
                                    .then((response) =>{
                                        response.text()
                                        .then((text)=>{
                                            let data = JSON.parse(text);
                                            for(let i = 0; i< data.length; i++){
                                                if(data[i]['code_marque'] == document.getElementById('code_marque').value){
                                                    document.getElementById('nom_marque').value = data[i]['nom_marque'];
                                                }
                                            }
                                        })
                                    })
                                    .catch((err) => {
                                        console.log(err);
                                    })
                                }
                            }
                        })
                    })
                    .catch((err) => {
                        console.log(err);
                    })
                }
            }
        });
    })
    .catch((err) => {
        console.log(err);
    })
}