<?php

namespace App\Controllers;

use App\Models\ProductosModel;
use App\Models\AlmacenamientoAleatorioModel;
use App\Models\AlmacenamientoModel;
use App\Models\CategoriaModel;
use App\Models\ColorModel;
use App\Models\EstadoProductoModel;
use App\Models\GarantiaModel;
use App\Models\MarcaModel;
use App\Models\SistemaOperativoModel;
use App\Models\ResolucionModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class ProductoController extends Controller
{
    private $primaryKey;
    private $productosModel;
    private $almacenamientoAleatorioModel;
    private $almacenamientoModel;
    private $categoriaModel;
    private $colorModel;
    private $estadoProductoModel;
    private $garantiaModel;
    private $marcaModel;
    private $sistemaOperativoModel;
    private $resolucionModel;
    private $data;

    // Método constructor
    public function __construct()
    {
        $this->primaryKey = "id";
        $this->productosModel = new ProductosModel();
        $this->almacenamientoAleatorioModel = new AlmacenamientoAleatorioModel();
        $this->almacenamientoModel = new AlmacenamientoModel();
        $this->categoriaModel = new CategoriaModel();
        $this->colorModel = new ColorModel();
        $this->estadoProductoModel = new EstadoProductoModel();
        $this->garantiaModel = new GarantiaModel();
        $this->marcaModel = new MarcaModel();
        $this->sistemaOperativoModel = new SistemaOperativoModel();
        $this->resolucionModel = new ResolucionModel();
        $this->data = [];
        $this->model = "productos";
    }

    // Método index
    public function index()
    {
        $this->data["title"] = "PRODUCTOS";
        $this->data["productos"] = $this->productosModel->orderBy($this->primaryKey, "ASC")->findAll();
        $this->data["almacenamiento_aleatorio"] = $this->almacenamientoAleatorioModel->findAll();
        $this->data["almacenamiento"] = $this->almacenamientoModel->findAll();
        $this->data["categorias"] = $this->categoriaModel->findAll();
        $this->data["colores"] = $this->colorModel->findAll();
        $this->data["estado_productos"] = $this->estadoProductoModel->findAll();
        $this->data["garantias"] = $this->garantiaModel->findAll();
        $this->data["marcas"] = $this->marcaModel->findAll();
        $this->data["sistemas_operativos"] = $this->sistemaOperativoModel->findAll();
        $this->data["resoluciones"] = $this->resolucionModel->findAll();

        return view("producto/producto_view", $this->data);
    }

    // Método create
    public function create()
{
    if ($this->request->isAJAX()) {
        $dataModel = $this->getDataModel();
        
        // Manejo de imagen
        $img = $this->request->getFile('imagen');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            $img->move(ROOTPATH . 'public/uploads/', $newName);
            $dataModel["imagen"] = $newName;
        }

        if ($this->productosModel->insert($dataModel)) {
            $data["message"] = "success";
            $data["response"] = ResponseInterface::HTTP_OK;
            $data["data"] = $dataModel;
            $data["csrf"] = csrf_hash();
        } else {
            $data["message"] = "Error al crear producto";
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

    // Método para obtener un solo producto
    public function singleProducto($id = null)
    {
        
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->productosModel->where($this->primaryKey, $id)->first()) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al obtener producto";
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

    // Método update
    public function update()
    {
        if ($this->request->isAJAX()) {
            $today = date("Y-m-d H:i:s");
            $id = $this->request->getVar($this->primaryKey);
            $dataModel = [
                "id" => $this->request->getVar("id"),
                    "nom" => $this->request->getVar("nom"),
                    "descripcion" => $this->request->getVar("descripcion"),
                    "existencias" => $this->request->getVar("existencias"),
                    "precio" => $this->request->getVar("precio"),
                    "caracteristicas" => $this->request->getVar("caracteristicas"),
                    "tam" => $this->request->getVar("tam"),
                    "tampantalla" => $this->request->getVar("tampantalla"),
                    "id_marca" => $this->request->getVar("id_marca"),
                    "id_estado" => $this->request->getVar("id_estado"),
                    "id_color" => $this->request->getVar("id_color"),
                    "id_categoria" => $this->request->getVar("id_categoria"),
                    "id_garantia" => $this->request->getVar("id_garantia"),
                    "id_almacenamiento" => $this->request->getVar("id_almacenamiento"),
                    "id_ram" => $this->request->getVar("id_ram"),
                    "id_sistema_operativo" => $this->request->getVar("id_sistema_operativo"),
                    "id_resolucion" => $this->request->getVar("id_resolucion"),
                "updated_at" => $today
            ];
            if ($this->productosModel->update($id, $dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al actualizar producto";
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

    // Método delete
    public function delete($id = null)
    {
      
      
        try {
            if ($this->productosModel->where($this->primaryKey, $id)->delete($id)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = "OK";
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error al eliminar producto";
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

    // Método para obtener los datos enviados en el formulario
    public function getDataModel()
    {
        $data = [
            "id" => $this->request->getVar("id"),
            "nom" => $this->request->getVar("nom"),
            "descripcion" => $this->request->getVar("descripcion"),
            "existencias" => $this->request->getVar("existencias"),
            "precio" => $this->request->getVar("precio"),
            "caracteristicas" => $this->request->getVar("caracteristicas"),
            "tam" => $this->request->getVar("tam"),
            "tampantalla" => $this->request->getVar("tampantalla"),
            "id_marca" => $this->request->getVar("id_marca"),
            "id_estado" => $this->request->getVar("id_estado"),
            "id_color" => $this->request->getVar("id_color"),
            "id_categoria" => $this->request->getVar("id_categoria"),
            "id_garantia" => $this->request->getVar("id_garantia"),
            "id_almacenamiento" => $this->request->getVar("id_almacenamiento"),
            "id_ram" => $this->request->getVar("id_ram"),
            "id_sistema_operativo" => $this->request->getVar("id_sistema_operativo"),
            "id_resolucion" => $this->request->getVar("id_resolucion"),
            "updated_at" => date("Y-m-d H:i:s")
        ];
        return $data;
    }
    
    public function updateImage()
    {

    if ($this->request->isAJAX()) {

      
        $id = $this->request->getVar('id');

        // Verificar si el producto existe
        $producto = $this->productosModel->find($id);
        if (!$producto) {
            return $this->response->setJSON([
                'message' => 'Producto no encontrado',
                'response' => ResponseInterface::HTTP_NOT_FOUND
            ]);
        }

        // Obtener imagen
        $img = $this->request->getFile('imagen');

        if ($img && $img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            $img->move(ROOTPATH . 'public/uploads/', $newName);
          
            // Actualizar en la base de datos
            $this->productosModel->update($id, ['imagen' => $newName]);

            return $this->response->setJSON([
                'message' => 'success',
                'response' => ResponseInterface::HTTP_OK,
                'csrf' => csrf_hash(),
                'imagen' => $newName
            ]);
        } else {
            return $this->response->setJSON([
                'message' => 'Error al subir imagen',
                'response' => ResponseInterface::HTTP_NO_CONTENT
            ]);
        }
    }

    return $this->response->setJSON([
        'message' => 'Petición inválida',
        'response' => ResponseInterface::HTTP_BAD_REQUEST
    ]);
}

public function ver($id = null)
{
    $productoModel = new ProductosModel();
    $categoriaModel = new CategoriaModel();
    $session = session();
    
    $data['usuario'] = $session->get('usuario'); // O $data['session'] = $session->get();
    $data['categorias'] = $categoriaModel->findAll();
    $data['producto'] = $productoModel->getProductoConRelaciones($id);

    if (!$data['producto']) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Producto con ID $id no encontrado");
    }

 
    return view('producto/ver', $data);
}
public function preguntar($id)
{
    $pregunta = $this->request->getPost('pregunta');
    return redirect()->to("/producto/ver/$id")->with('message', 'Pregunta enviada');
}
}

   
