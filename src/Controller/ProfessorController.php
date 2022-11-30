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
        
    }

    public function relatorio(): void
    {
        $hoje = date('d/m/Y');

        $professores = $this->repository->buscarTodos();

        $design = "
            <h1>Relatorio de Professores</h1>
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
                        <td>{$professores[0]->id}</td>
                        <td>{$professores[0]->nome}</td>
                    </tr>

                    <tr>
                        <td>{$professores[1]->id}</td>
                        <td>{$professores[1]->nome}</td>
                    </tr>

                    <tr>
                        <td>{$professores[2]->id}</td>
                        <td>{$professores[2]->nome}</td>
                    </tr>
                </tbody>
            </table>
        ";

        $dompdf = new Dompdf();
        $dompdf->setPaper('A4', 'portrait'); // tamanho da pagina
        $dompdf->loadHtml($design); //carrega o conteudo do PDF
        $dompdf->render(); //aqui renderiza 
        $dompdf->stream('relatorio-professores.pdf', ['Attachment' => 0]); //é aqui que a magica acontece
    }
}