<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Nuevo Recurso</h2>
    <form action="<?= base_url('recursos/store') ?>" method="post">
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" id="titulo" class="form-control" value="<?= old('titulo') ?>">
            <?php if(isset(session('errors')['titulo'])): ?>
                <div class="text-danger"><?= session('errors')['titulo'] ?></div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="isbn" class="form-label">ISBN</label>
            <input type="text" name="isbn" id="isbn" class="form-control" value="<?= old('isbn') ?>">
            <?php if(isset(session('errors')['isbn'])): ?>
                <div class="text-danger"><?= session('errors')['isbn'] ?></div>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="<?= base_url('recursos') ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?= $this->endSection() ?>
