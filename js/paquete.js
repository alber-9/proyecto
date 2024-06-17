import { mostrar } from './principal.js';
import {paginas,tablaPaginacion } from '../herramientas/paginacion.js';

if (localStorage.inicio == null || localStorage.inicio ==''){
        if (location.href == "http://localhost/paginas/cultivos/cultivo-editar.php" || location.href == "http://localhost/paginas/cultivos/cultivo-insertar.php" ||
            location.href == "http://localhost/paginas/cultivos/cultivo-editar.php" ||  location.href == "http://localhost/paginas/cultivos/cultivo-insertar.php" ||
            location.href == "http://localhost/paginas/abono/abono-editar.php" || location.href == "http://localhost/paginas/abono/abono-insertar.php" ||
            location.href == "http://localhost/paginas/cura/cura-editar.php" || location.href == "http://localhost/paginas/cura/cura-insertar.php" ||
            location.href == "http://localhost/paginas/producto/producto-editar.php" || location.href == "http://localhost/paginas/producto/producto-insertar.php" || 
            location.href == "http://localhost/paginas/receta.php"|| location.href == "http://localhost/paginas/nota/nota-insertar.php"){
                
               window.location.href = 'http://localhost/';
            }

}


document.addEventListener("DOMContentLoaded", function() {
try {
    //para abrir sesion
    document.getElementById("session").addEventListener("click", mostrar);

    //para comprobar el inicio sesion en localstorage y modificar el boton 
    if (!(localStorage.inicio == null || localStorage.inicio =='') ){
        
        let parrafos = document.getElementsByClassName("miParrafo");
        // Iterar sobre todos los elementos con la clase 'miParrafo'
        for (let i = 0; i < parrafos.length; i++) {
            let parrafo = parrafos[i];
    
            
                parrafo.style.display = "block";
                document.getElementById("session").innerHTML = "Cerrar sesión";
        }
        document.getElementById("session").classList.add('active');
    }
    else{
        
        let parrafos = document.getElementsByClassName("miParrafo");
        // Iterar sobre todos los elementos con la clase 'miParrafo'
        for (let i = 0; i < parrafos.length; i++) {
            let parrafo = parrafos[i];
            parrafo.style.display = "none";
            document.getElementById("session").innerHTML = "Inicio de sesion";
            
            
        } 
         document.getElementById("session").classList.remove('active');
    }
    //poner el nombre en una etiqueta
    document.getElementById("usuario").innerHTML = localStorage.inicio;
    //Obtener el nombre de usuario almacenado en localStorage
    let nombreUsuario = localStorage.inicio;
   

   
        //  Obtener todos los elementos que deseas filtrar
        
        let elementos = document.getElementById('notasTabla').getElementsByTagName('tr');

        
        //  Recorrer los elementos y agregar la clase 'oculto' a aquellos que no tengan la clase correspondiente al nombre de usuario
        for (let i = 1; i < elementos.length; i++) {
            let elemento = elementos[i];
           
            if (!elemento.classList.contains(nombreUsuario)) {
                elemento.classList.add('oculto');
            }
        }
        try {
            paginas("riegoTabla", "r1");
            paginas("notasTabla", "n1");
        } catch (error) {
            
        }   
    

    document.getElementById("notasTablaPage").addEventListener("click", function (evento) {
        
        let id = evento.target.id
        
        if (id) {
            paginas("notasTabla",id);
        }
    });
    document.getElementById("riegoTablaPage").addEventListener("click", function (evento) {
        
        let id = evento.target.id
        
        if (id) {
            paginas("riegoTabla",id);
        }
    }); 


    if (!(window.location.href == "http://localhost/paginas/cultivos/cultivo-insertar.php" ||
            window.location.href == "http://localhost/paginas/abono/abono-insertar.php" ||
            window.location.href == "http://localhost/paginas/producto/producto-insertar.php" ||
            window.location.href == "http://localhost/paginas/diario/diario-insertar.php"))
    {

        document.getElementById("myTablePage").addEventListener("click", function (evento) {
        
        let id = evento.target.id
       
        if (id) {
            paginas("myTable",id);
        }
        }); 
        paginas("myTable","m1");
    }
    

} catch (error) {

}

    
}); 