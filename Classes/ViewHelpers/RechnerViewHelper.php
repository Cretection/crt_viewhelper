<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

namespace CrtViewhelper\CrtViewhelper\ViewHelpers;

class RechnerViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {
    
    /**
      * Rechner
      * @param int $argument 
      * @param int $type 
      * @return string 
      * @author Koller Michel
      */
    public function render($argument, $type) {
        
        $result=$argument*$type;

    return $result;
    }
}