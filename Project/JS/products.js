
var G_ID;
function show(imgid) {

    G_ID = imgid;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET","panel.php?id="+imgid,false);
    xmlhttp.send();
    document.getElementById("#p1").innerHTML = xmlhttp.responseText;
    document.getElementById('#p1').style.width = "100%";
}

function hide(id) {
    document.getElementById(id).style.width = "0%";
}


function buy(){

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET","checklog.php?id="+ G_ID ,false);
    xmlhttp.send();
    document.body.innerHTML = xmlhttp.responseText;
}

function make_order(){

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET","placeorder.php?id="+ G_ID ,false);
    xmlhttp.send();
    document.body.innerHTML = xmlhttp.responseText;

}
function getID(){

    return G_ID;
}
function update(orderid) {

    var status = document.getElementsByName('status'+orderid).value;
    alert(status);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET","whatever.php?id="+orderid+"&status="+status,false);
    xmlhttp.send();

    document.body.innerHTML = xmlhttp.responseText;

}
