<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Sedes;
use App\Entity\Procesos;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\Response;

class ProcesosController extends AbstractController {

    public function index() {
        $usuario = null;
        if (array_key_exists('nombre', $_SESSION)) {
            $usuario = $_SESSION['nombre'];
        }

        $login = $this->acceso($usuario);

        return $this->render('procesos/index.html.twig', [
                    'login' => $login,
                    'usuario' => $usuario
        ]);
    }

    public function crear() {
        $usuario = null;
        if (array_key_exists('nombre', $_SESSION)) {
            $usuario = $_SESSION['nombre'];
        }
        $login = $this->acceso($usuario);

        return $this->render('procesos/crear.html.twig', [
                    'login' => $login,
                    'usuario' => $usuario
        ]);
    }

    public function nuevo() {
        $serial = $_POST['serial'];
        $descripcion = trim($_POST['descripcion']);
        $creacion = $_POST['creacion'];
        $presupuesto = $_POST['presupuesto'];
        $sede = $_POST['sede'];
        $validar = $this->validar($serial, $descripcion, $creacion, $presupuesto);
        $repository = $this->getDoctrine()->getRepository(Sedes::class);
        $sedeEntity = null;

        if (!empty($sede)) {
            $sedeEntity = $repository->findOneBy([
                'id' => $sede
            ]);
        }

        if (empty($presupuesto)) {
            $presupuesto = null;
        }

        if ($validar['res'] == true) {
            $entityManager = $this->getDoctrine()->getManager();
            $fechaCreacion = date('Y-m-d', strtotime($creacion));
            $proceso = new Procesos();
            $proceso->setDescripcion($descripcion);
            $proceso->setSerial($serial);
            $proceso->setCreacion(new \DateTime($fechaCreacion));
            $proceso->setSede($sedeEntity);
            $proceso->setPresupuesto($presupuesto);
            $entityManager->persist($proceso);
            $entityManager->flush();
            $res = json_encode(['msj' => 'El proceso fue almacenado', 'res' => true]);
        } else {
            $res = json_encode($validar);
        }
        return new Response(
                $res
        );
    }

    public function sedes() {
        $repository = $this->getDoctrine()->getRepository(Sedes::class);
        $sedes = $repository->findAll();

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize($sedes, 'json');
        $dataSedes = json_decode($jsonContent, true);
        $res = json_encode($dataSedes);
        return new Response(
                $res
        );
    }

    public function ver($id) {
        $usuario = null;
        if (array_key_exists('nombre', $_SESSION)) {
            $usuario = $_SESSION['nombre'];
        }

        $login = $this->acceso($usuario);
        
        $repository = $this->getDoctrine()->getRepository(Procesos::class);
        $proceso = $repository->find($id);
        return $this->render('procesos/show.html.twig', [
                    'proceso' => $proceso,
                    'login' => $login,
                    'usuario' => $usuario
                    
        ]);
    }

    public function tabla() {
        $repository = $this->getDoctrine()->getRepository(Procesos::class);
        $procesos = $repository->findAll();
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize($procesos, 'json');

        return new Response(
                $jsonContent
        );
    }

    private function validar($serial, $descripcion, $creacion, $presupuesto) {
        $repository = $this->getDoctrine()->getRepository(Procesos::class);

        if (empty($serial)) {
            return['msj' => 'El número de proceso es obligatorio', 'res' => false];
        }
        $proceso = $repository->findOneBy([
            'serial' => $serial
        ]);

        if (!empty($proceso)) {
            return['msj' => 'El número de proceso ya existe', 'res' => false];
        }

        if (strlen($serial) != 8) {
            return['msj' => 'La extensión del número de proceso debe ser 8', 'res' => false];
        }

        if (strlen($descripcion) > 200) {
            return['msj' => 'La extensión de la descripción debe ser menor de 200', 'res' => false];
        }

        if (empty($creacion)) {
            return['msj' => 'La fecha de creación es obligatoria', 'res' => false];
        }

        if (!empty($presupuesto)) {

            if (!is_numeric($presupuesto)) {
                return['msj' => 'El presupuesto debe ser numérico', 'res' => false];
            }
        }

        return['msj' => '', 'res' => true];
    }

    private function acceso($nombre) {
        if (!empty($nombre)) {
            return true;
        } else {
            return false;
        }
    }

}
