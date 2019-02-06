<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $encrypted = Crypt::encryptString('2');
        //var_dump($encrypted);
        return view('home');
    }

    public function generateDocx()
    {

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(public_path('/word/template.docx'));
        $num=" ";

        for ($i = 0; $i<8; $i++) 
        {
        
            $num .= mt_rand(0,9);
            
        }
        $templateProcessor->setValue('codigo', $num);
        //$templateProcessor->setImage("macroNameImage", public_path('img/logo.png'), "logoHeader.png", 30, 30);
        //$image_path= QrCode::format('png')->generate('Incorpórame en un e-mail!','abc.png');
        //var_dump($image_path);
        \QrCode::format('png')->size(80)->margin(0)->generate($num,public_path('/word/abc.png'));
        $templateProcessor->setImg('macroNameImage', array(
            'src'  => public_path('/word/abc.png')//,
            //'size' => array( 130, 120 ) //px
        ));
        //$templateProcessor->setImg('macroNameImage',array('src' => public_path('/images/1543343037.JPG'),'swh'=>'200', 'size'=>array(0=>$width, 1=>$height));
        //$templateProcessor->setImage("imgPhpWord", public_path('/images/1543343037.JPG'), "log.png", 30, 30);
        $templateProcessor->saveAs(storage_path('resulttemplate.docx'));
        
        //$templateProcessor = new TemplateProcessor('Template.docx');


        //$section = $phpWord->addSection();


        


        //$section->addImage("http://itsolutionstuff.com/frontTheme/images/logo.png");
        //$section->addText($description);


        //$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($testWord, 'Word2007');
        try {
            //$objWriter->save(storage_path('helloWorld.docx'));
        } catch (Exception $e) {
        }


        return response()->download(storage_path('resulttemplate.docx'));
    }

    public function setImg($strKey, $img) {
        $strKey       = '${' . $strKey . '}';
        $relationTmpl = '<Relationship Id="RID" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/image" Target="media/IMG"/>';

        $imgTmpl = '<w:drawing><wp:inline distT="0" distB="0" distL="0" distR="0" wp14:anchorId="6E59C072" wp14:editId="50C440CF"><wp:extent cx="WID" cy="HEI"/><wp:effectExtent l="0" t="0" r="12065" b="0"/><wp:docPr id="1" name="signature" descr=""/><wp:cNvGraphicFramePr><a:graphicFrameLocks xmlns:a="http://schemas.openxmlformats.org/drawingml/2006/main" noChangeAspect="1"/></wp:cNvGraphicFramePr><a:graphic xmlns:a="http://schemas.openxmlformats.org/drawingml/2006/main"><a:graphicData uri="http://schemas.openxmlformats.org/drawingml/2006/picture"><pic:pic xmlns:pic="http://schemas.openxmlformats.org/drawingml/2006/picture"><pic:nvPicPr><pic:cNvPr id="0" name="signature" descr=""/><pic:cNvPicPr><a:picLocks noChangeAspect="1" noChangeArrowheads="1"/></pic:cNvPicPr></pic:nvPicPr><pic:blipFill><a:blip r:embed="RID" cstate="print"><a:extLst><a:ext uri="{28A0092B-C50C-407E-A947-70E740481C1C}"><a14:useLocalDpi xmlns:a14="http://schemas.microsoft.com/office/drawing/2010/main" val="0"/></a:ext></a:extLst></a:blip><a:srcRect/><a:stretch><a:fillRect/></a:stretch></pic:blipFill><pic:spPr bwMode="auto"><a:xfrm><a:off x="0" y="0"/><a:ext cx="WID" cy="HEI"/></a:xfrm><a:prstGeom prst="rect"><a:avLst/></a:prstGeom><a:noFill/><a:ln><a:noFill/></a:ln></pic:spPr></pic:pic></a:graphicData></a:graphic></wp:inline></w:drawing>';

        $toAdd       = $toAddImg = $toAddType = '';
        $aSearch     = array( 'RID', 'IMG' );
        $aSearchType = array( 'IMG', 'EXT' );
        $countrels   = $this->_countRels++;
        //I'm work for jpg files, if you are working with other images types -> Write conditions here
        $imgExt  = 'jpg';
        $imgName = 'img' . $countrels . '.' . $imgExt;

        $this->zipClass->deleteName('word/media/' . $imgName);
        $this->zipClass->addFile($img['src'], 'word/media/' . $imgName);

        $typeTmpl = '<Override PartName="/word/media/' . $imgName . '" ContentType="image/EXT"/>';


        $rid = 'rId' . $countrels;
        $countrels++;

        list($w, $h) = getimagesize($img['src']);

        if(isset($img['size'])){
            $w = (int)($img['size'][0] * (3 / 100) * 376653); //px * cm * em
            $h = (int)($img['size'][1] * (3 / 100) * 376653); //px * cm * em
        }

        $toAddImg .= str_replace(array( 'RID', 'WID', 'HEI' ), array( $rid, $w, $h ), $imgTmpl);
        if(isset($img['dataImg'])){
            $toAddImg .= '<w:br/><w:t>' . $this->limpiarString($img['dataImg']) . '</w:t><w:br/>';
        }

        $aReplace  = array( $imgName, $imgExt );
        $toAddType .= str_replace($aSearchType, $aReplace, $typeTmpl);

        $aReplace = array( $rid, $imgName );
        $toAdd    .= str_replace($aSearch, $aReplace, $relationTmpl);


        $this->tempDocumentMainPart = str_replace('<w:t>' . $strKey . '</w:t>', $toAddImg, $this->tempDocumentMainPart);

        if($this->_rels == ""){
            $this->_rels  = $this->zipClass->getFromName('word/_rels/document.xml.rels');
            $this->_types = $this->zipClass->getFromName('[Content_Types].xml');
        }

        $this->_types = str_replace('</Types>', $toAddType, $this->_types) . '</Types>';
        $this->_rels  = str_replace('</Relationships>', $toAdd, $this->_rels) . '</Relationships>';
    }
}

