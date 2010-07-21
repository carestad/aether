<?php

/**
 * 
 * Generic section, only serves up modules and does nothing.
 * Should mainly be used for prototyping and testing
 * but also totaly generic services like login and logout
 * can use this, unless the context requires some sort of logging
 * 
 * Created: 2007-04-23
 * @author Raymond Julin
 * @package aether.sections
 */

class HTTP extends AetherSection {
    
    /**
     * Return response
     *
     * @access public
     * @return AetherResponse
     */
    public function response() {
        $config = $this->sl->get('aetherConfig');
        $options = $config->getOptions();
        if (isset($options['statuscode'])) {
            $status = $options['statuscode'];
            $data = isset($options['statusdata']) ? $options['statusdata'] : '';

            $action = new AetherActionResponse($status, $data);
            $action->draw($this->sl);
        }
        return new AetherTextResponse($this->renderModules());
    }
}
