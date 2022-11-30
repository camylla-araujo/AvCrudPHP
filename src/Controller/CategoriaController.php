<?php

declare(strict_types=1);
namespace App\Controller;
use App\Model\Categoria;
use App\Repository\CategoriaRepository;
use Dompdf\Dompdf;
use Exception;

class CategoriaController extends AbstractController
{
    private CategoriaRepository $repository;

    public function __construct()
    {
        $this->repository = new CategoriaRepository();
    }

    public function listar(): void
    {
        // $repository = new CategoriaRepository();
        $categorias = $this->repository->buscarTodos();
        $this->render('categoria/listar', [
            'categorias' => $categorias,
        ]);
    }

    public function cadastrar(): void
    {
        if(true === empty($_POST)){
            $this->render('categoria/cadastrar');
            return;
        }

        $categoria = new Categoria();
        $categoria->nome = $_POST['nome'];
        $categoria->vagas = $_POST['vagas'];
        $categoria->localidade = $_POST['localidade'];

        // $repository = new CategoriaRepository();
        try {
            $this->repository->inserir($categoria);
        } catch (Exception) {
           
        }
        $this->redirect('/categorias/listar');
    }

    public function editar(): void
    {
        $id = $_GET['id'];
        // $repository = new CategoriaRepository();
        $categoria = $this->repository->buscarUm($id);
        $this->render('categoria/editar', [$categoria]);

        if (false === empty($_POST)) {
            $categoria->nome = $_POST['nome'];
            $categoria->vagas = $_POST['vagas'];
            $categoria->localidade = $_POST['localidade'];

            try{
                $this->repository->atualizar($categoria, $id);
            } catch(Exception $exception) {
    
            }
            $this->redirect('/categorias/listar');
        }
    }

    public function excluir(): void
    {
        $id = $_GET['id'];
        // $repository = new CategoriaRepository();
        $this->repository->excluir($id);
        $this->redirect("\categorias\listar");
    }

    private function redirecionar(iterable $categorias){
        $resultado = '';
        foreach ($categorias as $categorias) {
        $resultado .= "
            <tr>
                <td>{$categorias->id}</td>
                <td>{$categorias->nome}</td>
                <td>{$categorias->vagas}</td>
                <td>{$categorias->localidade}</td>
            </tr>";
            }
            return $resultado;
    }

    public function pdf():void
    {
       $dados = $this->repository->buscarTodos();
       $this->relatorio("categoria", [
           'categorias' => $dados,
       ]);
    }
}