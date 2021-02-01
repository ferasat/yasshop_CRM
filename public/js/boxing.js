var urlsaveNote = 'forBoxing/saveNote';
function saveNote(id) {
    var note = document.getElementById('note-'+id).value;
    var request = new XMLHttpRequest();
    console.log(note);
    request.open('get' , urlsaveNote+'/?id='+id+'&&note='+note);
    request.onreadystatechange = function () {
        if ((request.readyState == 4 )||(request.status == 200)){
            console.log(request.responseText);
            var saveReplay = document.getElementById('saveReplay'+id);
            saveReplay.innerHTML = '<strong> ذخیره شد </strong>'
        }
    }
    request.send();
}
var urlStatus = 'forBoxing/';
function status(id , s) {
    if (s === 0){
        var request = new XMLHttpRequest();
        request.open('get' , urlStatus+'toKasri/?id='+id );
        var divId = 'card-'+id ;
        console.log(divId);
        request.onreadystatechange = function () {
            if ((request.status === 200)||(request.readyState = 4 )){
                document.getElementById(divId).style.backgroundColor = "red" ;
                console.log(request.responseText);
            }
        }
        request.send();
    } else if (s === 1){
        var request = new XMLHttpRequest();
        request.open('get' , urlStatus+'toPost/?id='+id );
        var divId = 'card-'+id ;
        console.log(divId);
        request.onreadystatechange = function () {
            if ((request.status === 200)||(request.readyState = 4 )){
                document.getElementById(divId).style.backgroundColor = "blue" ;
            }
        }
        request.send();
    } else if (s === 2 ){
        var request = new XMLHttpRequest();
        request.open('get' , urlStatus+'errorInfo/?id='+id );
        var divId = 'card-'+id ;
        console.log(divId);
        request.onreadystatechange = function () {
            if ((request.status === 200)||(request.readyState = 4 )){
                document.getElementById(divId).style.backgroundColor = "yellow" ;
            }
        }
        request.send();
    } else if ( s === 3){
        var request = new XMLHttpRequest();
        request.open('get' , 'apply/?id='+id );
        var divId = 'sta-'+id ;
        var tdId = 'td-'+id ;
        console.log(divId);
        request.onreadystatechange = function () {
            if ((request.status === 200)||(request.readyState = 4 )){
                var btnSuc = document.getElementById(tdId);
                btnSuc.innerHTML = '<button class="btn btn-success">تایید شد</button>';
            }
        }
        request.send();
    }

}

var urlStatusFutuer = 'StatusFutuer/';
function statusFutuer(id,status) {
    if (status === 1){
        var request = new XMLHttpRequest();
        request.open('get' , urlStatusFutuer+'?id='+id+'&&status='+status );
        request.onreadystatechange = function () {
            if ((request.status === 200)||(request.readyState = 4 )){
                document.getElementById('FutureInventoryWP').innerHTML = "قابل تامین هست" ;
                console.log(request.responseText);
            }
        }
        request.send();
    }else if (status === 2){
        var request = new XMLHttpRequest();
        request.open('get' , urlStatusFutuer+'?id='+id+'&&status='+status );
        request.onreadystatechange = function () {
            if ((request.status === 200)||(request.readyState = 4 )){
                document.getElementById('FutureInventoryWP').innerHTML = "باید حذف شود" ;
                console.log(request.responseText);
            }
        }
        request.send();
    }else if (status === 3){
        var request = new XMLHttpRequest();
        request.open('get' , urlStatusFutuer+'?id='+id+'&&status='+status );
        request.onreadystatechange = function () {
            if ((request.status === 200)||(request.readyState = 4 )){
                document.getElementById('FutureInventoryWP').innerHTML = "قابل تامین نیست" ;
                console.log(request.responseText);
            }
        }
        request.send();
    }
}

var urlSavePrices = 'savePricesToStore';
function savePrices(id) {
    console.log(urlSavePrices);
    var resultSave = 'resultSave'+id;
    var price = document.getElementById('price'+id).value;
    var rPrice = document.getElementById('realPrice'+id).value;
    var vReal = document.getElementById('valueReal'+id).value;
    var onemilion = document.getElementById('onemilion'+id).value;
    var twomilion = document.getElementById('twomilion'+id).value;

    console.log(urlSavePrices+'?id='+id+'&&price='+price+'&&rPrice='+rPrice+'&&vReal='+vReal);

    var request = new XMLHttpRequest();
    request.open('get' , urlSavePrices+'?id='+id+'&&price='+price+'&&rPrice='+rPrice+'&&vReal='+vReal+'&&twomilion='+twomilion+'&&onemilion='+onemilion );
    request.onreadystatechange = function () {
        if (request.readyState = 1){
            document.getElementById(resultSave).innerHTML = "<strong style=\"color: #E91E63\">....... در حال انجام 1........</strong>" ;
            console.log('prose 1');
        }
        if (request.readyState = 2){
            document.getElementById(resultSave).innerHTML = "<strong style=\"color: #E91E63\">....... در حال انجام 2........</strong>" ;
            console.log('prose 2');
        }
        if (request.readyState = 3){
            document.getElementById(resultSave).innerHTML = "<strong style=\"color: #E91E63\">....... در حال انجام 3........</strong>" ;
            console.log('prose 3');
        }
        if ((request.status === 200)||(request.readyState = 4 )){
            document.getElementById(resultSave).innerHTML = "<strong style=\"color: #2a9055\">....... ذخیره شد........</strong>" ;
            console.log(request.responseText);
            var vR = document.getElementById('vR'+id);
            vR.innerHTML = vReal ;
            var rP = document.getElementById('rP'+id);
            rP.innerHTML = rPrice ;
            var p = document.getElementById('p'+id);
            p.innerHTML = price ;
            var o1 = document.getElementById('o1'+id);
            o1.innerHTML = onemilion ;
            var o2 = document.getElementById('o2'+id);
            o2.innerHTML = twomilion ;
        }
    }
    request.send();
}

var urlFixDB = 'fixDB' ;
function fixDB() {
    var request = new XMLHttpRequest();
    var result = document.getElementById('result');
    request.open('get' , urlFixDB );
    request.onreadystatechange = function () {
        if (request.readyState = 1){
            document.getElementById(result).innerHTML = "<strong style=\"color: #E91E63\">....... در حال انجام 1........</strong>" ;
            console.log('prose 1');
        }
        if (request.readyState = 2){
            document.getElementById(result).innerHTML = "<strong style=\"color: #E91E63\">....... در حال انجام 2........</strong>" ;
            console.log('prose 2');
        }
        if (request.readyState = 3){
            document.getElementById(result).innerHTML = "<strong style=\"color: #E91E63\">....... در حال انجام 3........</strong>" ;
            console.log('prose 3');
        }

        if ((request.status === 200)||(request.readyState = 4 )){
            var btnSuc = document.getElementById(result);
            btnSuc.innerHTML = '<button class="btn btn-success">کار انجام شد</button>';
        }
    }
    request.send();
}

