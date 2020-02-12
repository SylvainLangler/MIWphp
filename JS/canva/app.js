var c = document.getElementById("canva");
var ctx = c.getContext("2d");

for(let i = 10; i <=510; i+=100){
    ctx.beginPath(); // Début du chemin
    ctx.moveTo(i,10);
    ctx.lineTo(i,510);
    ctx.closePath();
    ctx.stroke();
}

for(let i = 10; i <=510; i+=100){
    ctx.beginPath(); // Début du chemin
    ctx.moveTo(10,i);
    ctx.lineTo(510,i);
    ctx.closePath();
    ctx.stroke();
}

let toPlay = 1;

c.onclick = (e) =>{
    let coordX = Math.floor(e.clientX/100)
    let coordY = Math.floor(e.clientY/100)
    drawSomething(coordX, coordY);
}

function drawSomething(x,y){

    let coordX = (x*100)+10;
    let coordY = (y*100)+10;
    let centerX = coordX + 50;
    let centerY = coordY + 50;

    if(toPlay === 1){
        toPlay = 2;
        ctx.beginPath();
        ctx.arc(centerX, centerY, 40, 0, Math.PI * 2, true);
        ctx.strokeStyle = 'green';
        ctx.lineWidth = 10;
        ctx.stroke();
    }
    else{
        ctx.strokeStyle = 'red';
        ctx.fillStyle = 'red';
        toPlay = 1;
        ctx.fillRect(coordX,coordY,100,100);
    }

    
   
}
