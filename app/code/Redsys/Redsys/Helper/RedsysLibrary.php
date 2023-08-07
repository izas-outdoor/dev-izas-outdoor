<?php

/**
 * NOTA SOBRE LA LICENCIA DE USO DEL SOFTWARE
 * 
 * El uso de este software está sujeto a las Condiciones de uso de software que
 * se incluyen en el paquete en el documento "Aviso Legal.pdf". También puede
 * obtener una copia en la siguiente url:
 * http://www.redsys.es/wps/portal/redsys/publica/areadeserviciosweb/descargaDeDocumentacionYEjecutables
 * 
 * Redsys es titular de todos los derechos de propiedad intelectual e industrial
 * del software.
 * 
 * Quedan expresamente prohibidas la reproducción, la distribución y la
 * comunicación pública, incluida su modalidad de puesta a disposición con fines
 * distintos a los descritos en las Condiciones de uso.
 * 
 * Redsys se reserva la posibilidad de ejercer las acciones legales que le
 * correspondan para hacer valer sus derechos frente a cualquier infracción de
 * los derechos de propiedad intelectual y/o industrial.
 * 
 * Redsys Servicios de Procesamiento, S.L., CIF B85955367
 */

namespace Redsys\Redsys\Helper;

class RedsysLibrary extends \Magento\Framework\App\Helper\AbstractHelper
{

    private static $errores = null;
    private static $_shuffledLogString, $_logLevel;

    ///////////////////// FUNCIONES DE VALIDACION
    //Firma
    public static function checkFirma($firma_local, $firma_remota)
    {

        if ($firma_local == $firma_remota)
            return 1;
        else
            return 0;
    }
    //Importe
    public static function checkImporte($total)
    {
        return preg_match("/^\d+$/", $total);
    }
    //Pedido
    public static function checkPedidoNum($pedido)
    {
        return preg_match("/^\d{1,12}$/", $pedido);
    }
    public static function checkPedidoAlfaNum($pedido, $pedidoExtendido = false)
    {
        if($pedidoExtendido)
            return preg_match("/^\w{4,256}$/", $pedido);
        else
            return preg_match("/^\w{1,12}$/", $pedido);
    }
    //Fuc
    public static function checkFuc($codigo)
    {
        $retVal = preg_match("/^\d{2,9}$/", $codigo);
        if ($retVal) {
            $codigo = str_pad($codigo, 9, "0", STR_PAD_LEFT);
            $fuc = intval($codigo);
            $check = substr($codigo, -1);
            $fucTemp = substr($codigo, 0, -1);
            $acumulador = 0;
            $tempo = 0;

            for ($i = strlen($fucTemp) - 1; $i >= 0; $i -= 2) {
                $temp = intval(substr($fucTemp, $i, 1)) * 2;
                $acumulador += intval($temp / 10) + ($temp % 10);
                if ($i > 0) {
                    $acumulador += intval(substr($fucTemp, $i - 1, 1));
                }
            }
            $ultimaCifra = $acumulador % 10;
            $resultado = 0;
            if ($ultimaCifra != 0) {
                $resultado = 10 - $ultimaCifra;
            }
            $retVal = $resultado == $check;
        }
        return $retVal;
    }
    //Moneda
    public static function checkMoneda($moneda)
    {
        return preg_match("/^\d{1,3}$/", $moneda);
    }
    //Respuesta
    public static function checkRespuesta($respuesta)
    {
        return preg_match("/^\d{1,4}$/", $respuesta);
    }
    //Firma
    public static function checkFirmaComposicion($firma)
    {
        return preg_match("/^[a-zA-Z0-9\/+]{32}$/", $firma);
    }
    //AutCode
    public static function checkAutCode($id_trans)
    {
        return preg_match("/^\w{1,6}$/", $id_trans);
    }
    //Nombre del Comecio
    public static function checkNombreComecio($nombre)
    {
        return preg_match("/^\w*$/", $nombre);
    }
    //Terminal
    public static function checkTerminal($terminal)
    {
        return preg_match("/^\d{1,3}$/", $terminal);
    }
    /*
    ///////////////////// FUNCIONES DE LOG
    public static function generateIdLog() {
        $vars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $stringLength = strlen($vars);
        $result = '';
        for ($i = 0; $i < 20; $i++) {
            $result .= $vars[rand(0, $stringLength - 1)];
        }
        return $result;
    }
    public static function escribirLog($idLog, $texto, $activo) {
    	if($activo){
			//$writer = new \Zend\Log\Writer\Stream(BP . '/var/log/redsys.log');
			//$logger = new \Zend\Log\Logger();
			//$logger->addWriter($writer);
			
			//$logger->info("Redsys_".$idLog." - ".$texto);
			
			\Magento\Framework\App\ObjectManager::getInstance()->get('Psr\Log\LoggerInterface')->info("Redsys_".$idLog." - ".$texto);
    	}
    }
*/
    /** UTILIDADES DE LOGGING. */

    public static function make_seed()
    {

        list($usec, $sec) = explode(' ', microtime());
        return (float) $sec + ((float) $usec * 100000);
    }

    public static function generateLogString($seed)
    {

        $logString = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

        srand(crc32($seed));
        $shuffledLogString = str_shuffle($logString);
        srand();

        self::$_shuffledLogString = $shuffledLogString;
        return $shuffledLogString;
    }

    public static function generateIdLog($logLevel, $idCart = NULL, $force = false)
    {

        (empty(self::$_shuffledLogString))
            ? $logString = RedsysLibrary::generateLogString($_SERVER['SERVER_NAME'])
            : ($logString = self::$_shuffledLogString);

        ($idCart == NULL)
            ? srand(RedsysLibrary::make_seed())
            : srand($idCart);

        $stringLength = strlen($logString);
        $idLog = '';

        for ($i = 0; $i < 30; $i++) {

            $idLog .= $logString[rand(0, $stringLength - 1)];
        }

        self::$_logLevel = (int)$logLevel;
        return $idLog;
    }

    public static function escribirLog($tipo, $idLog, $texto, $logLevel = NULL, $method = NULL)
    {

        (is_null($method)) ? ($methodLog = "") : ($methodLog = $method . " -- ");

        $logEntry = $idLog . ' -- ' . $methodLog . $texto;
        $level = $logLevel ?: self::$_logLevel;
        //$logfilename = dirname(__FILE__) . '/Log/redsysLog.log';
        $logfilename = \Magento\Framework\App\ObjectManager::getInstance()->get('\Magento\Framework\Filesystem\DirectoryList')->getPath('log') . '/redsysLog.log';

        switch ($level) {
            case 0:

                if ($tipo == "ERROR") {
                    file_put_contents($logfilename, date('M d Y G:i:s') . ' -- [' . $tipo . ']' . ' -- ' . $logEntry . "\r\n", is_file($logfilename) ? FILE_APPEND : 0);
                    \Magento\Framework\App\ObjectManager::getInstance()->get('Psr\Log\LoggerInterface')->error("[REDSYS] " . $idLog . " - " . $logEntry);
                }

                break;

            case 1:

                if ($tipo == "ERROR") {
                    file_put_contents($logfilename, date('M d Y G:i:s') . ' -- [' . $tipo . ']' . ' -- ' . $logEntry . "\r\n", is_file($logfilename) ? FILE_APPEND : 0);
                    \Magento\Framework\App\ObjectManager::getInstance()->get('Psr\Log\LoggerInterface')->error("[REDSYS] " . $idLog . " - " . $logEntry);
                } else if ($tipo == "INFO ") {
                    file_put_contents($logfilename, date('M d Y G:i:s') . ' -- [' . $tipo . ']' . ' -- ' . $logEntry . "\r\n", is_file($logfilename) ? FILE_APPEND : 0);
                    \Magento\Framework\App\ObjectManager::getInstance()->get('Psr\Log\LoggerInterface')->info("[REDSYS] " . $idLog . " - " . $logEntry);
                }

                break;

            case 2:

                if ($tipo == "ERROR") {
                    file_put_contents($logfilename, date('M d Y G:i:s') . ' -- [' . $tipo . ']' . ' -- ' . $logEntry . "\r\n", is_file($logfilename) ? FILE_APPEND : 0);
                    \Magento\Framework\App\ObjectManager::getInstance()->get('Psr\Log\LoggerInterface')->error("[REDSYS] " . $idLog . " - " . $logEntry);
                } else if ($tipo == "INFO ") {
                    file_put_contents($logfilename, date('M d Y G:i:s') . ' -- [' . $tipo . ']' . ' -- ' . $logEntry . "\r\n", is_file($logfilename) ? FILE_APPEND : 0);
                    \Magento\Framework\App\ObjectManager::getInstance()->get('Psr\Log\LoggerInterface')->info("[REDSYS] " . $idLog . " - " . $logEntry);
                } else if ($tipo == "DEBUG") {
                    file_put_contents($logfilename, date('M d Y G:i:s') . ' -- [' . $tipo . ']' . ' -- ' . $logEntry . "\r\n", is_file($logfilename) ? FILE_APPEND : 0);
                    \Magento\Framework\App\ObjectManager::getInstance()->get('Psr\Log\LoggerInterface')->debug("[REDSYS] " . $idLog . " - " . $logEntry);
                }

                break;

            default:
                # Nothing to do here...
                break;
        }
    }

    /** OTRAS UTILIDADES */

    public static function generaNumeroPedido($idCart, $tipo, $pedidoExtendido = false)
    {
		switch (intval($tipo)) {
			case 0 : // Hibrido
				$out = str_pad ( $idCart . "z" . time()%1000, 12, "0", STR_PAD_LEFT );
				$outExtended = str_pad ( $idCart . "z" . time()%1000, 4, "0", STR_PAD_LEFT );
	
				break;
			case 1 : // idCart de la Tienda
				$out = str_pad ( intval($idCart), 12, "0", STR_PAD_LEFT );
				$outExtended = str_pad ( intval($idCart), 4, "0", STR_PAD_LEFT );
	
				break;
			case 2: // Aleatorio
				$out = mt_rand (100000000000, 999999999999);
				$outExtended = mt_rand (1000, PHP_INT_MAX);
	
				break;
		}
	
		(strlen($out) <= 12) ? $out : (substr($out, -12));
		return ($pedidoExtendido) ? $outExtended : $out;
    }

    public static function checkRespuestaSIS($codigo_respuesta = NULL, $authCode = NULL)
    {

        $erroresSIS = array();
        $errorBackofficeSIS = "";

        include 'erroresSIS.php';

        if (array_key_exists($codigo_respuesta, $erroresSIS)) {

            $errorBackofficeSIS = $codigo_respuesta;
            $errorBackofficeSIS .= ' - ' . $erroresSIS[$codigo_respuesta] . '.';
        } else {

            $errorBackofficeSIS = "La operación ha finalizado con errores. Consulte el módulo de administración del TPV Virtual.";
        }

        $metodoOrder = "N/A";

        if (($codigo_respuesta < 101) && (strpos($codigo_respuesta, "SIS") === false))
            $metodoOrder = "Autorizada " . $authCode;

        else {
            if (strpos($codigo_respuesta, "SIS") !== false)
                $metodoOrder = "Error " . $codigo_respuesta;
            else
                $metodoOrder = "Denegada " . $codigo_respuesta;
        }

        return array($errorBackofficeSIS, $metodoOrder);
    }

    /** ENCODES ADICIONALES */

    public static function b64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    public static function b64url_decode($data)
    {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }
}
