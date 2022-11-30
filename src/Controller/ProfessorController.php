<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Professor;
use App\Repository\ProfessorRepository;
use Dompdf\Dompdf;
use Exception;

class ProfessorController extends AbstractController
{
    // public const REPOSITORY = new ProfessorRepository();

    private ProfessorRepository $repository;
    public function listar(): void
    {
        $rep = new ProfessorRepository();
        $professores = $rep->buscarTodos();

        $this->render("professor/listar", [
            'professores' => $professores,
        ]);
    }

    public function cadastrar(): void
    {
        echo "Pagina de cadastrar";
    }

    public function excluir(): void
    {
        $id = $_GET['id'];
        $rep = new ProfessorRepository();
        $rep->excluir($id);
        $this->redirect("/professores/listar");
    }

    public function editar(): void
    {
        $id = $_GET['id'];
        $rep = new ProfessorRepository();
        $professor = $rep->buscarUm($id);
        $this->render('professor/editar', [$aluno]);
        if (false === empty($_POST)) {
            $professor->nome = $_POST['nome'];
            $aluno->cpf = $_POST['cpf'];
    
            try {
                $rep->atualizar($professor, $id);
            } catch (Exception $exception) {
                if (true === str_contains($exception->getMessage(), 'nome')) {
                    die('Professor já cadastrado');
                }
    
                if (true === str_contains($exception->getMessage(), 'cpf')) {
                    die('CPF já cadastrado');
                }
    
                die('Vish, aconteceu um erro');
            }
            $this->redirect('/professor/listar');
        }
        
    }

    public function pdf():void
    {
       $dados = $this->repository->buscarTodos();
       $this->relatorio("professor", [
           'professores' => $dados,
       ]);
    }
}