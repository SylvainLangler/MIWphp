<!DOCTYPE html>
<html lang='FR'>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body>
    <main>
        <div id="info"></div>
        <div id="biblio">
            <input type="radio" id="dispo" name="cat" value="1" oninput="verifInput()" checked>
            <label for="dispo">Livres disponibles</label>
            <input type="radio" id="indispo" name="cat" value="0" oninput="verifInput()">
            <label for="indispo">Livres non disponibles</label>
        </div>
        <div class="nav">
            <img src="fleche.png" id="left" onclick='previous()'>
            <img src="fleche.png" id="right" onclick='next()'>
        </div>
    </main>
</body>
<script src="app.js"></script>

</html>
<style>
#left{
    transform: rotate(180deg);
}

img{
    width:50px;
    cursor:pointer;
}

.nav{
    width:770px;
    text-align: center;
    margin-top:20px;
}

</style>