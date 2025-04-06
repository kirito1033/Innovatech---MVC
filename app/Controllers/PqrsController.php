<?php
namespace App\Controllers;
use App\Models\PqrsModel;
use App\Models\UsuarioModel;
use App\Models\TipoPqrsModel;
use App\Models\EstadoPqrsModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class PqrsController extends Controller
{
    private $primaryKey;
    private $PqrsModel;
    private $data;
    private $model;

    // Método constructor
    public function __construct()
    {
        $this->primaryKey = "id";
        $this->PqrsModel = new PqrsModel();
        $this->data = [];
        $this->model = "PqrsModel";
    }

    // Método index
    public function index()
    {
        $EstadoPqrs = new EstadoPqrsModel();
        $TipoPqrs  = new TipoPqrsModel();
        $Usuario = new UsuarioModel();
        
        $this->data['EstadoPqrs'] = $EstadoPqrs->findAll();
        $this->data['TipoPqrs'] = $TipoPqrs->findAll();
        $this->data['Usuario'] = $Usuario->findAll();

        $this->data["title"] = "PQRS";
        $this->data[$this->model] = $this->PqrsModel->orderBy($this->primaryKey, "ASC")->findAll();
        return view("pqrs/pqrs_view", $this->data);
    }

    // Método create
    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();
            if ($this->PqrsModel->insert($dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error creating PQRS";
                $data["response"] = ResponseInterface::HTTP_NO_CONTENT;
                $data["data"] = "";
            }
        } else {
            $data["message"] = "Error Ajax";
            $data["response"] = ResponseInterface::HTTP_CONFLICT;
            $data["data"] = "";
        }
        echo json_encode($data);
    }

    public function singlePqrs($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->PqrsModel->where($this->primaryKey, $id)->first()) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error fetching PQRS";
                $data["response"] = ResponseInterface::HTTP_NO_CONTENT;
                $data["data"] = "";
            }
        } else {
            $data["message"] = "Error Ajax";
            $data["response"] = ResponseInterface::HTTP_CONFLICT;
            $data["data"] = "";
        }
        echo json_encode($data);
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $today = date("Y-m-d H:i:s");
            $id = $this->request->getVar($this->primaryKey);
            $dataModel = [
                "descripcion" => $this->request->getVar("descripcion"),
                "comentario_respuesta" => $this->request->getVar("comentario_respuesta"),
                "updated_at" => $today
            ];
            if ($this->PqrsModel->update($id, $dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error updating PQRS";
                $data["response"] = ResponseInterface::HTTP_NO_CONTENT;
                $data["data"] = "";
            }
        } else {
            $data["message"] = "Error Ajax";
            $data["response"] = ResponseInterface::HTTP_CONFLICT;
            $data["data"] = "";
        }
        echo json_encode($data);
    }

    public function delete($id = null)
    {
        try {
            if ($this->PqrsModel->where($this->primaryKey, $id)->delete($id)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = "OK";
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error deleting PQRS";
                $data["response"] = ResponseInterface::HTTP_NO_CONTENT;
                $data["data"] = "error";
            }
        } catch (\Exception $e) {
            $data["message"] = $e->getMessage();
            $data["response"] = ResponseInterface::HTTP_CONFLICT;
            $data["data"] = "Error";
        }
        echo json_encode($data);
    }

    public function getDataModel()
    {
        $data = [
            "id" => $this->request->getVar("id"),
            "descripcion" => $this->request->getVar("descripcion"),
            "comentario_respuesta" => $this->request->getVar("comentario_respuesta"),
            "tipo_pqrs_id" => $this->request->getVar("tipo_pqrs_id"),
            "usuario_id" => $this->request->getVar("usuario_id"),
            "estado_pqrs_id" => $this->request->getVar("estado_pqrs_id"),
            "updated_at" => $this->request->getVar("updated_at")
        ];
        return $data;
    }
}
