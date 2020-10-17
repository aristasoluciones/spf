<?php
use Dompdf\Dompdf;
use Dompdf\Options;

include_once(DOC_ROOT."/libs/pChart2.0/class/pData.class.php");
include_once(DOC_ROOT."/libs/pChart2.0/class/pDraw.class.php");
include_once(DOC_ROOT."/libs/pChart2.0/class/pPie.class.php");
include_once(DOC_ROOT."/libs/pChart2.0/class/pImage.class.php");
class PdfService extends Question{
    private $domPdf;
    private $smarty;

    public function __construct()
    {
        //$this->domPdf = new Dompdf();
        $this->smarty = new Smarty;
        $this->smarty->caching = false;
        $this->smarty->compile_check = true;

    }
    public function generate($type="view",$fileName="resultado"){
        global $victima;
        $this->resetDataChart();
        $victima->setVictimaId($this->getVictimaId());
        $info = $victima->Info();
        $resultados = $this->getResultPollVictima();
        $this->generateDataForChart();
        $this->generateChartToImg();
        $this->smarty->assign('resultGeneral',  $victima->getResultPollByVictima());
        $this->smarty->assign('porcentajeGeneral',  $this->generatePointsForViolentometro());
        $this->smarty->assign('encuestas', $resultados);
        $this->smarty->assign('info', $info);

        $chart = WEB_ROOT."/charts/chart_".$this->getVictimaId().".png";
        $this->smarty->assign('logo', WEB_ROOT."/images/escudo.png");
        $this->smarty->assign('chart', $chart);
        $html = $this->smarty->fetch(DOC_ROOT.'/templates/reports/poll-result-pdf.tpl');
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $auth = base64_encode("username:password");
        $context = stream_context_create(array(
            'ssl' => array(
                'verify_peer' => true,
                'verify_peer_name' => true,
                'allow_self_signed'=> TRUE
            ),
            'http' => array(
                'header' => "Authorization: Basic $auth"
            )
        ));
        $dompdf->setHttpContext($context);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        if($type == 'download') {
            $dompdf->stream($fileName.'.pdf');
        } else if($type == 'view') {
            $dompdf->stream($fileName.'.pdf', array("Attachment" => false));
        } else {
            return $dompdf->output();
        }
        exit(0);
    }
}



