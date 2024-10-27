<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\ResponseInterface;

class ProductController extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->helpers = ['form', 'url'];
    }

    public function index()
    {
        $data['title'] = 'Home';
        $data['products'] = $this->productModel->paginate();
        $data['pager'] = $this->productModel->pager;
        $data['perPage'] = 10; // Jumlah item per halaman
        $data['currentPage'] = $this->request->getVar('page') ?? 1;
        return view('products/index', $data);
    }

    public function create()
    {
        return view('products/create');
    }

    public function store()
    {
        $this->productModel->save([
            'product_name' => $this->request->getPost('product_name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'stock' => $this->request->getPost('stock'),
        ]);

        return redirect()->to('/products')->with('message', 'Produk berhasil ditambahkan');
    }

    public function update($id)
    {
        $this->productModel->update($id, [
            'product_name' => $this->request->getPost('product_name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'stock' => $this->request->getPost('stock'),
        ]);

        return redirect()->to('/products')->with('message', 'Produk berhasil diubah');
    }

    public function delete($id)
    {
        $this->productModel->delete($id);
        return redirect()->to('/products')->with('message', 'Produk berhasil dihapus');
    }

    public function datatableServerSide()
    {
        $curl = service('curlrequest');

        $response = $curl->request('GET', 'http://localhost:8080/API/products', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . session()->token,
            ],
        ]);

        $data = $response->getBody();

        return $data;
    }
}
