<?php

require_once 'Excel/reader.php';

function print_var_name($var) {
    foreach($GLOBALS as $var_name => $value) {
        if ($value === $var) {
            return $var_name;
        }
    }
    return false;
}

function dump($reference){
	print("<div style='margin:5px;border:1px solid gray'>");
	print("<h6>".print_var_name($reference)."</h6>");
	print_r($reference);
	print("</div>");
}

$data = new Spreadsheet_Excel_Reader();

$data->read('example.xls');

error_reporting(E_ALL ^ E_NOTICE);

echo "<table style='border-collapse:collapse;border:1px solid lightgray'>";
for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
	echo "<tr>";
	for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
		if ( $i == 1 ) {
			echo "<th";
		} else {
			echo "<td";
		}
		echo " style='border:1px solid lightgray'>\"".$data->sheets[0]['cells'][$i][$j]."\",";
	}
	echo "\n";
}
echo "</table>";


dump($data);
dump($data->formatRecords);

?>
