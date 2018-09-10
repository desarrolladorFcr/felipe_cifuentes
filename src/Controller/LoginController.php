<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Usuarios;

class LoginController extends AbstractController {

    public function index() {
        $nombre = null;
        if(array_key_exists('nombre', $_SESSION)){
            $nombre = $_SESSION['nombre'];
        }
        
        if (!empty($nombre)) {
            $login = true;
        } else {
            $login = false;
        }

        return $this->render('login/index.html.twig', [
                    'login' => $login,
        ]);
    }

    public function acceso() {
        $correo = $_POST['correo'];
        $psw = $_POST['psw'];
        $repository = $this->getDoctrine()->getRepository(Usuarios::class);
        $usuario = $repository->findOneBy([
            'correo' => $correo
        ]);

        if (!empty($usuario)) {
            $pasword = $usuario->getPsw();
            $ingresada = md5($psw);
            $val = strcmp($pasword, $ingresada);

            if ($val == 0) {
                $_SESSION['nombre'] = $usuario->getNombre();
                $_SESSION['correo'] = $usuario->getCorreo();
                $_SESSION['idusu'] = $usuario->getId();
                $res = [
                    'data' => '',
                    'res' => true
                ];
            } else {
                $res = [
                    'data' => "Contraseña incorrecta",
                    'res' => false
                ];
            }
        } else {
            $res = [
                'data' => 'No hay usuarios con ese correo',
                'res' => false
            ];
        }
        $json_res = json_encode($res);
        return new Response(
                $json_res
        );
    }

    public function salida() {
        session_destroy();
        return $this->render('login/index.html.twig', [
                    'login' => false
        ]);
    }

}

