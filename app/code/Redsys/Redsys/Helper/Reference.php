<?php
/**
 * NOTA SOBRE LA LICENCIA DE USO DEL SOFTWARE
 * 
 * El uso de este software est� sujeto a las Condiciones de uso de software que
 * se incluyen en el paquete en el documento "Aviso Legal.pdf". Tambi�n puede
 * obtener una copia en la siguiente url:
 * http://www.redsys.es/wps/portal/redsys/publica/areadeserviciosweb/descargaDeDocumentacionYEjecutables
 * 
 * Redsys es titular de todos los derechos de propiedad intelectual e industrial
 * del software.
 * 
 * Quedan expresamente prohibidas la reproducci�n, la distribuci�n y la
 * comunicaci�n p�blica, incluida su modalidad de puesta a disposici�n con fines
 * distintos a los descritos en las Condiciones de uso.
 * 
 * Redsys se reserva la posibilidad de ejercer las acciones legales que le
 * correspondan para hacer valer sus derechos frente a cualquier infracci�n de
 * los derechos de propiedad intelectual y/o industrial.
 * 
 * Redsys Servicios de Procesamiento, S.L., CIF B85955367
 */

namespace Redsys\Redsys\Helper;

//use Redsys\Redsys\Helper\RedsysLibrary;

class Reference extends \Magento\Framework\App\Helper\AbstractHelper {

	protected $_resource;
	protected $_db;

	function __construct(
		\Magento\Framework\App\ResourceConnection $resource
	) {
		$this->_resource = $resource;
		$this->_db = $resource->getConnection();
	}

	private function getResource() {
		return $this->_resource;
	}

	private function getDb() {
		return $this->_db;
	}

	public function saveReference($customerId, $reference, $cardNumber, $brand, $cardType) {
		if ($reference != null && strlen($reference) > 0 && $this->checkRefTable() && $customerId) {
			$db = $this->getDb();
			$resource = $this->getResource();
			$tableName = $resource->getTableName('redsys_reference');
			
			$supportedBrands = array(1, 2, 8, 9, 22);

			if (!in_array($brand, $supportedBrands)) {
				$brand = null;
			}
			$oldRef = $this->getCustomerRef($customerId);
			$maskedCard = $this->maskCardNumber($cardNumber);
			if ($oldRef == null)
				$db->query("INSERT INTO `" . $tableName . "` (customerId, reference, version, cardNumber, brand, cardType) VALUES (" . $customerId . ", '" . $reference . "', '4.0.0', '" . $maskedCard . "', '" . $brand . "', '" . $cardType . "');");
			else
				$db->query("UPDATE `" . $tableName . "` SET reference = '" . $reference . "', cardNumber = '" . $maskedCard . "', brand = '" . $brand . "', cardType = '" . $cardType . "' WHERE customerId = " . $customerId . ";");
		}
		else {
		}
	}

	public function getCustomerRef($customerId) {
		if ($this->checkRefTable() && $customerId){
			$db = $this->getDb();
			$resource = $this->getResource();
			$tableName = $resource->getTableName('redsys_reference');
			$sql = "SELECT * FROM `" . $tableName . "` WHERE `customerId` = " . $customerId . ";";
			$query = $db->query($sql);
			if ($query->rowCount() != 0) {
				$res = $query->fetchAll();
				return array(
					$res[0]['reference'],
					$res[0]['cardNumber'],
					$res[0]['brand'],
					$res[0]['cardType']
				);
			}
		}
		return null;
	}

	private function checkRefTable() {
		$db = $this->getDb();
		$resource = $this->getResource();
		$tableName = $resource->getTableName('redsys_reference');
		$sql = "SHOW TABLES LIKE '" . $tableName . "'";
		if ($db->query($sql)->rowCount() == 0)
			$this->createRefTable();
		return $db->query($sql)->rowCount() > 0;
	}

	private function createRefTable() {
		$db = $this->getDb();
		$resource = $this->getResource();
		$tableName = $resource->getTableName('redsys_reference');
		$sql = "CREATE TABLE IF NOT EXISTS `" . $tableName . "` (
			`customerId` INT NOT NULL PRIMARY KEY,
			`version` VARCHAR(10) NOT NULL,
			`reference` VARCHAR(128) NOT NULL,
			`cardNumber` VARCHAR(24),
			`brand` SMALLINT,
			`cardType` VARCHAR(1),
			INDEX (`customerId`));
		";
		$db->query($sql);
	}

	public function dropRefTable() {
		$db = $this->getDb();
		$resource = $this->getResource();
		$tableName = $resource->getTableName('redsys_reference');
		$sql = "DROP TABLE IF EXISTS`" . $tableName . "`";
		$db->query($sql);
	}

	private function maskCardNumber($cardNumber) {
		if ($cardNumber == null || strlen($cardNumber) <= 4) 
			return $cardNumber;
		return str_pad(substr($cardNumber, -4, 4), 5, "*", STR_PAD_LEFT);
	}
}


?>