<?php
// loop over JSON files
header('Content-Type: application/json');
$jsonfiles = glob('flowstats/*.json');
//$jsonfiles = array('prova.json', 'provb.json', 'provc.json');
foreach ( $jsonfiles as $jsonfile ) {

    //read the json file contents
    $jsondata = file_get_contents($jsonfile);
    $file_datetime = date('Y-m-d\TH:i:s.000P',filemtime($jsonfile)); 
    $file_date = date("Y.m.d",filemtime($jsonfile));   

    //$header_data = '{"index":{"_index":"flowstats4-'.$file_date.'","_type":"log"}}';
    $header_data = '{"index":{"_index":"flowstats5-1","_type":"log"}}';

    //convert json object to php associative array
    $data = json_decode($jsondata, true);

    
    $data2 = json_encode($data['stats']);
    if($data2!='null'){
        echo $header_data;
        echo "\r\n";

        $stats_data = array(
            '@timestamp' => $file_datetime,
            'exportedFlowTotalCount' => $data['stats']['exportedFlowTotalCount'], 
            'packetTotalCount' => $data['stats']['packetTotalCount'],
            'droppedPacketTotalCount' => $data['stats']['droppedPacketTotalCount'],
            'ignoredPacketTotalCount' => $data['stats']['ignoredPacketTotalCount'],
            'expiredFragmentCount' => $data['stats']['expiredFragmentCount'],
            'assembledFragmentCount' => $data['stats']['assembledFragmentCount'],
            'flowTableFlushEvents' => $data['stats']['flowTableFlushEvents'],
            'flowTablePeakCount' => $data['stats']['flowTablePeakCount'],
            'exporterIPv4Address' => $data['stats']['exporterIPv4Address'],
            'exportingProcessId' => $data['stats']['exportingProcessId'],
            'meanFlowRate' => $data['stats']['meanFlowRate'],
            'meanPacketRate' => $data['stats']['meanPacketRate'],
            'exporterName' => $data['stats']['exporterName']
            );



        echo json_encode($stats_data);
        echo "\r\n";
    }

/*
    foreach ($data as $u => $z){
        //print_r($z);
        foreach ($z as $n => $line){
            //get the tweet details
//            $id_user = $line['stats']['exportedFlowTotalCount'];



        }
    }*/
}
?>