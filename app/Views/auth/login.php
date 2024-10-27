<?= $this->extend('layout/app') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center" style="font-weight: bold;">LOGIN</h4>
                    <hr>
                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success">
                            <?php echo session()->getFlashdata('success'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger">
                            <?php echo session()->getFlashdata('error'); ?>
                        </div>
                    <?php endif; ?>

                    <?= validation_list_errors() ?>

                    <?= form_open('auth/login/loginAction'); ?>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="username" name="username" class="form-control" required>
                    </div>
                    <div class="form-group mb-1">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-primary">Login</button>
                    </div>
                    <?= form_close(); ?>

                </div>

            </div>
            <div class="text-center mt-2">
                Belum punya akun? <a href="<?php echo base_url('auth/register'); ?>">Silakan daftar.</a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>