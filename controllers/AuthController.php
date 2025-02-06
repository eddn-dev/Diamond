<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;
use MVC\View;

class AuthController {
    public static function middlewaresMap(){
        return [
            'login' => []
        ];
    }

    public static function login(Router $router) {
        if (isset($_SESSION['id'])) {
            if ($_SESSION['admin'] == 1) {
                header('Location: /admin/dashboard');
            } else {
                header('Location: /');
            }
            exit;
        }
    
        $alertas = [];
        $emailPreload = '';
    
        // Si la solicitud POST tiene 'action' igual a 'init_session', se precarga el email
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'init_session') {
            $emailPreload = $_POST['email'] ?? '';
            // Renderizamos la vista de login con el email precargado y sin procesar la lógica normal
            View::render('auth/login', [
                'title'         => 'Iniciar Sesión',
                'alertas'       => [],
                'emailPreload'  => $emailPreload
            ], 'layout.php');
            return;
        }
    
        // Si es una solicitud POST normal (para iniciar sesión)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $emailPreload = $_POST['email'];
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarLogin();
    
            if (empty($alertas)) {
                // Buscar el usuario en la BD
                $usuarioFromDB = Usuario::where('email', $usuario->email);
                if (!$usuarioFromDB || !$usuarioFromDB->confirmado) {
                    Usuario::setAlerta('error', 'El usuario no existe o no está confirmado');
                } else {
                    if (password_verify($_POST['password'], $usuarioFromDB->password)) {
                        // Iniciar la sesión y guardar los datos del usuario
                        $_SESSION['id'] = $usuarioFromDB->id;
                        $_SESSION['nombre'] = $usuarioFromDB->nombre;
                        $_SESSION['email'] = $usuarioFromDB->email;
                        $_SESSION['admin'] = $usuarioFromDB->admin;
                        
                        // Redirigir según el rol del usuario
                        if ($usuarioFromDB->admin == 1) {
                            header('Location: /admin/dashboard');
                        } else {
                            header('Location: /finalizar-registro');
                        }
                        exit;
                    } else {
                        Usuario::setAlerta('error', 'Contraseña incorrecta');
                    }
                }
            }
        }
    
        $alertas = Usuario::getAlertas();
        View::render('auth/login', [
            'title'         => 'Iniciar Sesión',
            'alertas'       => $alertas,
            'emailPreload'  => $emailPreload
        ], 'layout.php');
    }
    

    public static function logout() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start(); // Asegúrate de tener la sesión activa
            $_SESSION = [];
            // Puedes destruir la sesión si lo deseas:
            session_destroy();
            // Enviar respuesta JSON indicando éxito
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
            exit;
        }
        // Si no es POST, puedes devolver un error
        header('HTTP/1.1 405 Method Not Allowed');
        exit;
    }    

    public static function registro(Router $router) {
        $alertas = [];
        $usuario = new Usuario();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            
            // Valida datos
            $alertas = $usuario->validar_cuenta();
        
            if (empty($alertas)) {
                // Revisa si el email ya existe
                $existeUsuario = Usuario::where('email', $usuario->email);
        
                if ($existeUsuario) {
                    $alertas['error'][] = 'El correo ya está registrado';
                } else {
                    // Hashear password
                    $usuario->hashPassword();
                    // Generar Token
                    $usuario->crearToken();
                    // Eliminar password2, ya que no se mostrará
                    unset($usuario->password2);
        
                    // Crear nuevo usuario en BD
                    $resultado = $usuario->guardar();
        
                    if ($resultado['resultado']) {
                        // Enviar email confirmación
                        $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                        $email->enviarConfirmacion();
                        // Redirigir a mensaje
                        header('Location: /mensaje');
                        exit;
                    } else {
                        $alertas['error'][] = 'Hubo un error al crear el usuario';
                    }
                }
            }
        }
        
        // En caso de error, se pasa el mismo $usuario a la vista
        View::render('auth/registro', [
            'title'   => 'Crea tu cuenta',
            'usuario'  => $usuario,
            'alertas'  => $alertas
        ], 'layout.php');
    }
    
    public static function olvide(Router $router) {
        $alertas = [];
        // Crear una instancia vacía para re-popular el campo en caso de error.
        $usuario = new Usuario();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sincroniza los datos enviados (para re-popular el campo, por ejemplo)
            $usuario->sincronizar($_POST);
            // Validar el email (o número, según la lógica actual del método)
            $alertas = $usuario->validarEmail();
    
            if (empty($alertas)) {
                // Buscar el usuario por email
                $usuarioEncontrado = Usuario::where('email', $usuario->email);
    
                if ($usuarioEncontrado && $usuarioEncontrado->confirmado) {
                    // Generar un nuevo token y actualizar el usuario
                    $usuarioEncontrado->crearToken();
                    unset($usuarioEncontrado->password2);
                    $usuarioEncontrado->guardar();
    
                    // Enviar el email con las instrucciones
                    $email = new Email($usuarioEncontrado->email, $usuarioEncontrado->nombre, $usuarioEncontrado->token);
                    $email->enviarInstrucciones();
    
                    $alertas['exito'][] = 'Hemos enviado las instrucciones a tu email';
                } else {
                    $alertas['error'][] = 'El usuario no existe o no está confirmado';
                }
            }
        }
    
        // Renderizar la vista pasando título, alertas y el objeto usuario (para re-popular el formulario)
        View::render('auth/olvide', [
            'title'  => 'Olvidé mi Password',
            'alertas' => $alertas,
            'usuario' => $usuario
        ], 'layout.php');
    }
       

    public static function reestablecer(Router $router) {
        // Obtener el token desde la URL
        $token = s($_GET['token'] ?? '');
    
        // Si no hay token, redirige a la página de inicio
        if(!$token) {
            header('Location: /');
            exit;
        }
    
        // Inicializar bandera para token válido y buscar el usuario
        $token_valido = true;
        $usuario = Usuario::where('token', $token);
    
        if(!$usuario) {
            Usuario::setAlerta('error', 'Token no válido, intenta de nuevo');
            $token_valido = false;
        }
    
        // Procesar el formulario si se envía y el token es válido
        if($_SERVER['REQUEST_METHOD'] === 'POST' && $token_valido) {
            // Sincronizar datos enviados en el formulario
            $usuario->sincronizar($_POST);
    
            // Validar que ambos campos estén completos
            if(empty($_POST['password']) || empty($_POST['password2'])) {
                Usuario::setAlerta('error', 'Ambos campos son obligatorios');
            }
            // Verificar que las contraseñas coincidan
            elseif($_POST['password'] !== $_POST['password2']) {
                Usuario::setAlerta('error', 'Las contraseñas no coinciden');
            }
            else {
                // Validar el nuevo password (longitud mínima, etc.)
                $alertas = $usuario->validarPassword();
                if(empty($alertas)) {
                    // Hashear la nueva contraseña
                    $usuario->hashPassword();
                    // Eliminar el token para que no se pueda reutilizar
                    $usuario->token = null;
                    // Guardar la actualización en la BD
                    $resultado = $usuario->guardar();
    
                    if($resultado) {
                        Usuario::setAlerta('exito', 'Tu contraseña se actualizó correctamente');
                        // Redirigir a la página de login
                        header('Location: /login');
                        exit;
                    } else {
                        Usuario::setAlerta('error', 'Hubo un error al actualizar la contraseña, intenta de nuevo');
                    }
                }
            }
        }
    
        // Recuperar las alertas para pasarlas a la vista
        $alertas = Usuario::getAlertas();
    
        // Renderizar la vista "reestablecer"
        View::render('auth/reestablecer', [
            'title'      => 'Reestablecer Password',
            'alertas'     => $alertas,
            'token_valido'=> $token_valido
        ], 'layout.php');
    }
    

    public static function mensaje(Router $router) {
        View::render('auth/mensaje', [
            'title' => 'Cuenta Creada Exitosamente'
        ],'layout.php');
    }

    public static function confirmar(Router $router) {
        // Obtener el token de la URL y sanitizarlo
        $token = s($_GET['token'] ?? '');
    
        // Si no existe token, redirige a la página de inicio
        if (!$token) {
            header('Location: /');
            exit;
        }
    
        // Buscar al usuario asociado a este token
        $usuario = Usuario::where('token', $token);
    
        if (empty($usuario)) {
            // Si no se encuentra usuario, se configura una alerta de error
            Usuario::setAlerta('error', 'Token no válido, la cuenta no se confirmó');
        } else {
            // Confirmar la cuenta: se actualiza el estado y se limpia el token
            $usuario->confirmado = 1;
            $usuario->token = '';
            unset($usuario->password2);
            
            // Guardar los cambios en la base de datos
            $usuario->guardar();
            $email = $usuario->email;
    
            // Configurar una alerta de éxito
            Usuario::setAlerta('exito', 'Cuenta comprobada correctamente');
        }
    
        // Renderizar la vista "confirmar" pasando el título y las alertas
        View::render('auth/confirmar', [
            'title'  => 'Confirma tu cuenta DevWebcamp',
            'alertas' => Usuario::getAlertas(),
            'email' => $email
        ], 'layout.php');
    }
}