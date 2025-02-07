<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\AuthController;
use Controllers\SiteController;
use Controllers\DashboardController;
use Controllers\LocationController;
use Controllers\EmployeeController;
use Controllers\ServiceTypeController;
use Controllers\ServiceController;
use Controllers\AppointmentController;
use Controllers\UsuarioController;

session_start();

$router = new Router();
// =========================
// Rutas del Panel de Administración (Admin)
// =========================
$router->get('/admin', [DashboardController::class, 'index']);

// Rutas de Sucursales (Locations)
$router->get('/admin/sucursales', [LocationController::class, 'index']);
$router->get('/admin/sucursales/add', [LocationController::class, 'add']);
$router->post('/admin/sucursales/add', [LocationController::class, 'add']);
$router->get('/admin/sucursales/edit/{id}', [LocationController::class, 'edit']);
$router->post('/admin/sucursales/edit/{id}', [LocationController::class, 'edit']);
$router->post('/admin/sucursales/delete/{id}', [LocationController::class, 'delete']);
$router->get('/admin/sucursales/servicios/{id}', [LocationController::class, 'servicios']);

// Rutas de Empleados (Employees)
$router->get('/admin/empleados', [EmployeeController::class, 'index']);
$router->get('/admin/empleados/add', [EmployeeController::class, 'add']);
$router->post('/admin/empleados/add', [EmployeeController::class, 'add']);
$router->get('/admin/empleados/edit/{id}', [EmployeeController::class, 'edit']);
$router->post('/admin/empleados/edit/{id}', [EmployeeController::class, 'edit']);
$router->post('/admin/empleados/delete/{id}', [EmployeeController::class, 'delete']);
$router->get('/admin/empleados/servicios/{id}', [EmployeeController::class, 'servicios']);
$router->get('/admin/empleados/horario/{id}', [EmployeeController::class, 'horario']);
$router->get('/admin/empleados/no-disponibilidad/{id}', [EmployeeController::class, 'noDisponibilidad']);

// Rutas de Tipos de Servicio (Service Types)
$router->get('/admin/tipos-servicio', [ServiceTypeController::class, 'index']);
$router->get('/admin/tipos-servicio/add', [ServiceTypeController::class, 'add']);
$router->post('/admin/tipos-servicio/add', [ServiceTypeController::class, 'add']);
$router->get('/admin/tipos-servicio/edit/{id}', [ServiceTypeController::class, 'edit']);
$router->post('/admin/tipos-servicio/edit/{id}', [ServiceTypeController::class, 'edit']);
$router->post('/admin/tipos-servicio/delete/{id}', [ServiceTypeController::class, 'delete']);

// Rutas de Servicios Globales (Services)
$router->get('/admin/servicios', [ServiceController::class, 'index']);
$router->get('/admin/servicios/add', [ServiceController::class, 'add']);
$router->post('/admin/servicios/add', [ServiceController::class, 'add']);
$router->get('/admin/servicios/edit/{id}', [ServiceController::class, 'edit']);
$router->post('/admin/servicios/edit/{id}', [ServiceController::class, 'edit']);
$router->post('/admin/servicios/delete/{id}', [ServiceController::class, 'delete']);

// Rutas de Citas (Appointments)
$router->get('/admin/citas/calendario', [AppointmentController::class, 'calendario']);
$router->get('/admin/citas/listado', [AppointmentController::class, 'listado']);
$router->get('/admin/citas/add', [AppointmentController::class, 'add']);
$router->post('/admin/citas/add', [AppointmentController::class, 'add']);
$router->get('/admin/citas/ver/{id}', [AppointmentController::class, 'ver']);
$router->get('/admin/citas/editar/{id}', [AppointmentController::class, 'editar']);
$router->post('/admin/citas/editar/{id}', [AppointmentController::class, 'editar']);
$router->post('/admin/citas/cancelar/{id}', [AppointmentController::class, 'cancelar']);
$router->post('/admin/citas/estado/{id}', [AppointmentController::class, 'estado']);

// Rutas de Usuarios (Usuarios - Clientes) - Opcional
$router->get('/admin/usuarios', [UsuarioController::class, 'index']);
$router->get('/admin/usuarios/ver/{id}', [UsuarioController::class, 'ver']);
$router->get('/admin/usuarios/editar/{id}', [UsuarioController::class, 'editar']); // Opcional - con permisos controlados
$router->post('/admin/usuarios/editar/{id}', [UsuarioController::class, 'editar']); // Opcional - con permisos controlados
$router->post('/admin/usuarios/delete/{id}', [UsuarioController::class, 'delete']); // Opcional - con permisos controlados


$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);

$router->post('/logout', [AuthController::class, 'logout']);

$router->get('/registro', [AuthController::class, 'registro']);
$router->post('/registro', [AuthController::class, 'registro']);

$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);

$router->get('/reestablecer', [AuthController::class, 'reestablecer']);
$router->post('/reestablecer', [AuthController::class, 'reestablecer']);

$router->get('/mensaje', [AuthController::class, 'mensaje']);

$router->get('/confirmar', [AuthController::class, 'confirmar']);

$router->get('/', [SiteController::class, 'landing']);

$router->dispatch();