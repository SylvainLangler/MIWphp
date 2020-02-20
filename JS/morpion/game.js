export class Game{
    constructor(board){
        // Plateau de jeu
        this.board = board;

        // Joueur a qui c'est le tour de jouer
        this.toPlay = 1;

        // Nombre de tours joués
        this.nbMoves = 0;

        // Localstorage
        this.store = window.localStorage;

        // Si il y a une partie en cours, on la reprend (effectué dans getLastGame()),
        // sinon on génère la map (des tableaux représentant les cases du jeu)
        if(!this.getLastGame()){
            this.map = this.generateBoardMap();
        }        

        // Création du bouton pour reinitialiser la partie
        this.createResetButton();
    }

    start = () => {
        // Pour chaque clic sur le board
        this.board.canva.onclick = (e) =>{
            let coordX = Math.floor((e.clientX-20)/100)
            let coordY = Math.floor((e.clientY-20)/100)
            // Si la case est vide
            if(this.map[coordY][coordX] == 0){
                // On joue le coup 
                this.play(coordX, coordY);
                // S'il y a un gagnant après ce coup
                let winner = this.winner();
                if(winner != null){
                    // On finit la partie en affichant le gagnant
                    this.endGame(winner);
                }
            }
        }
    }

    endGame(winner){
        let winnerText = '';
        switch (winner) {
            case 0:
                winnerText = 'Egalité';
                break;
            case 1:
                winnerText = 'Les croix gagnent';
                break;
            case -1:
                winnerText = 'Les ronds gagnent';
                break;
        }
        this.resultTextNode = document.createTextNode(winnerText);
        document.getElementById('result').appendChild(this.resultTextNode);

        // On empêche les événements au clic sur le board quand la partie est finie
        this.board.canva.onclick = (e) =>{
            e.stopPropagation();
        }
    }

    createResetButton(){
        this.resetButton = document.createElement('button');
        this.resetButton.appendChild(document.createTextNode('Reinitialiser'));
        document.getElementsByClassName('board')[0].appendChild(this.resetButton);
        this.resetButton.onclick = () => {
            this.resetGame();
        }
        
    }

    resetGame(){
        // On génère la map
        this.map = this.generateBoardMap();

        // On store la map
        this.store.setItem('map', JSON.stringify(this.map));

        // On re déssine le board
        this.board.drawBoard();

        // Reinitialise le nombre de coups à 0
        this.nbMoves = 0;

        // S'il y a eu une fin de partie et donc un gagnant affiché, on le supprime
        if(document.getElementById('result').textContent != ""){
            document.getElementById('result').removeChild(this.resultTextNode);
        }

        // On recommence la partie
        this.start();
        
    }

    
    storeGame(){
        this.store.setItem('map', JSON.stringify(this.map));
    }

    play(x,y){

        if(this.toPlay === 1){
            // On dessine le cercle
            this.drawCircle(x,y);

            // On note sur la map qu'une action a été effectuée à cet endroit sur le board
            this.map[y][x] = -1;

            // Au joueur 2 de jouer
            this.toPlay = 2;
        }
        else{
            this.drawCross(x,y);

            this.map[y][x] = 1;

            this.toPlay = 1;
        }
        
        // On augmente le nombre de coups joués
        this.nbMoves++;
    
        // On garde la partie en mémoire
        this.storeGame();
    }

    winner(){
        // Ce code a été repris du projet d'Anthony Buisson
        // Cette fonction retourne -1 si les ronds ont gagné, 1 si les croix ont gagné, et 0 si il y a égalité
        let len = this.map.length-1;
        for (let i = 0; i <= len; i++) {
            for (let j = 0; j < 2; j++) {
                /*Verification des lignes et colonnes*/
                if ((this.map[i][j] + this.map[i][1 + j] + this.map[i][2 + j] + this.map[i][3 + j] === 4) ||
                    (this.map[j][i] + this.map[1 + j][i] + this.map[2 + j][i] + this.map[3 + j][i]) === 4)
                    return 1;
                if ((this.map[i][j] + this.map[i][1 + j] + this.map[i][2 + j] + this.map[i][3 + j] === -4) ||
                    (this.map[j][i] + this.map[1 + j][i] + this.map[2 + j][i] + this.map[3 + j][i]) === -4)
                    return -1;
                /*Verification des diagonales*/
                if (i < 2) {
                    let diagHGBD = this.map[i][j] + this.map[i + 1][j + 1] + this.map[i + 2][j + 2] + this.map[i + 3][j + 3];
                    let diagBDHG = this.map[j][i] + this.map[j + 1][i + 1] + this.map[j + 2][i + 2] + this.map[j + 3][i + 3];
                    let diagHDBG = this.map[i][len - j] + this.map[i + 1][len - j - 1] + this.map[i + 2][len - j - 2] + this.map[i + 3][len - j - 3];
                    let diagBGHD = this.map[len - j][len - i] + this.map[len - j - 1][len - i - 1] + this.map[len - j - 2][len - i - 2] + this.map[len - j - 3][len - i - 3];
                    if ((diagHGBD === 4) || (diagBDHG === 4) || (diagHDBG === 4) || (diagBGHD === 4))
                        return 1;
                    if ((diagHGBD === -4) || (diagBDHG === -4) || (diagHDBG === -4) || (diagBGHD === -4))
                        return -1;
                }
            }
        }
        /*Aucun gagnant, on teste l'égalité*/
        return this.nbMoves === 25 ? 0 : null;
    }

    generateBoardMap(){
        // Créé une matrice 
        /*
            [0, 0, 0, 0, 0]
            [0, 0, 0, 0, 0]
            [0, 0, 0, 0, 0]
            [0, 0, 0, 0, 0]
            [0, 0, 0, 0, 0]
        */
        let tab = [];
        for(let i = 0; i < 5; i++){
            tab[i] = [0,0,0,0,0];
        }
        return tab;
    }

    getLastGame(){
        
        let lastGameMap = JSON.parse(this.store.getItem('map'));
        if(!lastGameMap){
            return false;
        }
        this.map = lastGameMap;
        for(let i = 0; i < this.map.length; i++){
            for(let j = 0; j < this.map[i].length; j++){
                if(this.map[i][j] == 1){
                    this.drawCross(j,i);
                }
                if(this.map[i][j] == -1){
                    this.drawCircle(j,i);
                }
            }
        }
        return true;
    }

    drawCircle(x,y){
        let coordX = (x*100)+60;
        let coordY = (y*100)+60;

        this.board.ctx.beginPath();

        this.board.ctx.arc(coordX, coordY, 35, 0, Math.PI * 2, true);
        this.board.ctx.strokeStyle = 'green';
        this.board.ctx.lineWidth = 10;

        this.board.ctx.stroke();
        this.board.ctx.closePath();
    }

    drawCross(x,y){

        let coordX = (x*100)+10;
        let coordY = (y*100)+10;

        this.board.ctx.beginPath();

        this.board.ctx.moveTo(coordX+20, coordY+20);
        this.board.ctx.lineTo(coordX+80, coordY+80);
        this.board.ctx.moveTo(coordX+80, coordY+20);
        this.board.ctx.lineTo(coordX+20, coordY+80);
        this.board.ctx.lineWidth = 10;
        this.board.ctx.strokeStyle = 'red';

        this.board.ctx.stroke();
        this.board.ctx.closePath();
    }

}