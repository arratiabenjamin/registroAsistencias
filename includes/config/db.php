<?php

    function conectarDB() : mysqli{
        

        $DB = mysqli_connect( 'localhost', 'root', 'Demu1771$', 'registroasistencias' );
        
        if(!$DB){
            die("Conexion Fallida..." . mysqli_connect_error());
            exit;
        }

        return $DB;
    }