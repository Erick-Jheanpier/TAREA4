<?php
namespace App\Controllers;

use App\Models\RecursoModel;
use App\Models\EditorialModel;
use App\Models\CategoriaModel;
use App\Models\SubcategoriaModel;
use CodeIgniter\Controller;

class RecursosController extends Controller
{
    public function index()
    {
        $model = new RecursoModel();
        $data['recursos'] = $model
            ->select('recursos.*, editoriales.editorial, categorias.categoria, subcategorias.subcategoria')
            ->join('editoriales', 'recursos.id_editorial = editoriales.id_editorial')
            ->join('subcategorias', 'recursos.id_subcategoria = subcategorias.id_subcategoria')
            ->join('categorias', 'subcategorias.id_categoria = categorias.id_categoria')
            ->findAll();

        return view('recursos/index', $data);
    }

    public function create()
    {
        return view('recursos/create');
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'titulo' => 'required|min_length[3]',
            'isbn'   => 'required|is_unique[recursos.isbn]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $model = new RecursoModel();
        $model->save($this->request->getPost());

        return redirect()->to('/recursos')->with('success', 'Recurso creado correctamente');
    }

    public function edit($id)
    {
        $model = new RecursoModel();
        $data['recurso'] = $model->find($id);
        return view('recursos/edit', $data);
    }

    public function update($id)
    {
        $validation = \Config\Services::validation();
        $rules = [
            'titulo' => 'required|min_length[3]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $model = new RecursoModel();
        $model->update($id, $this->request->getPost());

        return redirect()->to('/recursos')->with('success', 'Recurso actualizado correctamente');
    }

    public function delete($id)
    {
        $model = new RecursoModel();
        $model->delete($id);
        return redirect()->to('/recursos')->with('success', 'Recurso eliminado correctamente');
    }
}
