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

class SSE_DebugErrors_Model_System_Config_Handler
{
    /*
     * TODO: other handlers:
     * - custom log file
     */
    const HANDLER_EXCEPTION_THROW = 'exception_throw';
    const HANDLER_EXCEPTION_LOG = 'exception_log';
    const HANDLER_EXCEPTION_SHOW = 'exception_show';
    const HANDLER_WARNING = 'warning';

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => self::HANDLER_EXCEPTION_THROW, 'label' => Mage::helper('sse_debugerrors')->__('Throw exception immediately')),
            array('value' => self::HANDLER_EXCEPTION_SHOW, 'label' => Mage::helper('sse_debugerrors')->__('Show exception in block')),
            array('value' => self::HANDLER_EXCEPTION_LOG, 'label' => Mage::helper('sse_debugerrors')->__('Only log exception to exception log')),
            array('value' => self::HANDLER_WARNING, 'label' => Mage::helper('sse_debugerrors')->__('Trigger PHP Warning')),
        );
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        $result = [];
        foreach ($this->toOptionArray() as $option) {
            $result[$option['value']] = $option['label'];
        }
        return $result;
    }
}