<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class ProductController extends ResourceController
{
    use ResponseTrait;

    protected $modelName = 'App\Models\ProductModel';
    protected $format = 'json';

    public function index()
    {
        $products = $this->model->findAll();
        return $this->respond($products);
    }

    public function show($id = null)
    {
        $product = $this->model->find($id);
        if (!$product) {
            return $this->failNotFound('Not Found');
        }
        return $this->respond($product);
    }

    public function create()
    {
        $data = $this->request->getPost();

        if ($this->model->insert($data)) {
            $data['id'] = $this->model->getInsertID();
            return $this->respondCreated(['message'=>'sukses menambah data']);
        }

        return $this->failValidationErrors($this->model->errors());
    }

    public function update($id = null)
    {
        $product = $this->model->find($id);

        if (!$product) {
            return $this->failNotFound('Not Found');
        }

        if ($this->model->update($id, [
            'product_name' => $this->request->getVar('product_name'),
            'description' => $this->request->getVar('description'),
            'price' => $this->request->getVar('price'),
            'stock' => $this->request->getVar('stock'),
        ])) {
            return $this->respondUpdated(['message'=>'sukses mengubah data']);
        }

        return $this->failValidationErrors($this->model->errors());
    }

    public function delete($id = null)
    {
        $product = $this->model->find($id);

        if (!$product) {
            return $this->failNotFound('Not Found');
        }

        $this->model->delete($id);
        return $this->respondDeleted(['id' => $id, 'message' => 'Berhasil dihapus']);
    }
}
