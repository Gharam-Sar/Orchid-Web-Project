// function showPlants(str) {
//     //
//     // var xmlhttp = new XMLHttpRequest();
//     // xmlhttp.open("GET", "plants.php?", false);
//     // xmlhttp.send();
//     // document.getElementById('wanted').innerHTML = xmlhttp.responseText;
//
//
//     if (str == "") {
//         document.getElementById("wanted").innerHTML = "";
//         return;
//     } else {
//         var xmlhttp = new XMLHttpRequest();
//         xmlhttp.open("GET", "plants.php?q=" + str, false);
//         xmlhttp.send();
//
//         xmlhttp.onreadystatechange = function () {
//             if (this.readyState == 4 && this.status == 200) {
//                 document.getElementById("wanted").innerHTML = this.responseText;
//             }
//         };
//
//     }
// }
//
//
//
//
//
