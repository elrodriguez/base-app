<?php

namespace App\Helpers\Invoice;

require __DIR__ . DIRECTORY_SEPARATOR . 'Vendor' . DIRECTORY_SEPARATOR . 'phpqrcode' . DIRECTORY_SEPARATOR . 'qrlib.php';

class QrCodeGenerator
{
    private $size;

    public function __construct($size = 200)
    {
        $this->size = $size;
    }
    public function generateQR($text, $outfile = false, $size = 3, $margin = 4, $saveandprint = false)
    {
        // Verifica si la clase QRcode está disponible
        // s = pequeño
        // m = mediano
        // l = pequeño
        // xl = pequeño

        if ($outfile) {
            if (!file_exists($outfile)) {
                mkdir($outfile, 0777, true);
            }
        } else {
            $filePath = false;
        }


        $randomFileName = $this->generateRandomFileName();
        $filePath = $outfile . DIRECTORY_SEPARATOR . $randomFileName;

        if (class_exists('QRcode')) {
            \QRcode::png($text, $filePath, QR_ECLEVEL_M, $size, $margin);
        } else {
            throw new \Exception("QRcode class not found.");
        }

        return $filePath;
    }

    private function generateRandomFileName()
    {
        // Crear un nombre de archivo aleatorio con una extensión PNG
        return uniqid('qr_', true) . '.png';
    }
}
