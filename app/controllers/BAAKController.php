<?php
include_once 'app/models/BAAKModel.php';

class BAAKController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new BAAKModel($db);
    }

    public function index()
    {
        $result = $this->model->getAll();
        include 'app/views/baak/index.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->nama = $_POST['nama'];
            $this->model->username = $_POST['username'];
            $this->model->password = $_POST['password'];
            $this->model->email = $_POST['email'];
            $this->model->no_telepon = $_POST['no_telepon'];
            if ($this->model->create()) {
                header("Location: /siptam/baak");
                exit;
            }
        }
        include 'app/views/baak/tambah.php';
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->id = $id;
            $this->model->nama = $_POST['nama'];
            $this->model->username = $_POST['username'];
            $this->model->password = $_POST['password'];
            $this->model->email = $_POST['email'];
            $this->model->no_telepon = $_POST['no_telepon'];
            if ($this->model->update()) {
                header("Location: /siptam/baak");
                exit;
            }
        }
        $baak = $this->model->getById($id);
        include 'app/views/baak/edit.php';
    }

    public function delete($id)
    {
        $this->model->id = $id;
        if ($this->model->delete()) {
            header("Location: /siptam/baak");
            exit;
        }
    }
}
