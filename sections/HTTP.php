<?php
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
