<?php

function csvParser(string $filename, string $delimiter): array{

    $filename =  dirname(__DIR__) . '/' . $filename;
    $filecontent = file_get_contents($filename);

    $array = null;
    $m = 0;
    $n = 0;
    $filler = "";
    $strLength = strlen($filecontent);

    for($i = 0; $i < $strLength; $i++) {

        $currentChar = $filecontent[$i];
        $parsedChar = "";

        switch($currentChar) {

            case $delimiter:
                $array[$m][$n] = $filler;
                $filler = "";
                $n++;
            break;
            
            case "\n":
                $array[$m][$n] = $filler;
                $filler = "";
                $n = 0;
                $m++;
            break;

            default:
            $parsedChar = $currentChar;
            break;
        }

        ($parsedChar !== "") ? $filler .= $parsedChar : "";
    }
    
    ($filler) ? $array[$m][$n] = $filler : "";
        
    return array_splice($array, 1);
}
    
// print_r(csvParser("test.csv", ";"));