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

class SSE_DebugErrors_Model_Errorhandler_Exception_Show implements SSE_DebugErrors_Model_Errorhandler_Interface
{
    public function handle(SSE_DebugErrors_Exception $exception)
    {
        $exception->getBlock()->setTemplate('sse_debugerrors/exception.phtml')->setException($exception);
        Mage::logException($exception);
    }
}