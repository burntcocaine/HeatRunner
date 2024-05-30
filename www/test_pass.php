<?php
$hash = '$2y$10$Kn6cG526.h5Hk5IUcBWUN.ykEEnY5k2NiHB1LkwYyyxmxtR4lP0Qu';
$contra = 'admin';

if (password_verify($contra, $hash)) {
    echo "La contraseña es correcta.";
} else {
    echo "La contraseña es incorrecta.";
}
?>
