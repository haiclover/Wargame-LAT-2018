<?php
    exec("chmod 777 index.php");
    exec("chmod 777 css");
    exec("chmod 777 js");
    exec("chmod 777 term.php");
    exec("chmod 644 .htaccess");
    ini_set("session.cookie_lifetime","360");
    session_start();
    define('ROOT','/var/www');
    define('PASSWORD','latcompany');
    define('BLOCKED','ssh,telnet,rm,rmdir,mkdir,cd,mv,zip,tar,sudo,curl,touch,cp,wget,yum,apt-get,cabal,rbash,grep,source,uniq,alias,sudo,ln,tar,gzip,adduser,passwd,su,make,rpm,dpkg,shutdown,reboot,startx,cat,chown,nano,vim,php,echo,print,var_dump,print_r');
    class Terminal{
        public $command          = '';
        public $output           = '';
        public $directory        = '';
        public $command_exec     = '';
        public function __construct(){
            if(!isset($_SESSION['dir'])){
                if(ROOT==''){
                    $this->command_exec = 'pwd';
                    $this->Execute();
                    $_SESSION['dir'] = $this->output;
                }
                else{
                    $this->directory = ROOT;
                    $this->ChangeDirectory();
                }
            }
            else{
                $this->directory = $_SESSION['dir'];
                $this->ChangeDirectory();
            }

        }
        public function Process(){
            $this->ParseCommand();
            $this->Execute();
            return $this->output;
        }
        public function ParseCommand(){
                // Explode command
                $command_parts = explode(" ",$this->command);
                // Handle 'cd' command
                /////////////////////////////////////////////////////////////
            
                // if(in_array('cd',$command_parts)){
                //     $cd_key = array_search('cd', $command_parts);
                //     $cd_key++;
                //     $this->directory = $command_parts[$cd_key];
                //     $this->ChangeDirectory();
                //     // Remove from command
                //     $this->command = str_replace('cd '.$this->directory,'',$this->command);
                // }
                
                /////////////////////////////////////////////////////////////
            // Replace text editors with cat
            $editors = array('vi','vim','nano');
            $this->command = str_replace($editors,'cat',$this->command);
            
            // Handle blocked commands
            $blocked = explode(',',BLOCKED);
            if(in_array($command_parts[0],$blocked)){
                $this->command = 'echo ERROR: Command not allowed';
            }
            // Update exec command
            $this->command_exec = $this->command . ' 2>&1';
        }
        public function ChangeDirectory(){
            chdir($this->directory);//->chuyển sang thư mục khác
            // Store new directory
            $_SESSION['dir'] = exec('pwd'); // exec('pwd')=getcwd()
        }
        public function Execute(){
            //system
            if(function_exists('system')){
                ob_start();
                system($this->command_exec);
                $this->output = ob_get_contents();
                ob_end_clean();
            }
            // passthru
            if(function_exists('passthru')){
                ob_start();
                passthru($this->command_exec);
                $this->output = ob_get_contents();
                ob_end_clean();
            }
            // exec
            if(function_exists('exec')){
                exec($this->command_exec , $this->output);
                $this->output = implode("\n" , $output);
            }
            // shell_exec
            if(function_exists('shell_exec')){
                $this->output = shell_exec($this->command_exec);
            }
            // no support
            else{
                $this->output = 'Wrong Command :)';
            }
        }        
        
    }
    $command = '';
    if(!empty($_POST['command']))
    { 
        $command = $_POST['command']; 
    }
    
    if(strtolower($command=='exit'))
    {
        $_SESSION['term_auth'] = 'false';
        $output = '[CLOSED]';  
    }
    else if($_SESSION['term_auth']!='true')
    {
        if($command==PASSWORD){
            $_SESSION['term_auth'] = 'true';
            $output = '[AUTHENTICATED]';
        }else{
            $output = 'Enter Password:';
        }
        
    }
    else
    {
        // Split &&
        $Terminal = new Terminal();
        $output = '';
        $command = explode("&&", $command);
        foreach($command as $c){
            $Terminal->command = $c;
            $output .= $Terminal->Process();
        }
    
    }
    
    echo(htmlentities($output));
    if($_POST['command']=="ten")
    {
        echo "HAI";
    }


?>