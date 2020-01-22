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
    
    $get(fichier_achat) // appel de chargeFichier qui retourne une promesse
        .then((response) => {
            console.info(`Fichier ${fichier_achat} chargé !`);
            //console.log(response.responseText);
            let data = JSON.parse(response.responseText);
            clearInputs();
            for(let i = 0; i< data.length; i++){

                // SI LA REFERENCE EXISTE

                if(data[i]['ref_achat'] == document.getElementById('ref').value){
                    document.getElementById('date_achat').value = data[i]['date_achat'];
                    document.getElementById('montant_achat').value = data[i]['montant_achat'];
                    document.getElementById('reference').value = data[i]['ref_voiture'];
                    
                    
                    // CHARGEMENT DU DEUXIEME FICHIER: VOITURE.JSON

                    $get(fichier_voiture) // appel de chargeFichier qui retourne une promesse
                    .then((response) => {
                        console.info(`Fichier ${fichier_voiture} chargé !`);
                        //console.log(response.responseText);
                        let data = JSON.parse(response.responseText);
                        for(let i = 0; i< data.length; i++){
                            if(data[i]['ref_voiture'] == document.getElementById('reference').value){
                                document.getElementById('nom_modele').value = data[i]['nom_modele'];
                                document.getElementById('code_marque').value = data[i]['code_marque'];
                                
                                // CHARGEMENT DU TROISIEME FICHIER: VOITURE.JSON

                                $get(fichier_marque) // appel de chargeFichier qui retourne une promesse
                                .then((response) => {
                                    console.info(`Fichier ${fichier_marque} chargé !`);
                                    //console.log(response.responseText);
                                    let data = JSON.parse(response.responseText);
                                    for(let i = 0; i< data.length; i++){
                                        if(data[i]['code_marque'] == document.getElementById('code_marque').value){
                                            document.getElementById('nom_marque').value = data[i]['nom_marque'];
                                        }
                                    }
                                    console.log("Etat de la requete " + response.status);
                                })
                                .catch((response) => { console.log(`fichier ${fichier_marque} non trouvé`);
                                    console.log (response.status);
                                })
                            }
                        }
                        console.log("Etat de la requete " + response.status);

                    })
                    .catch((response) => { console.log(`fichier ${fichier_voiture} non trouvé`);
                        console.log (response.status);
                    })
                }
            }
            console.log("Etat de la requete " + response.status);

        })
        .catch((response) => { console.log(`fichier ${fichier_achat} non trouvé`);
            console.log (response.status);
        })

}