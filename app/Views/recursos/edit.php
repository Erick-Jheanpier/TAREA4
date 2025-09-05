<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Editar Recurso</h2>
    <form action="<?= base_url('recursos/update/'.$recurso['id_recurso']) ?>" method="post">
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" id="titulo" class="form-control" 
                   value="<?= old('titulo', $recurso['titulo']) ?>">
            <?php if(isset(session('errors')['titulo'])): ?>
                <div class="text-danger"><?= session('errors')['titulo'] ?></div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="isbn" class="form-label">ISBN</label>
            <input type="text" name="isbn" id="isbn" class="form-control" 
                   value="<?= old('isbn', $recurso['isbn']) ?>">
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="<?= base_url('recursos') ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?= $this->endSection() ?>
