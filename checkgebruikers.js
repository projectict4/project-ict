var xmlhttp = createHttpRequestObject();
var url = "http://ec2-54-229-159-242.eu-west-1.compute.amazonaws.com/checkgebruikers.php";

function createHttpRequestObject()
{
	var xmlhttp;
	
	try
	{
		xmlhttp = new XMLHttpRequest();
	}
	catch(e)
	{
	xmlhttp = false;
	}
	
	if(!xmlhttp)
	{
		alert("can not connect");
	}
	else
	{
		return xmlhttp;
	}
}

function process()
{
	if(xmlhttp.readyState==0 || xmlhttp.readyState==4)
	{
		log = encodeURIComponent(document.getElementById("loginvak").value);
		pas = encodeURIComponent(document.getElementById("pasvak").value);
		xmlhttp.open("GET",url + "?log=" + log + "&pas="+ pas,true);
		xmlhttp.send(null);
		xmlhttp.onreadystatechange = handleServerResponse;
	}
	else
	{
	}
}

function handleServerResponse()
{
	if(xmlhttp.readyState==4 && xmlhttp.status==200)
	{
		xmlResponse = xmlResponse.responseXML;
		XMLDocumentElement = xmlResponse.documentElement;
		message = xmlDocumentElement.firstChild.data;
		document.getElementById("testText").innerHTML = 'message';
	}
	else
	{
		alert('probleem!!!');
	}
}