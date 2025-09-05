<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Lista de Recursos</h2>
    <a href="<?= base_url('recursos/create') ?>" class="btn btn-primary mb-3">Nuevo Recurso</a>

    <?php if(session()->getFlashdata('success')): ?>
        <script>
            Swal.fire("Éxito", "<?= session()->getFlashdata('success') ?>", "success");
        </script>
    <?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Editorial</th>
                <th>Categoría</th>
                <th>Subcategoría</th>
                <th>Tipo</th>
                <th>Año</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($recursos as $r): ?>
            <tr>
                <td><?= $r['id_recurso'] ?></td>
                <td><?= $r['titulo'] ?></td>
                <td><?= $r['editorial'] ?></td>
                <td><?= $r['categoria'] ?></td>
                <td><?= $r['subcategoria'] ?></td>
                <td><?= $r['tipo'] ?></td>
                <td><?= $r['apublicacion'] ?></td>
                <td>
                    <a href="<?= base_url('recursos/edit/'.$r['id_recurso']) ?>" class="btn btn-sm btn-warning">Editar</a>
                    <a href="<?= base_url('recursos/delete/'.$r['id_recurso']) ?>" 
                       onclick="return confirmDelete(event)" 
                       class="btn btn-sm btn-danger">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
function confirmDelete(e) {
    e.preventDefault();
    const url = e.target.href;
    Swal.fire({
        title: '¿Está seguro?',
        text: "No podrá revertir esto",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}
</script>

<?= $this->endSection() ?>
