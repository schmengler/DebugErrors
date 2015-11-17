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
 * Observer for extended error messages
 *
 * @package SSE_DebugErrors
 */
class SSE_DebugErrors_Model_Observer
{
    protected $_allowSymlinks = null;

    public function coreBlockAbstractToHtmlBefore(Varien_Event_Observer $observer)
    {
        /** @var Mage_Core_Block_Abstract $block */
        $block = $observer->getBlock();
        if ($block instanceof Mage_Core_Block_Template && Mage::helper('sse_debugerrors')->isEnabled()) {
            $this->_checkPossibleTemplateErrors($block);
        }
    }

    /**
     * @return bool
     */
    protected function _getAllowSymlinks()
    {
        if (is_null($this->_allowSymlinks)) {
            $this->_allowSymlinks = Mage::getStoreConfigFlag(Mage_Core_Block_Template::XML_PATH_TEMPLATE_ALLOW_SYMLINK);
        }
        return $this->_allowSymlinks;
    }

    protected function _triggerError(Exception $e)
    {
        Mage::getSingleton('sse_debugerrors/errorhandler')->handle($e);
    }

    /**
     * @param $block
     */
    protected function _checkPossibleTemplateErrors($block)
    {
        if (!$block->getTemplate()) {
            /*
             * Blocks without template are rendered empty. Unfortunately core modules rely on this and throwing
             * an error here would result in too many false positives.
             */
            return;
        }
        try {
            $dir = Mage::getBaseDir('design');
            $scriptPath = realpath($dir);
            if ($scriptPath === false) {
                throw new SSE_DebugErrors_Exception(sprintf(
                    'Block %s (type %s): Design base dir %s not found.',
                    $block->getNameInLayout(), get_class($block), $scriptPath), 0, null, $block);
            }
            if (strpos($scriptPath, realpath(Mage::getBaseDir('design'))) !== 0 && !$this->_getAllowSymlinks()) {
                throw new SSE_DebugErrors_Exception(sprintf(
                    'Block %s (type %s): Design base dir %s is a symlink and symlinks are configured to be forbidden.',
                    $block->getNameInLayout(), get_class($block), $scriptPath), 0, null, $block);
            }
            $fileName = $block->getTemplateFile();

            $includeFilePath = realpath($dir . DS . $fileName);
            if ($includeFilePath === false) {
                throw new SSE_DebugErrors_Exception(sprintf(
                    'Block %s (type %s): Template path %s not found',
                    $block->getNameInLayout(), get_class($block), $dir . DS . $fileName), 0, null, $block);
            }
            if (strpos($includeFilePath, realpath($dir)) !== 0 && !$this->_getAllowSymlinks()) {
                throw new SSE_DebugErrors_Exception(sprintf(
                    'Block %s (type %s): Template path %s is a symlink and symlinks are configured to be forbidden.',
                    $block->getNameInLayout(), get_class($block), $dir), 0, null, $block);
            }
        } catch (SSE_DebugErrors_Exception $e) {
            $this->_triggerError($e);
        }
    }

}
