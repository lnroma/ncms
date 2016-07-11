<?php

/**
 * Created by PhpStorm.
 * User: roman
 * Date: 10.07.16
 * Time: 14:56
 */
class Install_Controller_Index
{
    /**
     * save install data
     */
    public function indexAction()
    {
        if (file_exists($this->_getTmpPath() . 'var/lock.install')) {
            die('install is lock');
        } else {
            $this->_generateFileFSConfig();
            $this->_generateFileDbConfig();
            $this->_runInstall();
            $this->_lockInstall();
            die('Your application is install success full');
        }
    }

    /**
     * todo I need work in this method
     * run migrate and install modules scripts
     */
    protected function _runInstall()
    {
        $moduleConfig = Core_App::getModulesConfig();
//        var_dump($moduleConfig);die
        $configModule = array();
        foreach($moduleConfig as $_config) {
            $configModule[] = $_config['config_class']::getConfig()['install_script'];
            var_dump($configModule);
        }
    }

    /**
     * lock install after setup configuration
     * @return int
     */
    protected function _lockInstall() {
        return file_put_contents($this->_getTmpPath().'var/install.lock','this is lock file, remove him for unlock install');
    }

    /**
     * unlock install process
     * @return bool
     */
    protected function _unlockInstall()
    {
        return unlink($this->_getTmpPath().'var/install.lock');
    }

    /**
     * generate config file system
     * @return bool
     */
    protected function _generateFileFSConfig()
    {
        $post = $_POST;

        $tmp = array(
            'base_path' => $post['base_patch'],
            'base_url'  => $post['base_url']
        );

        $content = "<?php return unserialize('" . serialize($tmp) . "');";

        $result = file_put_contents($this->_getTmpPath().'Config/Fs.php',$content);
        if($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * generate configuration file for database
     * @return bool
     */
    protected function _generateFileDbConfig()
    {
        $tmp = array(
            'db_host' => 'mysql:host='.$_POST['db']['host'].';dbname='.$_POST['db']['name'],
            'user' => $_POST['db']['user'],
            'pass' => $_POST['db']['pass'],
            'mongodb' => array(
                'connect' => $_POST['db']['mongodb']['connect'],
                'db'      => $_POST['db']['mongodb']['db']
            )
        );

        $content = "<?php return unserialize('". serialize($tmp)."');";

        $result = file_put_contents($this->_getTmpPath().'Config/Db.php',$content);

        if($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * get tmp path to base
     * @return null|string
     */
    protected function _getTmpPath()
    {
        $path = Core_App::getRootPath();
        if (is_null($path)) {
            $path = __FILE__ . '../../../';
        }
        $path = realpath(
            $path
        );
        $path .= '/';

        return $path;
    }
}