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

/**
 * Default Helper
 *
 * @package SSE_DebugErrors
 */
class SSE_DebugErrors_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_ENABLE = 'dev/debug/debug_errors_enable';
    const XML_PATH_HANDLER = 'dev/debug/debug_errors_handler';

    public function isEnabled()
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_ENABLE) && Mage::helper('core')->isDevAllowed();
    }
}