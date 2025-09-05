<?php
namespace App\Models;

use CodeIgniter\Model;

class RecursoModel extends Model
{
    protected $table      = 'recursos';
    protected $primaryKey = 'id_recurso';
    protected $allowedFields = [
        'id_subcategoria',
        'id_editorial',
        'tipo',
        'titulo',
        'apublicacion',
        'isbn',
        'numpaginas',
        'rutaportada',
        'rutarecurso',
        'estado'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'creado';
    protected $updatedField  = 'modificado';
}
