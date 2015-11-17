<?php
/**
 * This file is part of SSE_DebugErrors for Magento.
 *
 * @license http://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * @author Fabian Schmengler <fabian@schmengler-se.de>
 * @category SSE
 * @package SSE_DebugErrors
 * @copyright Copyright (c) 2015 Schmengler Software Engineering (http://www.schmengler-se.de/)
 */
class SSE_DebugErrors_Exception extends Mage_Core_Exception
{
    /**
     * @var Mage_Core_Block_Abstract
     */
    protected $block;

    public function __construct($message = "", $code = 0, Exception $previous = null, Mage_Core_Block_Abstract $block = null)
    {
        parent::__construct($message, $code, $previous);
        if ($block !== null) {
            $this->block = $block;
        }
    }

    /**
     * @return Mage_Core_Block_Abstract
     */
    public function getBlock()
    {
        return $this->block;
    }


}