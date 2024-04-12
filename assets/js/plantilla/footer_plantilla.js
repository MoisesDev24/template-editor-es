//<![CDATA[
	function getlink() {
		var aux = document.createElement("input");
		aux.setAttribute("value",window.location.href);
		document.body.appendChild(aux);
		aux.select();
		document.execCommand("copy");
		document.body.removeChild(aux);
	}
//]]>