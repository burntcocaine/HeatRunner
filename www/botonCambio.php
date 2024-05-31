<!DOCTYPE html> 
<html lang="es"> 
    <head>   
        <meta charset="UTF-8">   
        <meta name="viewport" content="width=device-width, initial-scale=1.0">   
        <title>Control de Aire Acondicionado</title>   
        <style>     #btn-control { 
                  padding: 10px 20px;   
                      background-color: #4CAF50;   
                          color: white;      
                           border: none;     
                             border-radius: 5px;    
                                cursor: pointer;       
                                font-size: 16px;     
                            }   

                                  #btn-control:hover {    
                                       background-color: #45a049;   
                                         }   
                      </style>
                          </head>
                          <body>   
       <button id="btn-control" onclick="toggleAire()">Encender</button> 
         <script>     var aireEncendido = false;      function toggleAire() {  
                 var btn = document.getElementById("btn-control");    
                    if (aireEncendido) {         aireEncendido = false;  
                               btn.style.backgroundColor = "#4CAF50";    
                                    btn.innerHTML = "Encender";         // Aquí puedes agregar la lógica para apagar el aire acondicionado  
                                     } else {         aireEncendido = true;   
                                              btn.style.backgroundColor = "#f44336";    
                                                   btn.in

