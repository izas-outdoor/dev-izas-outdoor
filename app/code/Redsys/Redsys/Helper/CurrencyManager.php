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

class CurrencyManager {
    public static function GetCurrency(){
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$currencysymbol = $objectManager->get('Magento\Store\Model\StoreManagerInterface');
    	return $currencysymbol->getStore()->getCurrentCurrencyCode();
    }

    public static function GetAmount($amount, $currency){
        return floatval($amount)*pow(10, CurrencyManager::CurrencyDecimals($currency));
    }

    public static function CurrencyDecimals($currency){
        $currency_decimals = array(
            'AFA' => 2,
            'ALL' => 2,
            'DZD' => 2,
            'AON' => 2,
            'AZM' => 2,
            'ARS' => 2,
            'AUD' => 2,
            'ATS' => 2,
            'BSD' => 2,
            'BHD' => 3,
            'BDT' => 2,
            'AMD' => 2,
            'BBD' => 2,
            'BEF' => 0,
            'BMD' => 2,
            'BTN' => 2,
            'BOB' => 2,
            '070' => 0,
            'BWP' => 2,
            'BRC' => 2,
            'BZD' => 2,
            'SBD' => 2,
            'BND' => 2,
            'BGL' => 2,
            'BUK' => 2,
            'BIF' => 0,
            'BYB' => 0,
            'KHR' => 2,
            'CAD' => 2,
            'CVE' => 2,
            'KYD' => 2,
            'LKR' => 2,
            'CLP' => 0,
            'CNY' => 2,
            'CNH' => 2,
            'CNX' => 2,
            'COP' => 2,
            'KMF' => 0,
            'ZRN' => 2,
            'CRC' => 2,
            'HRK' => 2,
            'CUP' => 2,
            'CYP' => 2,
            'CSK' => 2,
            'CZK' => 2,
            'DKK' => 2,
            'DOP' => 2,
            'ECS' => 2,
            'SVC' => 2,
            'GQE' => 2,
            'ETB' => 2,
            'ERN' => 2,
            'EEK' => 2,
            'FKP' => 2,
            'FJD' => 2,
            'FIM' => 2,
            'FRF' => 2,
            'DJF' => 0,
            '268' => 2,
            'GMD' => 2,
            'DDM' => 2,
            'DEM' => 2,
            'GHC' => 2,
            'GIP' => 2,
            'GRD' => 0,
            'GTQ' => 2,
            'GNF' => 0,
            'GYD' => 2,
            'HTG' => 2,
            'HNL' => 2,
            'HKD' => 2,
            'HUF' => 2,
            'ISK' => 2,
            'INR' => 2,
            'IDR' => 2,
            'IRR' => 2,
            'IRA' => 2,
            'IQD' => 3,
            'IEP' => 2,
            'ILS' => 2,
            'ITL' => 0,
            'JMD' => 2,
            'JPY' => 0,
            'KZT' => 2,
            'JOD' => 3,
            'KES' => 2,
            'KPW' => 2,
            'KRW' => 0,
            'KWD' => 3,
            'KGS' => 2,
            'LAK' => 2,
            'LBP' => 2,
            'LSL' => 2,
            'LVL' => 2,
            'LRD' => 2,
            'LYD' => 3,
            'LTL' => 2,
            'LUF' => 0,
            'MOP' => 2,
            'MGF' => 0,
            'MWK' => 2,
            'MYR' => 2,
            'MVR' => 2,
            'MLF' => 2,
            'MTL' => 2,
            'MRO' => 2,
            'MUR' => 2,
            'MXN' => 2,
            'MNT' => 2,
            'MDL' => 2,
            'MAD' => 2,
            'MZM' => 2,
            'OMR' => 3,
            'NAD' => 2,
            'NPR' => 2,
            'NLG' => 2,
            'ANG' => 2,
            'AWG' => 2,
            'NTZ' => 2,
            'VUV' => 0,
            'NZD' => 2,
            '566' => 2,
            'NIO' => 2,
            'NGN' => 2,
            'NOK' => 2,
            'PCI' => 0,
            'PKR' => 2,
            'PAB' => 2,
            'PGK' => 2,
            'PYG' => 0,
            'PEN' => 2,
            'PHP' => 2,
            'PLZ' => 2,
            'PTE' => 0,
            'GWP' => 2,
            'TPE' => 0,
            'QAR' => 2,
            'ROL' => 0,
            'RUB' => 2,
            'RWF' => 0,
            'SHP' => 2,
            'STD' => 2,
            'SAR' => 2,
            'SCR' => 2,
            'SLL' => 2,
            'SGD' => 2,
            'SKK' => 2,
            'VND' => 0,
            'SIT' => 2,
            'SOS' => 2,
            'ZAR' => 2,
            'ZWD' => 2,
            'YDD' => 2,
            'ESP' => 0,
            'SSP' => 2,
            'XXX' => 2,
            'SDP' => 2,
            'SDA' => 2,
            'SRG' => 2,
            'SZL' => 2,
            'SEK' => 2,
            'CHF' => 2,
            'SYP' => 2,
            'TJR' => 0,
            'THB' => 2,
            'TOP' => 2,
            'TTD' => 2,
            'AED' => 2,
            'TND' => 3,
            'TRL' => 0,
            'PTL' => 0,
            'TMM' => 2,
            'UGS' => 0,
            'UAK' => 2,
            'MKD' => 2,
            'RUR' => 2,
            'EGP' => 2,
            'GBP' => 2,
            'TZS' => 2,
            'USD' => 2,
            'UYU' => 2,
            'UZS' => 2,
            'VEB' => 2,
            'WST' => 2,
            'YER' => 2,
            'YUD' => 2,
            'CSD' => 2,
            'ZMK' => 2,
            'TWD' => 2,
            'VES' => 2,
            'MRU' => 2,
            'STN' => 2,
            'BYN' => 2,
            'TMT' => 2,
            'GHS' => 2,
            'VEF' => 2,
            'RSD' => 2,
            'MZN' => 2,
            'AZN' => 2,
            'RON' => 2,
            'TRY' => 2,
            'XAF' => 0,
            'XCD' => 2,
            'XOF' => 0,
            'XPF' => 0,
            'XEU' => 2,
            'ZMW' => 2,
            'SRD' => 2,
            'MGA' => 2,
            'AFN' => 2,
            'TJS' => 2,
            'AOA' => 2,
            'BYR' => 0,
            'BGN' => 2,
            'CDF' => 2,
            'BAM' => 2,
            'EUR' => 2,
            'UAH' => 2,
            'GEL' => 2,
            'SDG' => 2,
            'ZWL' => 2,
            'PLN' => 2,
            'BRL' => 2,
            'ESB' => 0
        );
        return array_key_exists($currency, $currency_decimals) ? $currency_decimals[$currency] : 0;
    }
	
    public static function CurrencyCode($currency) {
        $currency_codes = array(
            'ALL' => 8,
            'DZD' => 12,
            'AOK' => 24,
            'MON' => 30,
            'AZM' => 31,
            'ARS' => 32,
            'AUD' => 36,
            'BSD' => 44,
            'BHD' => 48,
            'BDT' => 50,
            'AMD' => 51,
            'BBD' => 52,
            'BMD' => 60,
            'BTN' => 64,
            'BOP' => 68,
            'BAD' => 70,
            'BWP' => 72,
            'BRC' => 76,
            'BZD' => 84,
            'SBD' => 90,
            'BND' => 96,
            'BGL' => 100,
            'BUK' => 104,
            'BIF' => 108,
            'BYB' => 112,
            'KHR' => 116,
            'CAD' => 124,
            'CAD' => 124,
            'CVE' => 132,
            'LKR' => 144,
            'CLP' => 152,
            'CLP' => 152,
            'CNY' => 156,
            'CNH' => 157,
            'COP' => 170,
            'COP' => 170,
            'KMF' => 174,
            'ZRZ' => 180,
            'CRC' => 188,
            'CRC' => 188,
            'CUP' => 192,
            'CYP' => 196,
            'CSK' => 200,
            'CZK' => 203,
            'DKK' => 208,
            'DOP' => 214,
            'ECS' => 218,
            'SVC' => 222,
            'GQE' => 226,
            'ETB' => 230,
            'ERN' => 232,
            'FKP' => 238,
            'FJD' => 242,
            'DJF' => 262,
            'GEL' => 268,
            'GMD' => 270,
            'DDM' => 278,
            'GHC' => 288,
            'GIP' => 292,
            'GTQ' => 320,
            'GNS' => 324,
            'GYD' => 328,
            'HTG' => 332,
            'HNL' => 340,
            'HKD' => 344,
            'HUF' => 348,
            'ISK' => 352,
            'INR' => 356,
            'ISK' => 356,
            'IDR' => 360,
            'IRR' => 364,
            'IRA' => 365,
            'IQD' => 368,
            'ILS' => 376,
            'JMD' => 388,
            'JPY' => 392,
            'JPY' => 392,
            'KZT' => 398,
            'JOD' => 400,
            'KES' => 404,
            'KPW' => 408,
            'KRW' => 410,
            'KWD' => 414,
            'KGS' => 417,
            'LAK' => 418,
            'LBP' => 422,
            'LSM' => 426,
            'LVL' => 428,
            'LRD' => 430,
            'LYD' => 434,
            'LTL' => 440,
            'MOP' => 446,
            'MGF' => 450,
            'MWK' => 454,
            'MYR' => 458,
            'MVR' => 462,
            'MLF' => 466,
            'MTL' => 470,
            'MRO' => 478,
            'MUR' => 480,
            'MXP' => 484,
            'MXN' => 484,
            'MNT' => 496,
            'MDL' => 498,
            'MAD' => 504,
            'MZM' => 508,
            'OMR' => 512,
            'NAD' => 516,
            'NPR' => 524,
            'ANG' => 532,
            'AWG' => 533,
            'NTZ' => 536,
            'VUV' => 548,
            'NZD' => 554,
            'NIC' => 558,
            'NGN' => 566,
            'NOK' => 578,
            'PCI' => 582,
            'PKR' => 586,
            'PAB' => 590,
            'PGK' => 598,
            'PYG' => 600,
            'PEI' => 604,
            'PEI' => 604,
            'PHP' => 608,
            'PLZ' => 616,
            'TPE' => 626,
            'QAR' => 634,
            'ROL' => 642,
            'RUB' => 643,
            'RWF' => 646,
            'SHP' => 654,
            'STD' => 678,
            'SAR' => 682,
            'SCR' => 690,
            'SLL' => 694,
            'SGD' => 702,
            'SKK' => 703,
            'VND' => 704,
            'SIT' => 705,
            'SOS' => 706,
            'ZAR' => 710,
            'ZWD' => 716,
            'YDD' => 720,
            'SSP' => 728,
            'SDP' => 736,
            'SDA' => 737,
            'SRG' => 740,
            'SZL' => 748,
            'SEK' => 752,
            'CHF' => 756,
            'CHF' => 756,
            'SYP' => 760,
            'TJR' => 762,
            'THB' => 764,
            'TOP' => 776,
            'TTD' => 780,
            'AED' => 784,
            'TND' => 788,
            'TRL' => 792,
            'PTL' => 793,
            'TMM' => 795,
            'UGS' => 800,
            'UAK' => 804,
            'MKD' => 807,
            'RUR' => 810,
            'EGP' => 818,
            'GBP' => 826,
            'TZS' => 834,
            'USD' => 840,
            'UYP' => 858,
            'UYP' => 858,
            'UZS' => 860,
            'VEB' => 862,
            'WST' => 882,
            'YER' => 886,
            'YUD' => 890,
            'YUG' => 891,
            'ZMK' => 892,
            'TWD' => 901,
            'TMT' => 934,
            'GHS' => 936,
            'RSD' => 941,
            'MZN' => 943,
            'AZN' => 944,
            'RON' => 946,
            'TRY' => 949,
            'TRY' => 949,
            'XAF' => 950,
            'XCD' => 951,
            'XOF' => 952,
            'XPF' => 953,
            'XEU' => 954,
            'ZMW' => 967,
            'SRD' => 968,
            'MGA' => 969,
            'AFN' => 971,
            'TJS' => 972,
            'AOA' => 973,
            'BYR' => 974,
            'BGN' => 975,
            'CDF' => 976,
            'BAM' => 977,
            'EUR' => 978,
            'UAH' => 980,
            'GEL' => 981,
            'PLN' => 985,
            'BRL' => 986,
            'BRL' => 986,
            'ZAL' => 991,
            'EEK' => 2333,
        );

        return array_key_exists($currency, $currency_codes) ? $currency_codes[$currency] : 0;
    }
}