<?php

namespace App\Controllers;

use App\Models\UserStatusModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class UserStatus extends Controller
{
    private $primaryKey;
    private $StatusModel;
    private $data;
    private $model;

    //Metodo constructor
    public function __construct()
    {
        $this->primaryKey = "User_status_id";
        $this->StatusModel = new UserStatusModel();
        $this->data = [];
        $this->model = "userStatus";
    }

    //Metodo index
    public function index()
    {
        $this->data["title"] = "USER STATUS";
        $this->data[$this->model] = $this->StatusModel->orderBy($this->primaryKey, "ASC")->findAll();
        return view("userStatus/status_view", $this->data);
    }

    //Metodo create
    public function create()
    {
        if ($this->request->isAJAX()) {
            $dataModel = $this->getDataModel();
            if ($this->StatusModel->insert($dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = $csrf_hash();
            } else {
                $data["message"] = "Error create user";
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

    public function singleUserStatus($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->StatusModel->where($this->primaryKey, $id)->first()) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["csrf"] = csrf_hash();
            } else {
                $data["message"] = "Error create user";
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
                "User_status_name" => $this->request->getVar("User_status_name"),
                "User_status_description" => $this->request->getVar("User_status_description"),
                "update_at" => $today
            ];
            if ($this->StatusModel->update($id, $dataModel)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = $dataModel;
                $data["csrf"] = $csrf_hash();
            } else {
                $data["message"] = "Error create user";
                $data["response"] = ResponseInterface::HTTP_NO_CONTENT;
                $data["data"] = "";
            }
        } else {
            $data["message"] = "Error Ajax";
            $data["response"] = ResponseInterface::HTTP_CONFLICT;
            $data["data"] = "";
        }
        echo json_encode($dataModel);
    }

    public function delete($id = null)
    {
        try {
            if ($this->StatusModel->where($this->primaryKey, $id)->delete($id)) {
                $data["message"] = "success";
                $data["response"] = ResponseInterface::HTTP_OK;
                $data["data"] = "OK";
                $data["csrf"] = $csrf_hash();
            } else {
                $data["message"] = "Error create user";
                $data["response"] = ResponseInterface::HTTP_NO_CONTENT;
                $data["data"] = "error";
            }
        } catch (\Exception $e) {
            $data["message"] = $e;
            $data["response"] = ResponseInterface::HTTP_CONFLICT;
            $data["data"] = "Error";
        }
        echo json_encode($data);
    }

    public function getDataModel()
    {
        $data = [
            "User_status_id" => $this->request->getVar("User_status_id"),
            "User_status_name" => $this->request->getVar("User_status_name"),
            "User_status_description" => $this->request->getVar("User_status_description"),
            "update_at" => $this->request->getVar("update_at")
        ];
        return $data;
    }
}