function  Xhr(){
    let obj = null;
    try { obj = new ActiveXObject("Microsoft.XMLHTTP"); }
    catch(Error) { try { obj = new ActiveXObject("MSXML2.XMLHTTP");}
        catch(Error) { try { obj = new XMLHttpRequest(); }
            catch(Error) { alert('Impossible de créer l\'objet XMLHttpRequest')}
        }
    }

    return obj;
}

function ajaxHTML(){
    let req = Xhr();

    req.open("GET","sourceHtml.txt",false);
    req.send(null);

    document.getElementById("resultat1").innerHTML = req.responseText;
}

function ajaxXML(){
    let req = Xhr();
    req.onreadystatechange = function (){
        if(this.readyState == 4){
            afficheXML(this.responseXML);
        }
    }

    req.open("GET", "source.xml", true);
    req.send(null);
}

function afficheXML(xml){
    let items = xml.getElementsByTagName('client');
    let ch = '<table>';
    for(let i = 0; i < items.length; i++){
        ch += '<tr>';
        for(let j = 0; j < items[i].childNodes.length; j++){
            if(items[i].getElementsByTagName(items[i].childNodes[j].nodeName)[0]){
                ch += '<td>'+items[i].getElementsByTagName(items[i].childNodes[j].nodeName)[0].textContent+'</td>';
            }
        }
        ch += '</td>';
    }
    ch += '</table>';

    document.getElementById('resultat2').innerHTML = ch;
}

function ajaxJSON(){
    let req = Xhr();
    req.onreadystatechange = function (){
        if(this.readyState == 4){
            afficheJSON(JSON.parse(this.responseText));
        }
    }

    req.open("GET", "source.json", true);
    req.send(null);
}

function afficheJSON(json){
    let ch = '<table>'
    for(let index in json){
        ch += '<tr>'
        ch += '<td>'+json[index]['nom']+'</td>';
        ch += '<td>'+json[index]['prenom']+'</td>';
        ch += '<td>'+json[index]['age']+' ans</td>';
        ch += '</tr>';
    }
    
    ch += '</table>';

    document.getElementById('resultat3').innerHTML = ch;
}

ajaxHTML();

ajaxXML();

ajaxJSON();