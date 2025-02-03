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
                header('Location: /finalizar-registro');
            }
            exit;
        }

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

        // Obtener las alertas configuradas (errores o mensajes de información)
        $alertas = Usuario::getAlertas();

        // Renderizar la vista de login pasándole las alertas y el título
        View::render('auth/login', [
            'title'    => 'Iniciar Sesión',
            'alertas'  => $alertas
        ], 'empty-layout.php');
    }

    public static function logout() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $_SESSION = [];
            header('Location: /');
        }
       
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
            'titulo'   => 'Crea tu cuenta',
            'usuario'  => $usuario,
            'alertas'  => $alertas
        ], 'empty-layout.php');
    }
    
    public static function olvide(Router $router) {
        $alertas = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();

            if(empty($alertas)) {
                // Buscar el usuario
                $usuario = Usuario::where('email', $usuario->email);

                if($usuario && $usuario->confirmado) {

                    // Generar un nuevo token
                    $usuario->crearToken();
                    unset($usuario->password2);

                    // Actualizar el usuario
                    $usuario->guardar();

                    // Enviar el email
                    $email = new Email( $usuario->email, $usuario->nombre, $usuario->token );
                    $email->enviarInstrucciones();


                    // Imprimir la alerta
                    // Usuario::setAlerta('exito', 'Hemos enviado las instrucciones a tu email');

                    $alertas['exito'][] = 'Hemos enviado las instrucciones a tu email';
                } else {
                 
                    // Usuario::setAlerta('error', 'El Usuario no existe o no esta confirmado');

                    $alertas['error'][] = 'El Usuario no existe o no esta confirmado';
                }
            }
        }

        // Muestra la vista
        View::render('auth/olvide', [
            'titulo' => 'Olvide mi Password',
            'alertas' => $alertas
        ],'empty-layout.php');
    }

    public static function reestablecer(Router $router) {

        $token = s($_GET['token']);

        $token_valido = true;

        if(!$token) header('Location: /');

        // Identificar el usuario con este token
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            Usuario::setAlerta('error', 'Token No Válido, intenta de nuevo');
            $token_valido = false;
        }


        if($_SERVER['REQUEST_METHOD'] === 'POST' && $token_valido) {
            if(empty($_POST['password2'])){
                Usuario::setAlerta('error', 'Confirmar contraseña es obligatorio');
            }
            if($_POST['password'] === $_POST['password2']){
                $usuario->sincronizar($_POST);
                // Validar el password
                $alertas = $usuario->validarPassword();

                if(empty($alertas)) {
                    // Hashear el nuevo password
                    $usuario->hashPassword();

                    // Eliminar el Token
                    $usuario->token = null;

                    // Guardar el usuario en la BD
                    $resultado = $usuario->guardar();

                    // Redireccionar
                    if($resultado) {
                        header('Location: /login');
                    }
                }
            }
            else{
                Usuario::setAlerta('error', 'Las contraseñas no coinciden');
            }
        }

        $alertas = Usuario::getAlertas();
        
        // Muestra la vista
        View::render('auth/reestablecer', [
            'titulo' => 'Reestablecer Password',
            'alertas' => $alertas,
            'token_valido' => $token_valido
        ],'empty-layout.php');
    }

    public static function mensaje(Router $router) {
        View::render('auth/mensaje', [
            'titulo' => 'Cuenta Creada Exitosamente'
        ],'empty-layout.php');
    }

    public static function confirmar(Router $router) {
        
        $token = s($_GET['token']);

        if(!$token) header('Location: /');

        // Encontrar al usuario con este token
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            // No se encontró un usuario con ese token
            Usuario::setAlerta('error', 'Token No Válido, la cuenta no se confirmó');
        } else {
            // Confirmar la cuenta
            $usuario->confirmado = 1;
            $usuario->token = '';
            unset($usuario->password2);
            
            // Guardar en la BD
            $usuario->guardar();

            Usuario::setAlerta('exito', 'Cuenta Comprobada Correctamente');
        }

        View::render('auth/confirmar', [
            'titulo' => 'Confirma tu cuenta DevWebcamp',
            'alertas' => Usuario::getAlertas()
        ],'empty-layout.php');
    }
}