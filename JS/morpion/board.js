export class Board{
    constructor(){
        this.boardWidth = 510;
        // dans l'idée il faudrait pouvoir créer plusieurs boards et donc plusieurs canvas
        this.canva = document.getElementById("canva");
        this.ctx = canva.getContext("2d");
    }

    drawBoard = () =>{

        this.ctx.clearRect(0,0, this.boardWidth, this.boardWidth);
        this.ctx.lineWidth = 2;
        this.ctx.strokeStyle = 'blue';
        
        for(let i = 10; i <=this.boardWidth; i+=100){
            this.ctx.beginPath(); // Début du chemin
            this.ctx.moveTo(i,10);
            this.ctx.lineTo(i,this.boardWidth);
            this.ctx.closePath();
            this.ctx.stroke();
            
        }

        for(let i = 10; i <=this.boardWidth; i+=100){
            this.ctx.beginPath(); // Début du chemin
            this.ctx.moveTo(10,i);
            this.ctx.lineTo(this.boardWidth,i);
            this.ctx.closePath();
            this.ctx.stroke();
        }
    }
}