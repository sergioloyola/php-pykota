<html>
<head>
</head>
<body>

<?php
include('config/config.php');
include('config/funciones.php');
$log = new Logging();
 
// set path and name of log file (optional)
$log->lfile('/var/log/web_pykota.log');

session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Username or Password is invalid";
}
else
{
// Define $username and $password
$username=$_POST['username'];
$password=$_POST['password'];
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);
$password = md5($password);
$query = mysql_query("select * from login where password='$password' AND usuario='$username'", $conexion);
$rows = mysql_num_rows($query);
if ($rows == 1) {

$consultarol=mysql_query("select perfil from login where password='$password' AND usuario='$username'", $conexion);
$result = mysql_fetch_array($consultarol);
$rol=$result['perfil'];
$_SESSION['login_user']=$username; // Initializing Session
$_SESSION['login_rol']=$rol; // Initializing Session
historial("SyStem","El usuario a ingresado al sistema",$username,$conexion);
header("location: profile.php"); // Redirecting To Other Page
} else {
?>
<script type="text/javascript">
    alert("Usuario o contraseña Invalido!!!.");
//     location.href='eliminar_usuario.php?' + Math.random();
</script>
<?php
$log->lwrite('pykota: Error de autenticacion del usuario '.$username.' desde '.$_SERVER['REMOTE_ADDR']);
$log->lclose();
}
mysql_close($conexion); // Closing Connection
}
}
/** 
 * Logging class:
 * - contains lfile, lwrite and lclose public methods
 * - lfile sets path and name of log file
 * - lwrite writes message to the log file (and implicitly opens log file)
 * - lclose closes log file
 * - first call of lwrite method will open log file implicitly
 * - message is written with the following format: [d/M/Y:H:i:s] (script name) message
 */
class Logging {
    // declare log file and file pointer as private properties
    private $log_file, $fp;
    // set log file (path and name)
    public function lfile($path) {
        $this->log_file = $path;
    }
    // write message to the log file
    public function lwrite($message) {
        // if file pointer doesn't exist, then open log file
        if (!is_resource($this->fp)) {
            $this->lopen();
        }
        // define script name
//        $script_name = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
        // define current time and suppress E_WARNING if using the system TZ settings
        // (don't forget to set the INI setting date.timezone)
        $time = @date('[d/M/Y:H:i:s]');
        // write current time, script name and message to the log file
//        fwrite($this->fp, "$time ($script_name) $message" . PHP_EOL);
        fwrite($this->fp, "$time $message" . PHP_EOL);
    }
    // close log file (it's always a good idea to close a file when you're done with it)
    public function lclose() {
        fclose($this->fp);
    }
    // open log file (private method)
    private function lopen() {
        // in case of Windows set default log file
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $log_file_default = 'c:/php/logfile.txt';
        }
        // set default log file for Linux and other systems
        else {
            $log_file_default = '/tmp/logfile.txt';
        }
        // define log file from lfile method or use previously set default
        $lfile = $this->log_file ? $this->log_file : $log_file_default;
        // open log file for writing only and place file pointer at the end of the file
        // (if the file does not exist, try to create it)
        $this->fp = fopen($lfile, 'a') or exit("Can't open $lfile!");
    }
}
?>
</body>
</html>
