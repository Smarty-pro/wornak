<?php

namespace App\Controller;


use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_central_homepage")
     * @return Response
     */
    public function homepage(): Response
    {
        return $this->render('HOME/homepage.html.twig');
    }

    /**
     * @Route("/test")
     */
    public function test(): Response
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('HOME/pdf.html.twig');

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);

        // return $this->render('REGISTRATION/world-map.html.twig');
    }

    /**
     * @Route("/privacy")
     * @return Response
     */
    public function privacy(): Response
    {
        return $this->render('HOME/privacy.html.twig');
    }

    /**
     * @Route("/terms")
     * @return Response
     */
    public function terms(): Response
    {
        return $this->render('HOME/terms.html.twig');
    }

    public function forgot(): Response
    {
        return $this->render('HOME/forgot.html.twig');
    }
}