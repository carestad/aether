<?php // vim:set tabstop=4 shiftwidth=4 smarttab expandtab:
/**
 * 
 * Factory for loading modules
 * 
 * Created: 2007-02-06
 * @author Raymond Julin
 * @package aether.lib
 */

class AetherModuleFactory {
    
    /**
     * The path to search for modules in
     * @var string
     */
    static public $path = '';
    
    /**
     * Have a mode strict that says wether or not the factory
     * expects all modules to be under $dir/modules
     * If "false" then $dir will be searched
     * If "true" then $dir/modules (old school style) will be searched (default)
     * @var boolean
     */
    static public $strict = true;
    
    /**
     * Createa instance of module
     *
     * @access public
     * @return AetherModule
     * @param string $module
     * @param AetherServiceLocator $sl
     * @param array $options
     */
    public static function create($module, AetherServiceLocator $sl, $options=array()) {
        if (!strpos(self::$path, ';'))
            $paths = array(self::$path);
        else {
            $paths = array_map('trim', explode(';', self::$path));
        }
        foreach ($paths as $path) {
            if (substr($path, -1) != '/')
                $path .= '/';

            if (self::$strict)
                $file = $path . 'modules/' . $module . '.php';
            else
                $file = $path . $module . '.php';
            if (file_exists($file)) {
                include_once($file);
                // Module class names based on module path
                // E.g. modules/foo/bar/baz.php -> class FooBarBaz
                $class = preg_split('/[\/_]+/', $module);
                $class = array_map('ucfirst', $class);
                $class = join('', $class);
                $mod = new $class($sl, $options);
                return $mod;
            }
        }
        throw new Exception("Module '$module' does not exist in path [" . join(", ", $paths) . "]");
    }
}
