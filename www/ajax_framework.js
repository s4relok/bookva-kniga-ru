/* -------------------------- */

/*   XMLHTTPRequest Enable    */

/* -------------------------- */

function createObject() {

var request_type;

var browser = navigator.appName;

if(browser == "Microsoft Internet Explorer"){

request_type = new ActiveXObject("Microsoft.XMLHTTP");

} else {

request_type = new XMLHttpRequest();

}

return request_type;

}



var http = createObject();



/* -------------------------- */

/*        SEARCH              */

/* -------------------------- */

function searchNameq() {

upload_file = encodeURI(document.getElementById('upload_file').value);

document.getElementById('msg').style.display = "block";

//document.getElementById('msg').innerHTML = "Searching for <strong>" + searchq+"";

// Set te random number to add to URL request

nocache = Math.random();

http.open('get', 'in-search.php?filename='+searchq+'&nocache = '+nocache);

http.onreadystatechange =  searchNameqReply;

http.send(null);

}

function uploadFile() {

searchq = encodeURI(document.getElementById('finder').value);

document.getElementById('msg').style.display = "block";

//document.getElementById('msg').innerHTML = "Searching for <strong>" + searchq+"";

// Set te random number to add to URL request

nocache = Math.random();

http.open('get', 'in-search.php?search='+searchq+'&nocache = '+nocache);

http.onreadystatechange =  searchNameqReply;

http.send(null);

}

function searchNameqReply() {

if(http.readyState == 4){

var response = http.responseText;

document.getElementById('search-result').innerHTML = response;

}

}

