<?php

namespace App\Helpers\Invoice;

require __DIR__ . DIRECTORY_SEPARATOR . 'Vendor' . DIRECTORY_SEPARATOR . 'phpqrcode' . DIRECTORY_SEPARATOR . 'qrlib.php';

class QrCodeGenerator
{

    public function generateQR($text, $directory = false, $file_name = null, $size = 3, $margin = 4, $saveandprint = false)
    {

        if ($directory) {
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }
        } else {
            $filePath = false;
        }

        if ($file_name) {
            $filePath = $directory . DIRECTORY_SEPARATOR . $file_name;
        } else {
            $randomFileName = $this->generateRandomFileName();
            $filePath = $directory . DIRECTORY_SEPARATOR . $randomFileName;
        }


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
