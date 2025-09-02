<?php

echo "<style>
table {
    border-collapse: collapse;
    border: 1px solid black;
}
td {
    border: 1px solid black;
    padding: 5px;
    text-align: center;
}
</style>";

$jml = $_GET['jml'];

echo "<table>\n";

for ($a = $jml; $a > 0; $a--) {
    $total = 0;
    for ($b = $a; $b > 0; $b--) {
        $total += $b;
    }
    
    echo "<tr>\n";
    echo "<td colspan='$jml'>TOTAL: $total</td>";
    echo "</tr>\n";
    
    echo "<tr>\n";
    for ($b = $a; $b >= 1; $b--) {
        echo "<td>$b</td>";
    }
    for ($k = $a; $k < $jml; $k++) {
        echo "<td></td>";
    }
    echo "</tr>\n";
}

echo "</table>";
?>