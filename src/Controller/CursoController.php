<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Curso;
use App\Repository\CategoriaRepository;
use App\Repository\CursoRepository;
use Dompdf\Dompdf;
use Exception;


class CursoController extends AbstractController
{

    private CursoRepository $repository;

    public function __construct()
    {
        $this->repository = new CursoRepository();
    }

    public function listar(): void
    {
        // $this->checkLogin();
        $rep = new CursoRepository();
        $cursos = $rep->buscarTodos();

        $this->render("curso/listar", [
            'cursos' => $cursos,
        ]);
    }

    public function cadastrar(): void
    {
        
        $rep = new CategoriaRepository();
        if (true === empty($_POST)) {
            $categorias = $rep->buscarTodos();
            $this->render("/curso/cadastrar", ['categorias' => $categorias]);
            return;
        }

        $curso = new Curso();
        $curso->nome = $_POST['nome'];
        $curso->descricao = $_POST['descricao'];
        $curso->cargaHoraria = intval($_POST['cargaHoraria']);
        $curso->categoria_id = intval($_POST['categoria']);

        $this->repository->inserir($curso);
        // try {
        // } catch (Exception $exception) {
        //     var_dump($exception->getMessage());
        //     // if (true === str_contains($exception->getMessage(), 'cpf')) {
        //     //     die('CPF ja existe');
        //     // }

        //     // if (true === str_contains($exception->getMessage(), 'email')) {
        //     //     die('Email ja existe');
        //     // }

        //     die('Vish, aconteceu um erro');
        // }

        $this->redirect('/cursos/listar');
    }

    public function excluir(): void
    {
        echo "Pagina de excluir";
    }

    public function editar(): void
    {
        $id = $_GET['id'];
        $rep = new CategoriaRepository();
        $categorias = $rep->buscarTodos();
        $curso = $this->repository->buscarUm($id);
        $this->render("/curso/editar", [
            'categorias' => $categorias,
            'curso' => $curso
        ]);
        if (false === empty($_POST)) {
            $curso = new Curso();
            $curso->nome = $_POST['nome'];
            $curso->descricao = $_POST['descricao'];
            $curso->cargaHoraria = intval($_POST['cargaHoraria']);
            $curso->categoria_id = intval($_POST['categoria']);
            $this->repository->atualizar($curso, $id);
            $this->redirect('/cursos/listar');
        }
    }
    public function relatorio(): void
    {
        $hoje = date('d/m/Y');

        $cursos = $this->repository->buscarTodos();

        $design = "
            <h1>Relatorio de Cursos</h1>
            <hr>
            <em>Gerado em {$hoje}</em>

            <table border='1' width='100%' style='margin-top: 30px;'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{$cursos[0]->id}</td>
                        <td>{$cursos[0]->nome}</td>
                    </tr>

                    <tr>
                        <td>{$cursos[1]->id}</td>
                        <td>{$cursos[1]->nome}</td>
                    </tr>

                    <tr>
                        <td>{$cursos[2]->id}</td>
                        <td>{$cursos[2]->nome}</td>
                    </tr>
                </tbody>
            </table>
        ";

        $dompdf = new Dompdf();
        $dompdf->setPaper('A4', 'portrait'); 
        $dompdf->loadHtml($design);
        $dompdf->render();
        $dompdf->stream('relatorio-cursos.pdf', ['Attachment' => 0]);
    }
}