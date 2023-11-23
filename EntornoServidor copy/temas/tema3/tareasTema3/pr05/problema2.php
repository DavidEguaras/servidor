<?php
$datos = [2, 5, 9, 7, 6, 3, 1, 5, 4, 8, 3, 2, 6, 9, 3, 5, 1, 2, 3];

for ($i = 0; $i < count($datos); $i++) {
    if ($datos[$i] == 3) {
        $datos[$i] = $i;
    }
}

print_r($datos);
?>
