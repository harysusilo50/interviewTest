<?= $this->extend('layout/app') ?>
<?= $this->section('content') ?>
<body>
    <div class="container">
        <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
            <?php echo session()->getFlashdata('error'); ?>
        </div>
        <?php endif; ?>

        <h3 class="p-3">Selamat Datang, <?= session()->name?> !</h3>
    </div>
</body>

<?= $this->endSection() ?>
