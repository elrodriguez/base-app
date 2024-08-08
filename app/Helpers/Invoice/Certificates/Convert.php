<?php

namespace App\Helpers\Invoice\Certificates;

use Greenter\XMLSecLibs\Certificate\X509Certificate;
use Greenter\XMLSecLibs\Certificate\X509ContentType;

class Convert
{
    public function cpem($certificate, $password, $ruc = 'certificate')
    {

        $pfx = file_get_contents($certificate);

        try {
            $certificate = new X509Certificate($pfx, $password);
            $pem = $certificate->export(X509ContentType::PEM);
            //$filename = $ruc . '.pem';
            $filename = $ruc . '.pem';
            $path = __DIR__ . DIRECTORY_SEPARATOR . $filename;
            file_put_contents($path, $pem);

            return [
                'success' => true,
                'file_name' => $filename,
            ];
        } catch (\Exception $e) {
            // Manejar el error adecuadamente, por ejemplo, registrarlo en un log
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
    public function ccer($certificate, $password, $ruc = 'certificate')
    {

        $pfx = file_get_contents($certificate);

        try {
            $certificate = new X509Certificate($pfx, $password);
            $pem = $certificate->export(X509ContentType::CER);
            //$filename = $ruc . '.cer';
            $filename = $ruc . '.cer';
            $path = __DIR__ . DIRECTORY_SEPARATOR . $filename;
            file_put_contents($path, $pem);
            return [
                'success' => true,
                'file_name' => $filename,
            ];
        } catch (\Exception $e) {
            // Manejar el error adecuadamente, por ejemplo, registrarlo en un log
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}
