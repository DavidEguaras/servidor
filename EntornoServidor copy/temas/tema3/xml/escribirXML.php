<?php
    //addChild -> Agrega Elemento
    //addAtributte -> Agrega Elemento al atributo

    
    $xml = new SimpleXMLElement('<juegos></juegos>');

    $juego1 = $xml->addChild('juego');
    $juego1->addAttribute('id', '1');
    $juego1->addChild('nombre', 'FIFA');
    $dispositivos1 = $juego1->addChild('dispositivos');
    $dispositivos1->addChild('dispositivo', 'XBOX');
    $dispositivos1->addChild('dispositivo', 'PlayStation');

    $juego2 = $xml->addChild('juego');
    $juego2->addChild('nombre', 'Pokemon');
    $dispositivos2 = $juego2->addChild('dispositivos');
    $dispositivos2->addChild('dispositivo', 'Nintendo');

    
    $juego2 = $xml->addChild('juego');
    $juego2->addChild('nombre', 'GTA');
    $dispositivos2 = $juego2->addChild('dispositivos');
    $dispositivos2->addChild('dispositivo', 'XBOX');
    $dispositivos2->addChild('dispositivo', 'PlayStation');
    $dispositivos2->addChild('dispositivo', 'PC');
    //guarda el xml en un fichero
    //si ya existe lo sobreescribe siNO lo crea
    $xml -> asXML('juegos.xml');


?>