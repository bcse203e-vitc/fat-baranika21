<?php
function lineSum(string $filename, int $lineNumber): int {
    if (!file_exists($filename) || $lineNumber < 1) {
        return 0;
    }

    $handle = fopen($filename, "r");
    if (!$handle) {
        return 0;
    }

    $current = 0;
    $result = 0;

    while (($line = fgets($handle)) !== false) {
        $line = trim($line);

        // Skip blank lines + comment lines
        if ($line === "" || str_starts_with($line, "#")) {
            continue;
        }

        $current++;

        if ($current === $lineNumber) {

            $tokens = preg_split("/\s+/", $line);

            foreach ($tokens as $tok) {
                if (preg_match("/^-?\d+$/", $tok)) {
                    $result += intval($tok);
                }
            }

            fclose($handle);
            return $result;
        }
    }

    fclose($handle);
    return 0;
}

echo lineSum("sums.txt", 1);
echo"<br>";
echo lineSum("sums.txt", 2);
echo"<br>";
echo lineSum("sums.txt", 3);
echo"<br>";
echo lineSum("sums.txt", 4);
echo"<br>";
echo lineSum("sums.txt", 5);
?>

