<?php
//******************** GENERAR JSON *****************/


 //Creamos el JSON


//GUT
  
  //ArmarBloque('datos.json','asdfasdfasdfasdfsa');
function ArmarBloque($data,$id){
    
    $datos = array(); //creamos un array
//bien ll
  
    for($i=1;isset($_POST["datoL".$i]);$i++){

        $datoL=$_POST['datoL'.$i];
        $datoR=$_POST['datoR'.$i];
        $datos[] = array($datoL=>$datoR);   
    }
    
    $json_string = json_encode($datos);
//bien
 $file = 'datos.json';
 file_put_contents($file, $json_string); 
     $Block = array();
     $datos=file_get_contents($data);
    /*$Block = 'id'=>"{".$id."}",'data'=>(json_decode($datos));
    $json_string = json_encode($Block);
    $eliminado=str_replace("[","",$json_string);
     $eliminado=str_replace("]","",$eliminado);
     $eliminado=substr($eliminado,1);
     $eliminado=substr($eliminado,0,-1);*/
    
     $extra = json_encode($datos);
     $extra= str_replace("[","",$extra);
     $extra= str_replace("]","",$extra);
     $extra= str_replace("},{", ",", $extra);
     
     $bloque='{"id":"'.$id.'","data":'. $extra .'}';
     
     
    $url = 'http://localhost:3001/mineBlock';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $bloque);
    $output = curl_exec($ch);
    
    
    $bloques='{"to":"/topics/news","notification":{"body":"mensaje","title":"mensajote"}, data" : {"id":"'.$id.'","secret":"'.$output[0].'", "name":"Hospital 12"}}';
    $urls = 'https://fcm.googleapis.com/fcm/send';
    $chs = curl_init();
    curl_setopt($chs, CURLOPT_URL, $urls);
    curl_setopt($chs, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($chs, CURLOPT_POST, true);
    curl_setopt($chs, CURLOPT_HTTPHEADER, array('Content-type: application/json','Authorization: key=AIzaSyA9tIjPIgI3MGlsI9bKLRlfNIUF9rDfRXA'));
    curl_setopt($chs, CURLOPT_POSTFIELDS, $bloques);
    $outputs = curl_exec($chs);
    
    file_put_contents("log.txt", var_dump($outputs));
    
    // $bloque=$eliminado;
    
    $BlockFile='Block.json';
    file_put_contents($BlockFile, $bloque); 
    
}

?>

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Formulario para Generar y mostrar JSON - EjemploCodigo</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" ></script>
    <link href="estilos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css">
</head>

<body>
    <div id="wrapper">
         <form action="<?php $_PHP_SELF ?>" method="POST" id="tablita">
             <div id="DivInputs">
                 <div id="1" class="inputs"><input type="text" name="datoL1"/> <input type="text" name="datoR1"/> <a href="#" onClick="borrarCampo(this.parentNode.id)"><img src="delete.png.png"/></a><br></div>
            </div>
             <br>
         <div class="inputs"><input type="button" value="Agregar otro campo" onclick="agregarCampo()"  id="botonmas"/><input type="submit" id="submit" action=<?php $_PHP_SELF;ArmarBloque('datos.json','Ss5MxnHqHu7kl0oa6zQHNOxZb9o2pHMs'); ?>/></div>

         </form>
        <!--<table class="grilla" id="tablajson">
         <thead>
         <th>Dato1</th>
         <th>Dato2</th> 
         </thead>
         <tbody></tbody>
         </table>-->
    </div>
<script type="text/javascript">
 var i=1;
$(document).ready(function(){
    var url="datos.json";
    $("#tablajson tbody").html("");
    $.getJSON(url,function(datos){
        $.each(datos, function(i,dato){
        var newRow =
        "<tr>"
        +"<td>"+dato.izquierda+"</td>"
        +"</tr>";
        $(newRow).appendTo("#tablajson tbody");
        //document.getElementById("botonmas").addEventListener("click",agregarCampo());
        //document.getElementsByClassName("borrar").addEventListener("click", borrarCampo);
        });
    });
    /*for(var j=1;j<i;j++){
        store.set("l"+j, $("datoL"+j).val());
        console.log(store.get("l1"));
        store.set("r"+j, $("datoR"+j).val());
        console.log(store.get("r1"));
    }*/
 });

function agregarCampo(){
    i=i+1;
    document.getElementById("DivInputs").insertAdjacentHTML("beforeend", "<div id="+i+" class='inputs''><input type='text' name='datoL"+i+"'/> <input type='text' name='datoR"+i+"'/> <a href='#' onClick='borrarCampo(this.parentNode.id)'><img src='delete.png.png\n\
'/></a><br></div>"); //AQUI CAMBIÉ ALGO
    
    //console.log("lol");
}

function borrarCampo(n){
    document.getElementById("DivInputs").removeChild(document.getElementById(n));
    //console.log(n);
}
    

//$.ajax({
 // type: "POST",
 // url: 'localhost',
  //data: data,
  //success: success,
  //dataType: dataType
//});

//$.post( "localhost:3001", function( data ) {
 // console.log();
//});
//const postData = querystring.stringify({
 // 'msg': 'Hello World!'
//});


//xhttp.open("POST", "Block.json", true);
//xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//xhttp.send("fname=Henry&lname=Ford");


</script>
 </body>
</html>