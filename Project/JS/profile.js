function check() {

    var first = document.getElementById('new').value;
    var second = document.getElementById('new2').value;

    var span = document.getElementById('result');
    if (first === second) {
        span.style.color = 'white';
        span.innerHTML = 'Passwords match';
    } else {
        span.style.color = 'black';
        span.innerHTML = 'Passwords do not match';
    }
 }


function save() {

    var old = document.getElementById('old').value;
    var first = document.getElementById('new').value;
    var second = document.getElementById('new2').value;
    var username = document.getElementById('username').value;
    var email = document.getElementById('email').value;
    var phone = document.getElementById('phone').value;
    var address = document.getElementById('address').value;

    if (old == '') {

        old = null;
    }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "whatever.php?old=" + old + "&first=" + first + "&second=" + second + "&username=" + username + "&email=" + email + "&phone=" + phone+"&address="+address, false);
    xmlhttp.send();

    document.body.innerHTML = xmlhttp.responseText;
}
//
// function save() {
//
//     var name = null ;
//     var email = null;
//     var phone = null ;
//     var address = null;
//     $( ".name" ).change(function() {
//         name = document.getElementById('username').value;
//     });
//     $( ".address" ).change(function() {
//         address = document.getElementById('address').value;
//     });
//     $( ".phone" ).change(function() {
//         phone = document.getElementById('phone').value;
//     });$( ".email" ).change(function() {
//         email = document.getElementById('email').value;
//     });
//
//     var old = document.getElementById('old').value;
//     var first = document.getElementById('new').value;
//     var second = document.getElementById('new2').value;
//     // var username = document.getElementById('username').value;
//     // var email = document.getElementById('email').value;
//     // var phone = document.getElementById('phone').value;
//     // var address = document.getElementById('address').value;
//
//     if (old == '') {
//
//         old = null;
//     }
//     var xmlhttp = new XMLHttpRequest();
//     xmlhttp.open("GET", "whatever.php?old=" + old + "&first=" + first + "&second=" + second + "&username=" + name + "&email=" + email + "&phone=" + phone+"&address="+address, false);
//     xmlhttp.send();
//
//     document.body.innerHTML = xmlhttp.responseText;
// }