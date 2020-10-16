<?php
use Dompdf\Dompdf;
include_once(DOC_ROOT."/libs/pChart/class/pData.class.php");
include_once(DOC_ROOT."/libs/pChart/class/pDraw.class.php");
include_once(DOC_ROOT."/libs/pChart/class/pPie.class.php");
include_once(DOC_ROOT."/libs/pChart/class/pImage.class.php");
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

        $chart = false;
        $file = DOC_ROOT."/charts/chart_".$this->getVictimaId().".png";
        if(file_exists($file))
            $chart =$file;

        $this->smarty->assign('logo', DOC_ROOT."/images/escudo.png");
        $this->smarty->assign('chart', $chart);
        $html = $this->smarty->fetch(DOC_ROOT.'/templates/reports/poll-result-pdf.tpl');

        $dompdf = new Dompdf();
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



