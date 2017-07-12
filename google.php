<?php

$url_one = "https://www.google.com/finance/info?q=NSE%3AABIRLANUVO%2CACC%2CADANIENT%2CADANIPORTS%2CADANIPOWER%2CAJANTPHARM%2CALBK%2CAMARAJABAT%2CAMBUJACEM%2CANDHRABANK%2CAPOLLOHOSP%2CAPOLLOTYRE%2CARVIND%2CASHOKLEY%2CASIANPAINT%2CAUROPHARMA%2CAXISBANK%2CBAJAJ-AUTO%2CBAJFINANCE%2CBANKBARODA%2CBANKINDIA%2CBATAINDIA%2CBEL%2CBEML%2CBHARATFORG%2CBHARTIARTL%2CBHEL%2CBIOCON%2CBOSCHLTD%2CBPCL%2CBRITANNIA%2CCADILAHC%2CCAIRN%2CCANBK%2CCASTROLIND%2CCEATLTD%2CCENTURYTEX%2CCESC%2CCIPLA%2CCOALINDIA%2CCOLPAL%2CCONCOR%2CCROMPGREAV%2CCUMMINSIND%2CDABUR%2CDHFL%2CDISHTV%2CDIVISLAB%2CDLF%2CDRREDDY%2CEICHERMOT%2CENGINERSIN%2CEXIDEIND%2CFEDERALBNK%2CGAIL%2CGLENMARK%2CGMRINFRA%2CGODREJCP%2CGODREJIND%2CGRANULES%2CGRASIM%2CHAVELLS%2CHCLTECH%2CHDFC%2CHDFCBANK%2CHDIL%2CHEROMOTOCO%2CHEXAWARE%2CHINDALCO%2CHINDPETRO%2CHINDUNILVR%2CHINDZINC%2CIBREALEST%2CIBULHSGFIN%2CICICIBANK%2CICIL%2CIDBI%2CIDEA%2CIDFC%2CIFCI%2CIGL%2CINDIACEM%2CINDUSINDBK%2CINFRATEL%2CINFY%2CIOB%2CIOC%2CIRB%2CITC%2CJETAIRWAYS%2CJINDALSTEL%2CJISLJALEQS%2CJPASSOCIAT%2CJSWENERGY%2CJSWSTEEL%2CJUBLFOOD%2CJUSTDIAL%2CKOTAKBANK%2CKPIT%2CKSCL";

$ch_one = curl_init();

curl_setopt($ch_one, CURLOPT_SSL_VERIFYPEER, false);

curl_setopt($ch_one, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch_one, CURLOPT_URL,$url_one);

$result_one=curl_exec($ch_one);

curl_close($ch_one);

$result_one = str_replace('//', '', $result_one);

$result_one = json_decode($result_one, true);

$url_two = "https://www.google.com/finance/info?q=NSE%3AKTKBANK%2CLICHSGFIN%2CLT%2CLUPIN%2CMARICO%2CMARUTI%2CMCDOWELL-N%2CMCLEODRUSS%2CMINDTREE%2CMOTHERSUMI%2CMRF%2CNCC%2CNHPC%2CNMDC%2CNTPC%2COFSS%2COIL%2CONGC%2CORIENTBANK%2CPAGEIND%2CPCJEWELLER%2CPETRONET%2CPFC%2CPIDILITIND%2CPNB%2CPOWERGRID%2CPTC%2CRCOM%2CRECLTD%2CRELCAPITAL%2CRELIANCE%2CRELINFRA%2CRPOWER%2CSAIL%2CSBIN%2CSIEMENS%2CSKSMICRO%2CSOUTHBANK%2CSRF%2CSRTRANSFIN%2CSTAR%2CSUNPHARMA%2CSUNTV%2CSYNDIBANK%2CTATACHEM%2CTATACOMM%2CTATAELXSI%2CTATAGLOBAL%2CTATAMOTORS%2CTATAMTRDVR%2CTATAPOWER%2CTATASTEEL%2CTCS%2CTECHM%2CTITAN%2CTORNTPHARM%2CTV18BRDCST%2CTVSMOTOR%2CUBL%2CUCOBANK%2CULTRACEMCO%2CUNIONBANK%2CUNITECH%2CUPL%2CVEDL%2CVOLTAS%2CWIPRO%2CWOCKPHARMA%2CYESBANK%2CZEEL";

$ch_two = curl_init();

curl_setopt($ch_two, CURLOPT_SSL_VERIFYPEER, false);

curl_setopt($ch_two, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch_two, CURLOPT_URL,$url_two);

$result_two=curl_exec($ch_two);

curl_close($ch_two);

$result_two = str_replace('//', '', $result_two);

$result_two = json_decode($result_two, true);

$final_stock_result=array_merge($result_one,$result_two);

?>

<!DOCTYPE html>

<html>

<head>

<style>

table, th, td {

    border: 1px solid black;

    border-collapse: collapse;

}

th, td {

    padding: 5px;

}

</style>

</head>

<body>

<table style="width:100%">

<tr>

    <th>id</th>

    <th>t</th>

    <th>e</th>

    <th>l</th>

    <th>l_fix</th>

    <th>l_cur</th>

    <th>s</th>

    <th>ltt</th>

    <th>lt</th>

    <th>lt_dts</th>

    <th>c</th>

    <th>c_fix</th>

    <th>cp</th>

    <th>cp_fix</th>

    <th>ccol</th>

    <th>pcls_fix</th>

  </tr>

<?php

foreach ($final_stock_result as $response)
{

    ?>

        <tr>

        <td><?php echo $response['id'];?></td>

        <td><?php echo $response['t'];?></td>

        <td><?php echo $response['e'];?></td>

        <td><?php echo $response['l'];?></td>

        <td><?php echo $response['l_fix'];?></td>

        <td><?php echo $response['l_cur'];?></td>

        <td><?php echo $response['s'];?></td>

        <td><?php echo $response['ltt'];?></td>

        <td><?php echo $response['lt'];?></td>

        <td><?php echo $response['lt_dts'];?></td>

        <td><?php echo $response['c'];?></td>

        <td><?php echo $response['c_fix'];?></td>

        <td><?php echo $response['cp'];?></td>

        <td><?php echo $response['cp_fix'];?></td>

        <td><?php echo $response['ccol'];?></td>

        <td><?php echo $response['pcls_fix'];?></td>

      </tr>

      <?php

}

?>

</table>

</body>

</html>