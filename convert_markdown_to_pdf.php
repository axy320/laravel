<?php
$input = __DIR__ . '/PANDUAN_CRUD_BUKUS.md';
$output = __DIR__ . '/PANDUAN_CRUD_BUKUS.pdf';

if (!file_exists($input)) {
    fwrite(STDERR, "File not found: $input\n");
    exit(1);
}

$lines = file($input, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$textLines = [];
foreach ($lines as $line) {
    $line = rtrim($line);
    if ($line === '') {
        $textLines[] = '';
        continue;
    }

    if (str_starts_with($line, '#')) {
        $line = preg_replace('/^#+\s*/', '', $line);
        $textLines[] = strtoupper($line);
        continue;
    }

    if (preg_match('/^```/', $line)) {
        continue;
    }

    if (preg_match('/^\|.*\|$/', $line)) {
        $columns = array_map('trim', explode('|', trim($line, '|')));
        $textLines[] = implode('   ', $columns);
        continue;
    }

    if (preg_match('/^\s*[-*+]\s+/', $line)) {
        $textLines[] = '• ' . preg_replace('/^\s*[-*+]\s+/', '', $line);
        continue;
    }

    $textLines[] = $line;
}

function wrapLine(string $line, int $max): array {
    $words = preg_split('/\s+/', $line);
    $result = [];
    $current = '';
    foreach ($words as $word) {
        if ($current === '') {
            $current = $word;
            continue;
        }
        if (mb_strlen($current . ' ' . $word) > $max) {
            $result[] = $current;
            $current = $word;
        } else {
            $current .= ' ' . $word;
        }
    }
    if ($current !== '') {
        $result[] = $current;
    }
    return $result;
}

$pages = [];
$currentPage = [];
$maxWidth = 86;
$linesPerPage = 50;
$lineCount = 0;
foreach ($textLines as $line) {
    if ($line === '') {
        $currentPage[] = '';
        $lineCount++;
    } else {
        foreach (wrapLine($line, $maxWidth) as $wrapped) {
            $currentPage[] = $wrapped;
            $lineCount++;
        }
    }
    if ($lineCount >= $linesPerPage) {
        $pages[] = $currentPage;
        $currentPage = [];
        $lineCount = 0;
    }
}
if (!empty($currentPage)) {
    $pages[] = $currentPage;
}

function pdfEscape(string $text): string {
    return str_replace(['\\', '(', ')'], ['\\\\', '\\(', '\\)'], $text);
}

$objects = [];
$objectOffsets = [];

$objects[] = "1 0 obj\n<< /Type /Catalog /Pages 2 0 R >>\nendobj\n";
$pagesCount = count($pages);
$pageIds = [];
for ($i = 0; $i < $pagesCount; $i++) {
    $pageIds[] = (3 + $i * 3) . " 0 R";
}
$objects[] = "2 0 obj\n<< /Type /Pages /Kids [" . implode(' ', $pageIds) . "] /Count $pagesCount >>\nendobj\n";

for ($i = 0; $i < $pagesCount; $i++) {
    $contentLines = [];
    $contentLines[] = "BT";
    $contentLines[] = "/F1 10 Tf";
    $contentLines[] = "50 820 Td";

    foreach ($pages[$i] as $line) {
        $text = pdfEscape($line);
        $contentLines[] = "($text) Tj";
        $contentLines[] = "0 -14 Td";
    }
    $contentLines[] = "ET";

    $content = implode("\n", $contentLines);
    $stream = "<< /Length " . strlen($content) . " >>\nstream\n" . $content . "\nendstream\n";

    $pageObjId = 3 + $i * 3;
    $fontObjId = $pageObjId + 1;
    $contentObjId = $pageObjId + 2;

    $objects[] = "$pageObjId 0 obj\n<< /Type /Page /Parent 2 0 R /MediaBox [0 0 595 842] /Resources << /Font << /F1 $fontObjId 0 R >> >> /Contents $contentObjId 0 R >>\nendobj\n";
    $objects[] = "$fontObjId 0 obj\n<< /Type /Font /Subtype /Type1 /BaseFont /Courier >>\nendobj\n";
    $objects[] = "$contentObjId 0 obj\n" . $stream . "endobj\n";
}

$pdf = "%PDF-1.4\n";
foreach ($objects as $index => $object) {
    $objectOffsets[] = strlen($pdf);
    $pdf .= $object;
}

$xref = "xref\n0 " . (count($objects) + 1) . "\n0000000000 65535 f \n";
foreach ($objectOffsets as $offset) {
    $xref .= str_pad($offset, 10, '0', STR_PAD_LEFT) . " 00000 n \n";
}

$trailer = "trailer\n<< /Size " . (count($objects) + 1) . " /Root 1 0 R >>\nstartxref\n" . strlen($pdf) . "\n%%EOF\n";

file_put_contents($output, $pdf . $xref . $trailer);

echo "PDF berhasil dibuat: $output\n";
