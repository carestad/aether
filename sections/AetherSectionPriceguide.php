<?php
/*
HARDWARE.NO EDITORSETTINGS:
vim:set tabstop=4:
vim:set shiftwidth=4:
vim:set smarttab:
vim:set expandtab:
*/

require_once('/home/lib/libDefines.lib.php');
require_once(AETHER_PATH . 'lib/AetherSection.php');
require_once(AETHER_PATH . 'lib/AetherTextResponse.php');
require_once(AETHER_PATH . 'lib/AetherModuleFactory.php');

/**
 * 
 * Entry point to all priceguide applicatino sections
 * 
 * Created: 2007-02-02
 * @author Raymond Julin
 * @package aether.sections
 */

class AetherSectionPriceguide extends AetherSection {
    
    /**
     * Return response
     *
     * @access public
     * @return AetherResponse
     */
    public function response() {
        // We have a text response, good, now wrap it and have it processed
        $tpl = $this->sl->getTemplate(96);
        $tpl->selectTemplate('wrapper');
        // Inherited method
        $tpl->setVar('content', $this->renderModules($tpl));

        $response = new AetherTextResponse($tpl->returnPage());
        return $response;
    }
}
?>