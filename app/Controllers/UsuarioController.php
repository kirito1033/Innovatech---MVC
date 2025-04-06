<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\EstadoUsuarioModel;
use App\Models\RolModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TipoDocumentoModel;
use App\Models\CiudadModel;

class UsuarioController extends Controller
{
    private $primaryKey;
    private $UsuarioModel;
    private $data;
    private $model;

    public function __construct()
    {
        $this->primaryKey = "id_usuario";
        $this->UsuarioModel = new UsuarioModel();
        $this->data = [];
        $this->model = "UsuarioModel";
    }

    public function index()
    {
        $this->data['title'] = "Usuarios";
        $this->data[$this->model] = $this->UsuarioModel->orderBy($this->primaryKey, 'ASC')->findAll();
        
        $TipoDocumento = new TipoDocumentoModel();
        $Ciudad  = new CiudadModel();
        $Rol = new RolModel();
        $EstadoUsuario = new EstadoUsuarioModel();
        
        $this->data['Rol'] = $Rol->findAll();
        $this->data['EstadoUsuario'] = $EstadoUsuario->findAll();
        $this->data['TipoDocumento'] = $TipoDocumento->findAll();
        $this->data['Ciudad'] = $Ciudad->findAll();
        
        return view('usuario/usuario_view', $this->data);
    }

    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();
            if ($this->UsuarioModel->insert($dataModel)) {
                $data['message'] = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['data'] = $dataModel;
                $data['csrf'] = csrf_hash();
            } else {
                $data['message'] = 'Error al crear usuario';
                $data['response'] = ResponseInterface::HTTP_NO_CONTENT;
                $data['data'] = '';
            }
        } else {
            $data['message'] = 'Error Ajax';
            $data['response'] = ResponseInterface::HTTP_CONFLICT;
            $data['data'] = '';
        }
        echo json_encode($data);
    }

    public function singleUsuario($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->UsuarioModel->where($this->primaryKey, $id)->first()) {
                $data['message'] = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['csrf'] = csrf_hash();
            } else {
                $data['message'] = 'Error al obtener usuario';
                $data['response'] = ResponseInterface::HTTP_NO_CONTENT;
                $data['data'] = '';
            }
        } else {
            $data['message'] = 'Error Ajax';
            $data['response'] = ResponseInterface::HTTP_CONFLICT;
            $data['data'] = '';
        }
        echo json_encode($data);
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar($this->primaryKey);
            $dataModel = $this->getDataModel();
            if ($this->UsuarioModel->update($id, $dataModel)) {
                $data['message'] = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['data'] = $dataModel;
                $data['csrf'] = csrf_hash();
            } else {
                $data['message'] = 'Error al actualizar usuario';
                $data['response'] = ResponseInterface::HTTP_NO_CONTENT;
                $data['data'] = '';
            }
        } else {
            $data['message'] = 'Error Ajax';
            $data['response'] = ResponseInterface::HTTP_CONFLICT;
            $data['data'] = '';
        }
        echo json_encode($data);
    }

    public function delete($id = null)
    {
        try {
            if ($this->UsuarioModel->where($this->primaryKey, $id)->delete($id)) {
                $data['message'] = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['data'] = 'OK';
                $data['csrf'] = csrf_hash();
            } else {
                $data['message'] = 'Error al eliminar usuario';
                $data['response'] = ResponseInterface::HTTP_CONFLICT;
                $data['data'] = 'error';
            }
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            $data['response'] = ResponseInterface::HTTP_CONFLICT;
            $data['data'] = 'Error';
        }
        echo json_encode($data);
    }

    public function getDataModel()
    {
        return [
            'primer_nombre' => $this->request->getVar('primer_nombre'),
            'segundo_nombre' => $this->request->getVar('segundo_nombre'),
            'primer_apellido' => $this->request->getVar('primer_apellido'),
            'segundo_apellido' => $this->request->getVar('segundo_apellido'),
            'documento' => $this->request->getVar('documento'),
            'correo' => $this->request->getVar('correo'),
            'telefono1' => $this->request->getVar('telefono1'),
            'telefono2' => $this->request->getVar('telefono2'),
            'direccion' => $this->request->getVar('direccion'),
            'usuario' => $this->request->getVar('usuario'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'tipo_documento_id' => $this->request->getVar('tipo_documento_id'),
            'ciudad_id' => $this->request->getVar('ciudad_id'),
            'rol_id' => $this->request->getVar('rol_id'),
            'estado_usuario_id' => $this->request->getVar('estado_usuario_id'),
            'updated_at' => date("Y-m-d H:i:s")
        ];
    }
}
