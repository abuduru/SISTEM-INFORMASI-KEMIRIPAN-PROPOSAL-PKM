<?php
/**
 * Created by PhpStorm.
 * User: ApeZ
 * Date: 04/04/2018
 * Time: 21:48
 */
#$pdf = '1522881687Abstrak-1.pdf';
$parser = new \Smalot\PdfParser\Parser(); //loading parser library
$pdfparser    = $parser->parseFile('assets/file/'.$pdf);
$pages  = $pdfparser->getPages();
$text = strtolower($pdfparser->getText());

$no=1;
foreach ($pages as $page) {
    # code...


    $explode = explode('.',strtolower($page->getText()));//hilangkan titik

    $implode = implode(' ',$explode);

    $explode2 = explode(',',$implode);//hilangkan koma

    $implode2 = implode(' ',$explode2);

    $explode3 = explode(' ', preg_replace('/[^a-z]/',' ',$implode2));//hilangkan spasi

    $implode3 = implode('',$explode3);

     $letak = 1;

    foreach ($explode3 as $key => $value) {
               
        if ($value == '' or $value == ' ') {
            # code...
        }else{
            $query = $this->db->query('select * from stopword where huruf = "'.$value.'"')->row();
            if($query == true){

            }else{
                $insert = $this->db->query('insert into katapdf_sumber(namadokumen2,kata2,halaman2,letak2) value("'.$pdf.'","'.$value.'","'.$no.'","'.$letak.'")');
            }
        }
        
        $letak++;
    }
    $no++;
    #echo $page;
}



function pre($var){
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}
 
 	

   
   

?>