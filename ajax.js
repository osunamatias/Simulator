function nuevoAjax()
{ 
	/* Crea el objeto AJAX. Esta funcion es generica para cualquier utilidad de este tipo, por
	lo que se puede copiar tal como esta aqui */
	var xmlhttp=false; 
	try 
	{ 
		// Creacion del objeto AJAX para navegadores no IE
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); 
	}
	catch(e)
	{ 
		try
		{ 
			// Creacion del objet AJAX para IE 
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
		} 
		catch(E) { xmlhttp=false; }
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp=new XMLHttpRequest(); } 

	return xmlhttp; 
}


/*********************************************************************************************************************************/
/*********************************************************************************************************************************/
function change(form){
	var valor = "";
	for (i=0; i< form.ctype.length; i++){
		if (form.ctype[i].checked){
		valor = form.ctype[i].value;
		}
	}
	//alert (valor);

	var company=document.getElementById("api_company").options[document.getElementById("api_company").selectedIndex].value;
	var casing=document.getElementById("casing").options[document.getElementById("casing").selectedIndex].value;
	var menor;
	var wall;
	
	if (casing==1){
		menor = document.getElementById("large_od").options[document.getElementById("large_od").selectedIndex].value;
		wall = document.getElementById("large_pipe").options[document.getElementById("large_pipe").selectedIndex].value;
	}
	if (casing==2){
		menor = document.getElementById("inter_od").options[document.getElementById("inter_od").selectedIndex].value;
		wall = document.getElementById("inter_pipe").options[document.getElementById("inter_pipe").selectedIndex].value;
	}
	if (casing==3){
		menor = document.getElementById("small_od").options[document.getElementById("small_od").selectedIndex].value;
		wall = document.getElementById("small_pipe").options[document.getElementById("small_pipe").selectedIndex].value;
	}
	
	if(valor==0)
	{
		/*
		combo=document.getElementById("ctype");
		combo.length=0;
		var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="";
		combo.appendChild(nuevaOpcion);	combo.disabled=true;
		*/
	}
	else
	{
		ajax=nuevoAjax();
		ajax.open("GET", "gun_size.php?ctype="+valor+"&company="+company+"&menor="+menor+"&wall="+wall, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1)
			{
				// Mientras carga elimino la opcion "Elige pais" y pongo una que dice "Cargando"
				combo=document.getElementById("gun_size");
				combo.length=0;
				var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Loading...";
				combo.appendChild(nuevaOpcion); combo.disabled=true;	
			}
			if (ajax.readyState==4)
			{ 
				document.getElementById("fila_gun_size").innerHTML=ajax.responseText;
			} 
		}
		ajax.send(null);
	}
	
	//pongo en blanco los elementos que dependen de el
	elemento=document.getElementById("shot_density");
	elemento.length=0;
	var opcionSelecciona=document.createElement("option"); opcionSelecciona.value=0; opcionSelecciona.innerHTML="";
	elemento.appendChild(opcionSelecciona); elemento.disabled=true;
}

/*********************************************************************************************************************************/
/*********************************************************************************************************************************/
function loadShotDensity()
{
	var spf = "";
	/*for (i=0; i< document.getElementById("ctype").length; i++){
		if (document.getElementById("ctype").options[i].checked){
		spf = document.getElementById("ctype").options[i].value;
		}
	}*/
	for (i=0; i< document.frm.ctype.length; i++){
		if (document.frm.ctype[i].checked){
		spf = document.frm.ctype[i].value;
		//alert(document.frm.ctype[i].value);
		}
	}
	
	var god=document.getElementById("gun_size").options[document.getElementById("gun_size").selectedIndex].value;
	var company=document.getElementById("api_company").options[document.getElementById("api_company").selectedIndex].value;
	//var god=document.getElementById("gun_size").options[document.getElementById("gun_size").selectedIndex].value;
	
	if(god==0)
	{
		// Si el usuario eligio la opcion "Elige", no voy al servidor y pongo todo por defecto
		combo=document.getElementById("shot_density");
		combo.length=0;
		var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="";
		combo.appendChild(nuevaOpcion);	combo.disabled=true;
	}
	else
	{
		ajax=nuevoAjax();
		ajax.open("GET", "shot_density.php?god="+god+"&company="+company+"&spf="+spf, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1)
			{
				// Mientras carga elimino la opcion "Elige pais" y pongo una que dice "Cargando"
				combo=document.getElementById("shot_density");
				combo.length=0;
				var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Loading...";
				combo.appendChild(nuevaOpcion); combo.disabled=true;	
			}
			if (ajax.readyState==4)
			{ 
				document.getElementById("fila_shot_density").innerHTML=ajax.responseText;
			} 
		}
		ajax.send(null);
	}
	
	//pongo en blanco los elementos que dependen de el
	elemento=document.getElementById("gun_phase");
	elemento.length=0;
	var opcionSelecciona=document.createElement("option"); opcionSelecciona.value=0; opcionSelecciona.innerHTML="";
	elemento.appendChild(opcionSelecciona); elemento.disabled=true;
}


/*********************************************************************************************************************************/
/*********************************************************************************************************************************/
function loadGunPhase()
{
	var valor=document.getElementById("shot_density").options[document.getElementById("shot_density").selectedIndex].value;
	//alert(valor);
	var company=document.getElementById("api_company").options[document.getElementById("api_company").selectedIndex].value;
	var god=document.getElementById("gun_size").options[document.getElementById("gun_size").selectedIndex].value;
	var ctype = "";
	for (i=0; i< document.frm.ctype.length; i++){
		if (document.frm.ctype[i].checked){
		ctype = document.frm.ctype[i].value;
		}
	}
	
	if(valor==0)
	{
		// Si el usuario eligio la opcion "Elige", no voy al servidor y pongo todo por defecto
		combo=document.getElementById("gun_phase");
		combo.length=0;
		var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="";
		combo.appendChild(nuevaOpcion);	combo.disabled=true;
	}
	else
	{
		ajax=nuevoAjax();
		ajax.open("GET", "gun_phase.php?valor="+valor+"&company="+company+"&god="+god+"&ctype="+ctype, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1)
			{
				// Mientras carga elimino la opcion "Elige pais" y pongo una que dice "Cargando"
				combo=document.getElementById("gun_phase");
				combo.length=0;
				var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Loading...";
				combo.appendChild(nuevaOpcion); combo.disabled=true;	
			}
			if (ajax.readyState==4)
			{ 
				document.getElementById("fila_gun_phase").innerHTML=ajax.responseText;
			} 
		}
		ajax.send(null);
	}
	
	//pongo en blanco los elementos que dependen de el
	elemento=document.getElementById("charge_gram");
	elemento.length=0;
	var opcionSelecciona=document.createElement("option"); opcionSelecciona.value=0; opcionSelecciona.innerHTML="";
	elemento.appendChild(opcionSelecciona); elemento.disabled=true;
	
	elemento=document.getElementById("charge_part_number");
	elemento.length=0;
	var opcionSelecciona=document.createElement("option"); opcionSelecciona.value=0; opcionSelecciona.innerHTML="";
	elemento.appendChild(opcionSelecciona); elemento.disabled=true;
	
	elemento=document.getElementById("explosive");
	elemento.length=0;
	var opcionSelecciona=document.createElement("option"); opcionSelecciona.value=0; opcionSelecciona.innerHTML="";
	elemento.appendChild(opcionSelecciona); elemento.disabled=true;
}


/*********************************************************************************************************************************/
/*********************************************************************************************************************************/
function loadCharge()
{
loadChargeGram();
}

/*********************************************************************************************************************************/
/*********************************************************************************************************************************/
function loadChargeGram()
{
	var ctype = "";
	for (i=0; i< document.frm.ctype.length; i++){
		if (document.frm.ctype[i].checked){
		ctype = document.frm.ctype[i].value;
		}
	}
	var phase=document.getElementById("gun_phase").options[document.getElementById("gun_phase").selectedIndex].value;
	var gsize=document.getElementById("gun_size").options[document.getElementById("gun_size").selectedIndex].value;
	var sden=document.getElementById("shot_density").options[document.getElementById("shot_density").selectedIndex].value;
	var api=document.getElementById("api_company").options[document.getElementById("api_company").selectedIndex].value;
	
	if(phase==0)
	{
		//pongo en blanco los elementos que dependen de el
		elemento=document.getElementById("charge_gram");
		elemento.length=0;
		var opcionSelecciona=document.createElement("option"); opcionSelecciona.value=0; opcionSelecciona.innerHTML="";
		elemento.appendChild(opcionSelecciona); elemento.disabled=true;
	}
	else
	{
		ajax=nuevoAjax();
		ajax.open("GET", "cgmwt.php?phase="+phase+"&gsize="+gsize+"&shotden="+sden+"&api="+api+"&ctype="+ctype, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1)
			{
				// Mientras carga elimino la opcion "Elige pais" y pongo una que dice "Cargando"
				combo=document.getElementById("charge_gram");
				combo.length=0;
				var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Loading...";
				combo.appendChild(nuevaOpcion); combo.disabled=true;	
			}
			if (ajax.readyState==4)
			{ 
				document.getElementById("fila_cgmwt").innerHTML=ajax.responseText;
			} 
		}
		ajax.send(null);
	}
	//loadChargePartNumber();
	return true;
}


/*********************************************************************************************************************************/
/*********************************************************************************************************************************/
function loadChargePartNumber()
{
	var phase=document.getElementById("gun_phase").options[document.getElementById("gun_phase").selectedIndex].value;
	var gsize=document.getElementById("gun_size").options[document.getElementById("gun_size").selectedIndex].value;
	var sden=document.getElementById("shot_density").options[document.getElementById("shot_density").selectedIndex].value;
	var api=document.getElementById("api_company").options[document.getElementById("api_company").selectedIndex].value;
	var cgmwt=document.getElementById("charge_gram").options[document.getElementById("charge_gram").selectedIndex].value;
	
	var ctype = "";
	for (i=0; i< document.frm.ctype.length; i++){
		if (document.frm.ctype[i].checked){
		ctype = document.frm.ctype[i].value;
		}
	}
	
	if(cgmwt==0)
	{
		//pongo en blanco los elementos que dependen de el
		elemento=document.getElementById("charge_part_number");
		elemento.length=0;
		var opcionSelecciona=document.createElement("option"); opcionSelecciona.value=0; opcionSelecciona.innerHTML="";
		elemento.appendChild(opcionSelecciona); elemento.disabled=true;
	}
	else
	{
		ajax=nuevoAjax();
		ajax.open("GET", "cpn.php?phase="+phase+"&gsize="+gsize+"&shotden="+sden+"&api="+api+"&cgmwt="+cgmwt+"&ctype="+ctype, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1)
			{
				// Mientras carga elimino la opcion "Elige pais" y pongo una que dice "Cargando"
				combo=document.getElementById("charge_part_number");
				combo.length=0;
				var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Loading...";
				combo.appendChild(nuevaOpcion); combo.disabled=true;	
			}
			if (ajax.readyState==4)
			{ 
				document.getElementById("fila_cpn").innerHTML=ajax.responseText;
			} 
		}
		ajax.send(null);
	}
	//loadChargeExplosive();
	return true;
}

/*********************************************************************************************************************************/
/*********************************************************************************************************************************/
function loadChargeExplosive()
{
	var phase=document.getElementById("gun_phase").options[document.getElementById("gun_phase").selectedIndex].value;
	var gsize=document.getElementById("gun_size").options[document.getElementById("gun_size").selectedIndex].value;
	var sden=document.getElementById("shot_density").options[document.getElementById("shot_density").selectedIndex].value;
	var api=document.getElementById("api_company").options[document.getElementById("api_company").selectedIndex].value;
	var cgmwt=document.getElementById("charge_gram").options[document.getElementById("charge_gram").selectedIndex].value;
	var cpn=document.getElementById("charge_part_number").options[document.getElementById("charge_part_number").selectedIndex].value;
			
	if(cpn==0)
	{
		//pongo en blanco los elementos que dependen de el
		elemento=document.getElementById("explosive");
		elemento.length=0;
		var opcionSelecciona=document.createElement("option"); opcionSelecciona.value=0; opcionSelecciona.innerHTML="";
		elemento.appendChild(opcionSelecciona); elemento.disabled=true;
	}
	else
	{
		ajax=nuevoAjax();
		ajax.open("GET", "cexpl.php?phase="+phase+"&gsize="+gsize+"&shotden="+sden+"&api="+api+"&cgmwt="+cgmwt+"&cpn="+cpn, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1)
			{
				// Mientras carga elimino la opcion "Elige pais" y pongo una que dice "Cargando"
				combo=document.getElementById("explosive");
				combo.length=0;
				var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Loading...";
				combo.appendChild(nuevaOpcion); combo.disabled=true;	
			}
			if (ajax.readyState==4)
			{ 
				document.getElementById("fila_cexpl").innerHTML=ajax.responseText;
			} 
		}
		ajax.send(null);
	}
	return true;
}


/*********************************************************************************************************************************/
/*********************************************************************************************************************************/
function loadOD(tamnu)
{
	//alert(tamnu);
	var tam = "large";
	if (tamnu==2)
		tam = "inter";
	if (tamnu==3)
		tam = "small";
	//alert(tam);
	
	//var tam = "large";
	var wt = 0;
	var valor = document.getElementById("dm").options[document.getElementById("dm").selectedIndex].value;
	if (tamnu == 2){
		valor = document.getElementById("large_od").options[document.getElementById("large_od").selectedIndex].value;
		wt = document.getElementById("large_pipe").options[document.getElementById("large_pipe").selectedIndex].value;
	}
	if (tamnu == 3){
		valor = document.getElementById("inter_od").options[document.getElementById("inter_od").selectedIndex].value;
		wt = document.getElementById("inter_pipe").options[document.getElementById("inter_pipe").selectedIndex].value;
	}
			//alert(valor);
	if(valor==0)
	{
		// Si el usuario eligio la opcion "Elige", no voy al servidor y pongo todo por defecto
		combo=document.getElementById(tam+"_od");
		combo.length=0;
		var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="";
		combo.appendChild(nuevaOpcion);	combo.disabled=true;
	}
	else
	{
		ajax=nuevoAjax();
		ajax.open("GET", "od.php?menor="+valor+"&tam="+tamnu+"&	wt="+wt, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1)
			{
				// Mientras carga elimino la opcion "Elige pais" y pongo una que dice "Cargando"
				combo=document.getElementById(tam+"_od");
				combo.length=0;
				var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Loading...";
				combo.appendChild(nuevaOpcion); combo.disabled=true;	
			}
			if (ajax.readyState==4)
			{ 
				document.getElementById("fila_od_"+tamnu).innerHTML=ajax.responseText;
			} 
		}
		ajax.send(null);
	}
	
	//pongo en blanco los elementos que dependen de el
	elemento=document.getElementById(tam+"_weight");
	elemento.length=0;
	var opcionSelecciona=document.createElement("option"); opcionSelecciona.value=0; opcionSelecciona.innerHTML="";
	elemento.appendChild(opcionSelecciona); elemento.disabled=true;
}


/*********************************************************************************************************************************/
/*********************************************************************************************************************************/
function loadWeight(tamnu)
{
	//alert(tamnu);
	var tam = "large";
	if (tamnu==2)
		tam = "inter";
	if (tamnu==3)
		tam = "small";
	//alert(tam);
	
	//var tam = "large";
	var valor=document.getElementById(tam+"_od").options[document.getElementById(tam+"_od").selectedIndex].value;
	if(valor==0)
	{
		// Si el usuario eligio la opcion "Elige", no voy al servidor y pongo todo por defecto
		combo=document.getElementById(tam+"_weight");
		combo.length=0;
		var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="";
		combo.appendChild(nuevaOpcion);	combo.disabled=true;
	}
	else
	{
		ajax=nuevoAjax();
		ajax.open("GET", "weight.php?seleccionado="+valor+"&tam="+tamnu, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1)
			{
				// Mientras carga elimino la opcion "Elige pais" y pongo una que dice "Cargando"
				combo=document.getElementById(tam+"_weight");
				combo.length=0;
				var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Loading...";
				combo.appendChild(nuevaOpcion); combo.disabled=true;	
			}
			if (ajax.readyState==4)
			{ 
				document.getElementById("fila_weight_"+tamnu).innerHTML=ajax.responseText;
			} 
		}
		ajax.send(null);
	}
	//pongo en blanco los elementos que dependen de el
	elemento=document.getElementById(tam+"_pipe");
	elemento.length=0;
	var opcionSelecciona=document.createElement("option"); opcionSelecciona.value=0; opcionSelecciona.innerHTML="";
	elemento.appendChild(opcionSelecciona); elemento.disabled=true;
}


/*********************************************************************************************************************************/
/*********************************************************************************************************************************/
function loadPipe(tamnu)
{
	var tam = "large";
	if (tamnu==2)
		tam = "inter";
	if (tamnu==3)
		tam = "small";

	var valor=document.getElementById(tam+"_weight").options[document.getElementById(tam+"_weight").selectedIndex].value;
	var valor2=document.getElementById(tam+"_od").options[document.getElementById(tam+"_od").selectedIndex].value;
	if(valor==0)
	{
		// Si el usuario eligio la opcion "Elige", no voy al servidor y pongo todo por defecto
		combo=document.getElementById(tam+"_pipe");
		combo.length=0;
		var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="";
		combo.appendChild(nuevaOpcion);	combo.disabled=true;
	}
	else
	{
		ajax=nuevoAjax();
		ajax.open("GET", "pipe.php?seleccionado="+valor+"&tam="+tamnu+"&od="+valor2, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1)
			{
				// Mientras carga elimino la opcion "Elige pais" y pongo una que dice "Cargando"
				combo=document.getElementById(tam+"_pipe");
				combo.length=0;
				var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Loading...";
				combo.appendChild(nuevaOpcion); combo.disabled=true;	
			}
			if (ajax.readyState==4)
			{ 
				document.getElementById("fila_pipe_"+tamnu).innerHTML=ajax.responseText;
			} 
		}
		ajax.send(null);
	}
}