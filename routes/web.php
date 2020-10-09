<?php

Route::get('/', function () {
    return 'Home';
});

Route::get('/usuarios', function () {
    return 'Usuarios';
});

Route::get('/usuarios/{id}', function ($id) {
    return "Detalle de usuario {$id}";
// })->where('id', '\d+');
});

Route::get('/usuarios/nuevo', function () {
    return "Crear nuevo usuario";
});

Route::get('/usuario/{name}/{nickname?}', function ($name, $nickname = null) {
    $name = ucfirst($name);

    if ($nickname) {
        return "Hola {$name}, tu apodo es {$nickname}";
    }

    return "Hola {$name}";
});
