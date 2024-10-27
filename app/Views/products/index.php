<?= $this->extend('layout/app') ?>
<?= $this->section('content') ?>

<body>
    <div class="container">
        <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
            <?php echo session()->getFlashdata('error'); ?>
        </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('message')) : ?>
        <div class="alert alert-success">
            <?php echo session()->getFlashdata('message'); ?>
        </div>
        <?php endif; ?>

        <div class="table-responsive">
            <h3 class="p-3">List Produk</h3>
            <div class="d-flex justify-content-end m-2">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#modalTambahProduk">
                    Tambah
                </button>
            </div>
            <div class="modal fade" id="modalTambahProduk" tabindex="-1" data-bs-backdrop="static"
                data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitleId">
                                Tambah Produk
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <?= form_open('products/store') ?>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" id="product_name" name="product_name"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Harga</label>
                                <input type="number" class="form-control" id="price" name="price" step="0.01"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stok</label>
                                <input type="number" class="form-control" id="stock" name="stock" required>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>

            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th class="text-center">Aksi</th>
                </tr>
                <?php 
                $no = ($currentPage - 1) * $perPage + 1;
                foreach ($products as $product): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $product['product_name'] ?></td>
                    <td><?= $product['description'] ?></td>
                    <td><?= $product['price'] ?></td>
                    <td><?= $product['stock'] ?></td>
                    <td style="width: 15%;">
                        <a class="btn btn-sm btn-success" data-bs-target="#modalEdit<?= $product['id'] ?>"
                            data-bs-toggle="modal" href="#">Edit</a>
                        <a class="btn btn-sm btn-danger" href="<?= base_url('products/delete/' . $product['id']) ?>"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</a>

                        <div class="modal fade" id="modalEdit<?= $product['id'] ?>" tabindex="-1" data-bs-backdrop="static"
                            data-bs-keyboard="false" role="dialog"  aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <?= form_open('products/update/' . $product['id']) ?>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="product_name" class="form-label">Nama Produk</label>
                                            <input type="text" class="form-control" id="product_name"
                                                name="product_name" value="<?= $product['product_name']?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Deskripsi</label>
                                            <textarea class="form-control" id="description" name="description" rows="3" required> <?= $product['description']?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Harga</label>
                                            <input type="number" class="form-control" id="price" name="price" value="<?= $product['price']?>"
                                                step="0.01" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="stock" class="form-label">Stok</label>
                                            <input type="number" class="form-control" id="stock" name="stock" value="<?= $product['stock']?>"
                                                required>
                                        </div>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-success">Ubah</button>
                                    </div>
                                    <?= form_close() ?>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <div>
                <?= $pager->links('products', 'bootstrap_pagination') ?>
            </div>
        </div>
    </div>
</body>

<?= $this->endSection() ?>
