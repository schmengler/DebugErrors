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

class SSE_DebugErrors_Model_Errorhandler
{
    /**
     * @var SSE_DebugErrors_Model_Errorhandler_Interface
     */
    protected $_handler;

    public function handle(SSE_DebugErrors_Exception $exception)
    {
        $this->_getHandler()->handle($exception);
    }

    /**
     * @return SSE_DebugErrors_Model_Errorhandler_Interface
     */
    protected function _getHandler()
    {
        if ($this->_handler === null) {
            $handlerClass = 'sse_debugerrors/errorhandler_' . Mage::getStoreConfig(SSE_DebugErrors_Helper_Data::XML_PATH_HANDLER);
            $this->_handler = Mage::getModel($handlerClass);
            if (!$this->_handler instanceof SSE_DebugErrors_Model_Errorhandler_Interface) {
                $this->_handler = Mage::getModel('sse_debugerrors/errorhandler_exception_log');
            }
        }
        return $this->_handler;
    }
}