<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;

class RelatorioController extends AbstractController
{
    /**
     * @Route("/relatorio", name="relatorio")
     */
    public function index(): Response
    {

        $html = $this->renderView('relatorio/RelatorioEstudanteTurma.html.twig');

        $this->Imprimir($html);

        return $this->render('relatorio/RelatorioEstudanteTurma.html.twig');
    }


//---Metodo Imprimir PDF---
    public function Imprimir($html)
    {
        // Configurando Dompdf
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $pdfOptions->set('isRemoteEnabled', 'true');

        // Cria uma instância do Dompdf com nossas opções
        $dompdf = new Dompdf($pdfOptions);

        // Carregar HTML no Dompdf
        $dompdf->loadHtml($html);

        // (Opcional) Configure o tamanho do papel e a orientação 'vertical' ou 'vertical'
        $dompdf->setPaper('A4', 'portrait');

        // Renderiza el HTML como PDF
        $dompdf->render();

        // Envie o PDF gerado ao navegador (descarga forçada)
        $dompdf->stream("relatorios_solicitude_pdf.pdf", [
            "Attachment" => true
        ]);
    }
}
