<?php
return  [
    '/' => [
        'controller'=> 'App\Controller\HomeController',
        'action'=> 'index',
    ],
    '/home'=> [
        'controller'=> 'App\Controller\HomeController',
        'action'=> 'index',
    ],
    '/saludo'=> [
        'controller'=> 'App\Controller\HomeController',
        'action'=> 'saludar',
    ],
    '/rol/index'=> [
        'controller'=> 'App\Controller\RolController',
        'action'=> 'index',
    ],
    '/actividad/index'=> [
        'controller'=> 'App\Controller\ActividadController',
        'action'=> 'index',
    ],
    '/centro/index'=> [
        'controller'=> 'App\Controller\CentroController',
        'action'=> 'index',
    ],
    '/programa/index'=> [
        'controller'=> 'App\Controller\ProgramaController',
        'action'=> 'index',
    ],
    '/rol/new'=> [// Muestra el formulario de creacion
        'controller'=> 'App\Controller\RolController',
        'action'=> 'new',
    ],
    '/actividad/new'=> [// Muestra el formulario de creacion
        'controller'=> 'App\Controller\ActividadController',
        'action'=> 'new',
    ],
    '/centro/new'=> [// Muestra el formulario de creacion
        'controller'=> 'App\Controller\CentroController',
        'action'=> 'new',
    ],
    '/programa/new'=> [// Muestra el formulario de creacion
        'controller'=> 'App\Controller\ProgramaController',
        'action'=> 'new',
    ],
    '/rol/create'=> [// Crea el rol  en la base de datos
        'controller'=> 'App\Controller\RolController',
        'action'=> 'create',
    ],
    '/actividad/create'=> [// Crea el rol  en la base de datos
        'controller'=> 'App\Controller\ActividadController',
        'action'=> 'create',
    ],
    '/centro/create'=> [// Crea el rol  en la base de datos
        'controller'=> 'App\Controller\CentroController',
        'action'=> 'create',
    ],
    '/programa/create'=> [// Crea el rol  en la base de datos
        'controller'=> 'App\Controller\ProgramaController',
        'action'=> 'create',
    ],
    '/rol/view/(\d+)'=> [// Visualisa el rol con el ID espesificado
        'controller'=> 'App\Controller\RolController',
        'action'=> 'view',
    ],
    '/actividad/view/(\d+)'=> [// Visualisa el rol con el ID espesificado
        'controller'=> 'App\Controller\ActividadController',
        'action'=> 'view',
    ],
    '/centro/view/(\d+)'=> [// Visualisa el rol con el ID espesificado
        'controller'=> 'App\Controller\CentroController',
        'action'=> 'view',
    ],
    '/programa/view/(\d+)'=> [// Visualisa el rol con el ID espesificado
        'controller'=> 'App\Controller\ProgramaController',
        'action'=> 'view',
    ],
    '/rol/edit/(\d+)'=> [// Editar el rol con el ID espesificado
        'controller'=> 'App\Controller\RolController',
        'action'=> 'editRol',
    ],
    '/actividad/edit/(\d+)'=> [// Editar el rol con el ID espesificado
        'controller'=> 'App\Controller\ActividadController',
        'action'=> 'editActividad',
    ],
    '/centro/edit/(\d+)'=> [// Editar el rol con el ID espesificado
        'controller'=> 'App\Controller\CentroController',
        'action'=> 'editCentro',
    ],
    '/rol/update'=> [// Actualizar el rol con el ID espesificado
        'controller'=> 'App\Controller\RolController',
        'action'=> 'updateRol',
    ],
    '/actividad/update'=> [// Actualizar el rol con el ID espesificado
        'controller'=> 'App\Controller\ActividadController',
        'action'=> 'updateActividad',
    ],
    '/centro/update'=> [// Actualizar el rol con el ID espesificado
        'controller'=> 'App\Controller\CentroController',
        'action'=> 'updateCentro',
    ],
    '/rol/delete/(\d+)'=> [// Eliminar el rol con el ID espesificado
        'controller'=> 'App\Controller\RolController',
        'action'=> 'deleteRol',
    ],
    '/actividad/delete/(\d+)'=> [// Eliminar el rol con el ID espesificado
        'controller'=> 'App\Controller\ActividadController',
        'action'=> 'deleteActividad',
    ],
    '/centro/delete/(\d+)'=> [// Eliminar el rol con el ID espesificado
        'controller'=> 'App\Controller\CentroController',
        'action'=> 'deleteCentro',
    ],
];
?>