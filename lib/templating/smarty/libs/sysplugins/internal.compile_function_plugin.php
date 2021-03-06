<?php
/**
* Smarty Internal Plugin Compile Function Plugin
* 
* Compiles code for the execution of function plugin
* 
* @package Smarty
* @subpackage Compiler
* @author Uwe Tews 
*/
/**
* Smarty Internal Plugin Compile Function Plugin Class
*/
class Smarty_Internal_Compile_Function_Plugin extends Smarty_Internal_CompileBase {
    /**
    * Compiles code for the execution of function plugin
    * 
    * @param array $args array with attributes from parser
    * @param string $tag name of function
    * @param object $compiler compiler object
    * @return string compiled code
    */
    public function compile($args, $tag, $compiler)
    {
        $this->compiler = $compiler; 
        // This tag does create output
        $this->compiler->has_output = true;

        $this->required_attributes = array();
        $this->optional_attributes = array('_any'); 
        // check and get attributes
        $_attr = $this->_get_attributes($args);
        // convert attributes into parameter array string
        $_paramsArray = array();
        foreach ($_attr as $_key => $_value) {
            $_paramsArray[] = "'$_key'=>$_value";
        } 
        $_params = 'array(' . implode(",", $_paramsArray) . ')'; 
        // compile code
        $output = '<?php echo $_smarty_tpl->smarty->plugin_handler->' . $tag . '(array(' . $_params . ',$_smarty_tpl->smarty,$_smarty_tpl),\'function\');?>';

        return $output;
    } 
} 

?>
