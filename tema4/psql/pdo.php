<?php

require ('./confBD.php');

$DSN = 'pgsql:host='.IP.';dbname=prueba';

// try {
//     $con = new PDO($DSN, USER, PASS);
//     $sql ='insert into tiempo (descripcion, grados) values  (?, ?)';
//     $stmt = $con -> prepare($sql);
//     //$stmt -> execute(array('Hace niebla ', 5));
    
// } catch (PDOException $e) {
//     echo $e -> getMessage();
// }finally{
//     unset ($con);
// }




// try {
//     $con = new PDO($DSN, USER, PASS);
//     $sql ='insert into tiempo (descripcion, grados) values  (:desc, :grad)';
//     $stmt = $con -> prepare($sql);
//     $desc = 'Esta nevando';
//     $grd = 0;
//     $stmt -> bindParam(':desc', $desc);
//     $stmt -> bindParam( ':grad',$grd);
//     $stmt -> execute();
// } catch (PDOException $e) {
//     echo $e -> getMessage();
// }finally{
//     unset ($con);
// }


try {
    $con = new PDO($DSN, USER, PASS);
    $sql ='select * from tiempo where grados < 5';
    $stmt = $con -> prepare ("sql");
    $stmt -> execute();
    $stmt -> bindColumn(2, $desc);
    $stmt -> bindColumn(3, $grados);

    while( $row = $result -> fetch(PDO::FETCH_BOUND)) {
        echo"<br>El tiempo:".$desc.", la temperatura es de ".$grados." grados";
    }
    
    
} catch (PDOException $e) {
    echo $e -> getMessage();
}finally{
    unset ($con);
}






try {
    $con = new PDO($DSN, USER, PASS);
    $sql ='select * from tiempo';
    $result = $con -> query($sql);
    while( $row = $result -> fetch(PDO::FETCH_BOTH)) {
        echo"<br>El tiempo:".$row[1].", la temperatura es de ".$row[0]." grados";
    }
} catch (PDOException $e) {
    echo $e -> getMessage();
}

