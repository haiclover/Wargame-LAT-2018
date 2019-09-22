<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js"></script>
    </head>
</html>
<?php


// Default language
$lang = 'en';

// Auth with login/password (set true/false to enable/disable it)
$use_auth = true;

// Users: array('Username' => 'Password', 'Username2' => 'Password2', ...), Password has to encripted into MD5
$auth_users = array(
    'haiclover' => '2b89dd8a4b50991a95b09f732b43c091', //admin
);

// Readonly users (usernames array)
$readonly_users = array(
    'user'
);

// Show or hide files and folders that starts with a dot
$show_hidden_files = true;

// Enable highlight.js (https://highlightjs.org/) on view's page
$use_highlightjs = true;

// highlight.js style
$highlightjs_style = 'vs';

// Enable ace.js (https://ace.c9.io/) on view's page
$edit_files = true;

// Send files though mail
$send_mail = false;

// Send files though mail
$toMailId = ""; //yourmailid@mail.com

// Default timezone for date() and time() - http://php.net/manual/en/timezones.php
$default_timezone = 'Etc/UTC'; // UTC

// Root path for file manager
$root_path = $_SERVER['DOCUMENT_ROOT'];

// Root url for links in file manager.Relative to $http_host. Variants: '', 'path/to/subfolder'
// Will not working if $root_path will be outside of server document root
$root_url = '';

// Server hostname. Can set manually if wrong
$http_host = $_SERVER['HTTP_HOST'];

// input encoding for iconv
$iconv_input_encoding = 'UTF-8';

// date() format for file modification date
$datetime_format = 'd.m.y H:i';

// allowed upload file extensions
$upload_extensions = ''; // 'gif,png,jpg'

// show or hide the left side tree view
$show_tree_view = false;

//Array of folders excluded from listing
$GLOBALS['exclude_folders'] = array(
);

// include user config php file
if (defined('FM_CONFIG') && is_file(FM_CONFIG) ) {
	include(FM_CONFIG);
}

//--- EDIT BELOW CAREFULLY OR DO NOT EDIT AT ALL

// if fm included
if (defined('FM_EMBED')) {
    $use_auth = false;
} else {
    @set_time_limit(600);

    date_default_timezone_set($default_timezone);

    ini_set('default_charset', 'UTF-8');
    if (version_compare(PHP_VERSION, '5.6.0', '<') && function_exists('mb_internal_encoding')) {
        mb_internal_encoding('UTF-8');
    }
    if (function_exists('mb_regex_encoding')) {
        mb_regex_encoding('UTF-8');
    }

    session_cache_limiter('');
    session_name('filemanager');
    session_start();
}

if (empty($auth_users)) {
    $use_auth = false;
}

$is_https = isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1)
    || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https';

// clean and check $root_path
$root_path = rtrim($root_path, '\\/');
$root_path = str_replace('\\', '/', $root_path);
if (!@is_dir($root_path)) {
    echo "<h1>Root path \"{$root_path}\" not found!</h1>";
    exit;
}

// clean $root_url
$root_url = fm_clean_path($root_url);

// abs path for site
defined('FM_SHOW_HIDDEN') || define('FM_SHOW_HIDDEN', $show_hidden_files);
defined('FM_ROOT_PATH') || define('FM_ROOT_PATH', $root_path);
defined('FM_ROOT_URL') || define('FM_ROOT_URL', ($is_https ? 'https' : 'http') . '://' . $http_host . (!empty($root_url) ? '/' . $root_url : ''));
defined('FM_SELF_URL') || define('FM_SELF_URL', ($is_https ? 'https' : 'http') . '://' . $http_host . $_SERVER['PHP_SELF']);

// logout
if (isset($_GET['logout'])) {
    unset($_SESSION['logged']);
    fm_redirect(FM_SELF_URL);
}

// Show image here
if (isset($_GET['img'])) {
    fm_show_image($_GET['img']);
}

// Auth
if ($use_auth) {
    if (isset($_SESSION['logged'], $auth_users[$_SESSION['logged']])) {
        // Logged
    } 
    elseif (isset($_POST['fm_usr'], $_POST['fm_pwd'])) {
        // Logging In
        sleep(1);
        if (isset($auth_users[$_POST['fm_usr']]) && md5($_POST['fm_pwd']) === $auth_users[$_POST['fm_usr']]) {
            $_SESSION['logged'] = $_POST['fm_usr'];
            fm_set_msg('You are logged in');
            fm_redirect(FM_SELF_URL . '?p=');
        }
        else {
            unset($_SESSION['logged']);
            fm_set_msg('Wrong password', 'error');
            fm_redirect(FM_SELF_URL);
        }
    } 
    else {
        // Form
        unset($_SESSION['logged']);
        fm_show_header_login();
        fm_show_message();
        ?>
        <div class="row my-5"></div>
        <div class="row my-5"></div>
        <div class="row justify-content-center my-5">
            <div class="col-auto">
                <a href="#"><img src="https://i.imgur.com/Uah0thu.jpg" alt="Hải Clover File manager" style="margin:20px;"></a>
                <form action="" method="post" enctype="">
                    Tên Đăng Nhập: <input type="text" id="fm_usr" name="fm_usr" value="" placeholder="vd:Đinh Viết Hải..." class="form-control">
                    Mật Khẩu: <input type="password" id="fm_pwd" name="fm_pwd" value="" placeholder="vd:123456.." class="form-control mt-2">
                    <input type="submit" name="submit" value="Đăng Nhập" class="btn btn-outline-success mt-2">
                </form>
            </div>
        </div>

        
        <?php
        fm_show_footer_login();
        exit;
    }
}

defined('FM_LANG') || define('FM_LANG', $lang);
defined('FM_EXTENSION') || define('FM_EXTENSION', $upload_extensions);
defined('FM_TREEVIEW') || define('FM_TREEVIEW', $show_tree_view);
define('FM_READONLY', $use_auth && !empty($readonly_users) && isset($_SESSION['logged']) && in_array($_SESSION['logged'], $readonly_users));
define('FM_IS_WIN', DIRECTORY_SEPARATOR == '\\');

// always use ?p=
if (!isset($_GET['p'])) {
    fm_redirect(FM_SELF_URL . '?p=');
}

// get path
$p = isset($_GET['p']) ? $_GET['p'] : (isset($_POST['p']) ? $_POST['p'] : '');

// clean path
$p = fm_clean_path($p);

// instead globals vars
define('FM_PATH', $p);
define('FM_USE_AUTH', $use_auth);
define('FM_EDIT_FILE', $edit_files);
defined('FM_ICONV_INPUT_ENC') || define('FM_ICONV_INPUT_ENC', $iconv_input_encoding);
defined('FM_USE_HIGHLIGHTJS') || define('FM_USE_HIGHLIGHTJS', $use_highlightjs);
defined('FM_HIGHLIGHTJS_STYLE') || define('FM_HIGHLIGHTJS_STYLE', $highlightjs_style);
defined('FM_DATETIME_FORMAT') || define('FM_DATETIME_FORMAT', $datetime_format);

unset($p, $use_auth, $iconv_input_encoding, $use_highlightjs, $highlightjs_style);

/*************************** ACTIONS ***************************/

//AJAX Request
if (isset($_POST['ajax']) && !FM_READONLY) {

    //search : get list of files from the current folder
    if(isset($_POST['type']) && $_POST['type']=="search") {
        $dir = $_POST['path'];
        $response = scan($dir);
        echo json_encode($response);
    }

    //Send file to mail
    if (isset($_POST['type']) && $_POST['type']=="mail") {
        //send mail Fn removed.
    }

    //backup files
    if(isset($_POST['type']) && $_POST['type']=="backup") {
        $file = $_POST['file'];
        $path = $_POST['path'];
        $date = date("dMy-His");
        $newFile = $file.'-'.$date.'.bak';
        copy($path.'/'.$file, $path.'/'.$newFile) or die("Unable to backup");
        echo "Backup $newFile Created";
    }

    exit;
}

// Delete file / folder
if (isset($_GET['del']) && !FM_READONLY) {
    $del = $_GET['del'];
    $del = fm_clean_path($del);
    $del = str_replace('/', '', $del);
    if ($del != '' && $del != '..' && $del != '.') {
        $path = FM_ROOT_PATH;
        if (FM_PATH != '') {
            $path .= '/' . FM_PATH;
        }
        $is_dir = is_dir($path . '/' . $del);
        if (fm_rdelete($path . '/' . $del)) {
            $msg = $is_dir ? 'Folder <b>%s</b> deleted' : 'File <b>%s</b> deleted';
            fm_set_msg(sprintf($msg, fm_enc($del)));
        } else {
            $msg = $is_dir ? 'Folder <b>%s</b> not deleted' : 'File <b>%s</b> not deleted';
            fm_set_msg(sprintf($msg, fm_enc($del)), 'error');
        }
    } else {
        fm_set_msg('Wrong file or folder name', 'error');
    }
    fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
}

// Create folder
if (isset($_GET['new']) && isset($_GET['type']) && !FM_READONLY) {
    $new = strip_tags($_GET['new']);
    $type = $_GET['type'];
    $new = fm_clean_path($new);
    $new = str_replace('/', '', $new);
    if ($new != '' && $new != '..' && $new != '.') {
        $path = FM_ROOT_PATH;
        if (FM_PATH != '') {
            $path .= '/' . FM_PATH;
        }
        if($_GET['type']=="file") {
            if(!file_exists($path . '/' . $new)) {
                @fopen($path . '/' . $new, 'w') or die('Cannot open file:  '.$new);
                fm_set_msg(sprintf('File <b>%s</b> created', fm_enc($new)));
            } else {
                fm_set_msg(sprintf('File <b>%s</b> already exists', fm_enc($new)), 'alert');
            }
        } else {
            if (fm_mkdir($path . '/' . $new, false) === true) {
                fm_set_msg(sprintf('Folder <b>%s</b> created', $new));
            } elseif (fm_mkdir($path . '/' . $new, false) === $path . '/' . $new) {
                fm_set_msg(sprintf('Folder <b>%s</b> already exists', fm_enc($new)), 'alert');
            } else {
                fm_set_msg(sprintf('Folder <b>%s</b> not created', fm_enc($new)), 'error');
            }
        }
    } else {
        fm_set_msg('Wrong folder name', 'error');
    }
    fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
}

// Copy folder / file
if (isset($_GET['copy'], $_GET['finish']) && !FM_READONLY) {
    // from
    $copy = $_GET['copy'];
    $copy = fm_clean_path($copy);
    // empty path
    if ($copy == '') {
        fm_set_msg('Source path not defined', 'error');
        fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
    }
    // abs path from
    $from = FM_ROOT_PATH . '/' . $copy;
    // abs path to
    $dest = FM_ROOT_PATH;
    if (FM_PATH != '') {
        $dest .= '/' . FM_PATH;
    }
    $dest .= '/' . basename($from);
    // move?
    $move = isset($_GET['move']);
    // copy/move
    if ($from != $dest) {
        $msg_from = trim(FM_PATH . '/' . basename($from), '/');
        if ($move) {
            $rename = fm_rename($from, $dest);
            if ($rename) {
                fm_set_msg(sprintf('Moved from <b>%s</b> to <b>%s</b>', fm_enc($copy), fm_enc($msg_from)));
            } elseif ($rename === null) {
                fm_set_msg('File or folder with this path already exists', 'alert');
            } else {
                fm_set_msg(sprintf('Error while moving from <b>%s</b> to <b>%s</b>', fm_enc($copy), fm_enc($msg_from)), 'error');
            }
        } else {
            if (fm_rcopy($from, $dest)) {
                fm_set_msg(sprintf('Copyied from <b>%s</b> to <b>%s</b>', fm_enc($copy), fm_enc($msg_from)));
            } else {
                fm_set_msg(sprintf('Error while copying from <b>%s</b> to <b>%s</b>', fm_enc($copy), fm_enc($msg_from)), 'error');
            }
        }
    } else {
        fm_set_msg('Paths must be not equal', 'alert');
    }
    fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
}

// Mass copy files/ folders
if (isset($_POST['file'], $_POST['copy_to'], $_POST['finish']) && !FM_READONLY) {
    // from
    $path = FM_ROOT_PATH;
    if (FM_PATH != '') {
        $path .= '/' . FM_PATH;
    }
    // to
    $copy_to_path = FM_ROOT_PATH;
    $copy_to = fm_clean_path($_POST['copy_to']);
    if ($copy_to != '') {
        $copy_to_path .= '/' . $copy_to;
    }
    if ($path == $copy_to_path) {
        fm_set_msg('Paths must be not equal', 'alert');
        fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
    }
    if (!is_dir($copy_to_path)) {
        if (!fm_mkdir($copy_to_path, true)) {
            fm_set_msg('Unable to create destination folder', 'error');
            fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
        }
    }
    // move?
    $move = isset($_POST['move']);
    // copy/move
    $errors = 0;
    $files = $_POST['file'];
    if (is_array($files) && count($files)) {
        foreach ($files as $f) {
            if ($f != '') {
                // abs path from
                $from = $path . '/' . $f;
                // abs path to
                $dest = $copy_to_path . '/' . $f;
                // do
                if ($move) {
                    $rename = fm_rename($from, $dest);
                    if ($rename === false) {
                        $errors++;
                    }
                } else {
                    if (!fm_rcopy($from, $dest)) {
                        $errors++;
                    }
                }
            }
        }
        if ($errors == 0) {
            $msg = $move ? 'Selected files and folders moved' : 'Selected files and folders copied';
            fm_set_msg($msg);
        } else {
            $msg = $move ? 'Error while moving items' : 'Error while copying items';
            fm_set_msg($msg, 'error');
        }
    } else {
        fm_set_msg('Nothing selected', 'alert');
    }
    fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
}

// Rename
if (isset($_GET['ren'], $_GET['to']) && !FM_READONLY) {
    // old name
    $old = $_GET['ren'];
    $old = fm_clean_path($old);
    $old = str_replace('/', '', $old);
    // new name
    $new = $_GET['to'];
    $new = fm_clean_path($new);
    $new = str_replace('/', '', $new);
    // path
    $path = FM_ROOT_PATH;
    if (FM_PATH != '') {
        $path .= '/' . FM_PATH;
    }
    // rename
    if ($old != '' && $new != '') {
        if (fm_rename($path . '/' . $old, $path . '/' . $new)) {
            fm_set_msg(sprintf('Renamed from <b>%s</b> to <b>%s</b>', fm_enc($old), fm_enc($new)));
        } else {
            fm_set_msg(sprintf('Error while renaming from <b>%s</b> to <b>%s</b>', fm_enc($old), fm_enc($new)), 'error');
        }
    } else {
        fm_set_msg('Names not set', 'error');
    }
    fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
}

// Download
if (isset($_GET['dl'])) {
    $dl = $_GET['dl'];
    $dl = fm_clean_path($dl);
    $dl = str_replace('/', '', $dl);
    $path = FM_ROOT_PATH;
    if (FM_PATH != '') {
        $path .= '/' . FM_PATH;
    }
    if ($dl != '' && is_file($path . '/' . $dl)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($path . '/' . $dl) . '"');
        header('Content-Transfer-Encoding: binary');
        header('Connection: Keep-Alive');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($path . '/' . $dl));
        readfile($path . '/' . $dl);
        exit;
    } else {
        fm_set_msg('File not found', 'error');
        fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
    }
}

// Upload
if (isset($_POST['upl']) && !FM_READONLY) {
    $path = FM_ROOT_PATH;
    if (FM_PATH != '') {
        $path .= '/' . FM_PATH;
    }

    $errors = 0;
    $uploads = 0;
    $total = count($_FILES['upload']['name']);
	  $allowed = (FM_EXTENSION) ? explode(',', FM_EXTENSION) : false;

    for ($i = 0; $i < $total; $i++) {
		$filename = $_FILES['upload']['name'][$i];
        $tmp_name = $_FILES['upload']['tmp_name'][$i];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		$isFileAllowed = ($allowed) ? in_array($ext,$allowed) : true;
        if (empty($_FILES['upload']['error'][$i]) && !empty($tmp_name) && $tmp_name != 'none' && $isFileAllowed) {
            if (move_uploaded_file($tmp_name, $path . '/' . $_FILES['upload']['name'][$i])) {
                $uploads++;
            } else {
                $errors++;
            }
        }
    }

    if ($errors == 0 && $uploads > 0) {
        fm_set_msg(sprintf('All files uploaded to <b>%s</b>', fm_enc($path)));
    } elseif ($errors == 0 && $uploads == 0) {
        fm_set_msg('Nothing uploaded', 'alert');
    } else {
        fm_set_msg(sprintf('Error while uploading files. Uploaded files: %s', $uploads), 'error');
    }
    fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
}

// Mass deleting
if (isset($_POST['group'], $_POST['delete']) && !FM_READONLY) {
    $path = FM_ROOT_PATH;
    if (FM_PATH != '') {
        $path .= '/' . FM_PATH;
    }

    $errors = 0;
    $files = $_POST['file'];
    if (is_array($files) && count($files)) {
        foreach ($files as $f) {
            if ($f != '') {
                $new_path = $path . '/' . $f;
                if (!fm_rdelete($new_path)) {
                    $errors++;
                }
            }
        }
        if ($errors == 0) {
            fm_set_msg('File và folder đã được xóa');
        } else {
            fm_set_msg('Có lỗi trong khi xóa', 'error');
        }
    } else {
        fm_set_msg('Chưa chọn gì', 'alert');
    }

    fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
}

// Pack files
if (isset($_POST['group'], $_POST['zip']) && !FM_READONLY) {
    $path = FM_ROOT_PATH;
    if (FM_PATH != '') {
        $path .= '/' . FM_PATH;
    }

    if (!class_exists('ZipArchive')) {
        fm_set_msg('Operations with archives are not available', 'error');
        fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
    }

    $files = $_POST['file'];
    if (!empty($files)) {
        chdir($path);

        if (count($files) == 1) {
            $one_file = reset($files);
            $one_file = basename($one_file);
            $zipname = $one_file . '_' . date('ymd_His') . '.zip';
        } else {
            $zipname = 'archive_' . date('ymd_His') . '.zip';
        }

        $zipper = new FM_Zipper();
        $res = $zipper->create($zipname, $files);

        if ($res) {
            fm_set_msg(sprintf('Archive <b>%s</b> created', fm_enc($zipname)));
        } else {
            fm_set_msg('Archive not created', 'error');
        }
    } else {
        fm_set_msg('Nothing selected', 'alert');
    }

    fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
}

// Unpack
if (isset($_GET['unzip']) && !FM_READONLY) {
    $unzip = $_GET['unzip'];
    $unzip = fm_clean_path($unzip);
    $unzip = str_replace('/', '', $unzip);

    $path = FM_ROOT_PATH;
    if (FM_PATH != '') {
        $path .= '/' . FM_PATH;
    }

    if (!class_exists('ZipArchive')) {
        fm_set_msg('Operations with archives are not available', 'error');
        fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
    }

    if ($unzip != '' && is_file($path . '/' . $unzip)) {
        $zip_path = $path . '/' . $unzip;

        //to folder
        $tofolder = '';
        if (isset($_GET['tofolder'])) {
            $tofolder = pathinfo($zip_path, PATHINFO_FILENAME);
            if (fm_mkdir($path . '/' . $tofolder, true)) {
                $path .= '/' . $tofolder;
            }
        }

        $zipper = new FM_Zipper();
        $res = $zipper->unzip($zip_path, $path);

        if ($res) {
            fm_set_msg('Archive unpacked');
        } else {
            fm_set_msg('Archive not unpacked', 'error');
        }

    } else {
        fm_set_msg('File not found', 'error');
    }
    fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
}

// Change Perms (not for Windows)
if (isset($_POST['chmod']) && !FM_READONLY && !FM_IS_WIN) {
    $path = FM_ROOT_PATH;
    if (FM_PATH != '') {
        $path .= '/' . FM_PATH;
    }

    $file = $_POST['chmod'];
    $file = fm_clean_path($file);
    $file = str_replace('/', '', $file);
    if ($file == '' || (!is_file($path . '/' . $file) && !is_dir($path . '/' . $file))) {
        fm_set_msg('File not found', 'error');
        fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
    }

    $mode = 0;
    if (!empty($_POST['ur'])) {
        $mode |= 0400;
    }
    if (!empty($_POST['uw'])) {
        $mode |= 0200;
    }
    if (!empty($_POST['ux'])) {
        $mode |= 0100;
    }
    if (!empty($_POST['gr'])) {
        $mode |= 0040;
    }
    if (!empty($_POST['gw'])) {
        $mode |= 0020;
    }
    if (!empty($_POST['gx'])) {
        $mode |= 0010;
    }
    if (!empty($_POST['or'])) {
        $mode |= 0004;
    }
    if (!empty($_POST['ow'])) {
        $mode |= 0002;
    }
    if (!empty($_POST['ox'])) {
        $mode |= 0001;
    }

    if (@chmod($path . '/' . $file, $mode)) {
        fm_set_msg('Permissions changed');
    } else {
        fm_set_msg('Permissions not changed', 'error');
    }

    fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
}

/*************************** /ACTIONS ***************************/

// get current path
$path = FM_ROOT_PATH;
if (FM_PATH != '') {
    $path .= '/' . FM_PATH;
}

// check path
if (!is_dir($path)) {
    fm_redirect(FM_SELF_URL . '?p=');
}

// get parent folder
$parent = fm_get_parent_path(FM_PATH);

$objects = is_readable($path) ? scandir($path) : array();
$folders = array();
$files = array();
if (is_array($objects)) {
    foreach ($objects as $file) {
        if ($file == '.' || $file == '..' && in_array($file, $GLOBALS['exclude_folders'])) {
            continue;
        }
        if (!FM_SHOW_HIDDEN && substr($file, 0, 1) === '.') {
            continue;
        }
        $new_path = $path . '/' . $file;
        if (is_file($new_path)) {
            $files[] = $file;
        } elseif (is_dir($new_path) && $file != '.' && $file != '..' && !in_array($file, $GLOBALS['exclude_folders'])) {
            $folders[] = $file;
        }
    }
}

if (!empty($files)) {
    natcasesort($files);
}
if (!empty($folders)) {
    natcasesort($folders);
}

// upload form
if (isset($_GET['upload']) && !FM_READONLY) {
    fm_show_header(); // HEADER
    fm_show_nav_path(FM_PATH); // current path
    ?>
    <div class="path">
        <p><b>Uploading files</b></p>
        <p class="break-word">Destination folder: <?php echo fm_enc(fm_convert_win(FM_ROOT_PATH . '/' . FM_PATH)) ?></p>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="p" value="<?php echo fm_enc(FM_PATH) ?>">
            <input type="hidden" name="upl" value="1">
            <input type="file" name="upload[]"><br>
            <input type="file" name="upload[]"><br>
            <input type="file" name="upload[]"><br>
            <input type="file" name="upload[]"><br>
            <input type="file" name="upload[]"><br>
            <br>
            <p>
                <button type="submit" class="btn"><i class="fa fa-check-circle"></i> Upload</button> &nbsp;
                <b><a href="?p=<?php echo urlencode(FM_PATH) ?>"><i class="fa fa-times-circle"></i> Cancel</a></b>
            </p>
        </form>
    </div>
    <?php
    fm_show_footer();
    exit;
}

// copy form POST
if (isset($_POST['copy']) && !FM_READONLY) {
    $copy_files = $_POST['file'];
    if (!is_array($copy_files) || empty($copy_files)) {
        fm_set_msg('Nothing selected', 'alert');
        fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
    }

    fm_show_header(); // HEADER
    fm_show_nav_path(FM_PATH); // current path
    ?>
    <div class="path">
        <p><b>Copying</b></p>
        <form action="" method="post">
            <input type="hidden" name="p" value="<?php echo fm_enc(FM_PATH) ?>">
            <input type="hidden" name="finish" value="1">
            <?php
            foreach ($copy_files as $cf) {
                echo '<input type="hidden" name="file[]" value="' . fm_enc($cf) . '">' . PHP_EOL;
            }
            ?>
            <p class="break-word">Files: <b><?php echo implode('</b>, <b>', $copy_files) ?></b></p>
            <p class="break-word">Source folder: <?php echo fm_enc(fm_convert_win(FM_ROOT_PATH . '/' . FM_PATH)) ?><br>
                <label for="inp_copy_to">Destination folder:</label>
                <?php echo FM_ROOT_PATH ?>/<input type="text" name="copy_to" id="inp_copy_to" value="<?php echo fm_enc(FM_PATH) ?>">
            </p>
            <p><label><input type="checkbox" name="move" value="1"> Move'</label></p>
            <p>
                <button type="submit" class="btn"><i class="fa fa-check-circle"></i> Copy </button> &nbsp;
                <b><a href="?p=<?php echo urlencode(FM_PATH) ?>"><i class="fa fa-times-circle"></i> Cancel</a></b>
            </p>
        </form>
    </div>
    <?php
    fm_show_footer();
    exit;
}

// copy form
if (isset($_GET['copy']) && !isset($_GET['finish']) && !FM_READONLY) {
    $copy = $_GET['copy'];
    $copy = fm_clean_path($copy);
    if ($copy == '' || !file_exists(FM_ROOT_PATH . '/' . $copy)) {
        fm_set_msg('File not found', 'error');
        fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
    }

    fm_show_header(); // HEADER
    fm_show_nav_path(FM_PATH); // current path
    ?>
    <div class="path">
        <p><b>Copying</b></p>
        <p class="break-word">
            Source path: <?php echo fm_enc(fm_convert_win(FM_ROOT_PATH . '/' . $copy)) ?><br>
            Destination folder: <?php echo fm_enc(fm_convert_win(FM_ROOT_PATH . '/' . FM_PATH)) ?>
        </p>
        <p>
            <b><a href="?p=<?php echo urlencode(FM_PATH) ?>&amp;copy=<?php echo urlencode($copy) ?>&amp;finish=1"><i class="fa fa-check-circle"></i> Copy</a></b> &nbsp;
            <b><a href="?p=<?php echo urlencode(FM_PATH) ?>&amp;copy=<?php echo urlencode($copy) ?>&amp;finish=1&amp;move=1"><i class="fa fa-check-circle"></i> Move</a></b> &nbsp;
            <b><a href="?p=<?php echo urlencode(FM_PATH) ?>"><i class="fa fa-times-circle"></i> Cancel</a></b>
        </p>
        <p><i>Select folder</i></p>
        <ul class="folders break-word">
            <?php
            if ($parent !== false) {
                ?>
                <li><a href="?p=<?php echo urlencode($parent) ?>&amp;copy=<?php echo urlencode($copy) ?>"><i class="fa fa-chevron-circle-left"></i> ..</a></li>
            <?php
            }
            foreach ($folders as $f) {
                ?>
                <li><a href="?p=<?php echo urlencode(trim(FM_PATH . '/' . $f, '/')) ?>&amp;copy=<?php echo urlencode($copy) ?>"><i class="fa fa-folder-o"></i> <?php echo fm_convert_win($f) ?></a></li>
            <?php
            }
            ?>
        </ul>
    </div>
    <?php
    fm_show_footer();
    exit;
}

// file viewer
if (isset($_GET['view'])) {
    $file = $_GET['view'];
    $file = fm_clean_path($file);
    $file = str_replace('/', '', $file);
    if ($file == '' || !is_file($path . '/' . $file)) {
        fm_set_msg('File not found', 'error');
        fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
    }

    fm_show_header(); // HEADER
    fm_show_nav_path(FM_PATH); // current path

    $file_url = FM_ROOT_URL . fm_convert_win((FM_PATH != '' ? '/' . FM_PATH : '') . '/' . $file);
    $file_path = $path . '/' . $file;

    $ext = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
    $mime_type = fm_get_mime_type($file_path);
    $filesize = filesize($file_path);

    $is_zip = false;
    $is_image = false;
    $is_audio = false;
    $is_video = false;
    $is_text = false;

    $view_title = 'File';
    $filenames = false; // for zip
    $content = ''; // for text

    if ($ext == 'zip') {
        $is_zip = true;
        $view_title = 'Archive';
        $filenames = fm_get_zif_info($file_path);
    } elseif (in_array($ext, fm_get_image_exts())) {
        $is_image = true;
        $view_title = 'Image';
    } elseif (in_array($ext, fm_get_audio_exts())) {
        $is_audio = true;
        $view_title = 'Audio';
    } elseif (in_array($ext, fm_get_video_exts())) {
        $is_video = true;
        $view_title = 'Video';
    } elseif (in_array($ext, fm_get_text_exts()) || substr($mime_type, 0, 4) == 'text' || in_array($mime_type, fm_get_text_mimes())) {
        $is_text = true;
        $content = file_get_contents($file_path);
    }

    ?>
    <div class="path">
        <p class="break-word"><b><?php echo $view_title ?> "<?php echo fm_enc(fm_convert_win($file)) ?>"</b></p>
        <p class="break-word">
            Full path: <?php echo fm_enc(fm_convert_win($file_path)) ?><br>
            File size: <?php echo fm_get_filesize($filesize) ?><?php if ($filesize >= 1000): ?> (<?php echo sprintf('%s bytes', $filesize) ?>)<?php endif; ?><br>
           MIME-type: <?php echo $mime_type ?><br>
            <?php
            // ZIP info
            if ($is_zip && $filenames !== false) {
                $total_files = 0;
                $total_comp = 0;
                $total_uncomp = 0;
                foreach ($filenames as $fn) {
                    if (!$fn['folder']) {
                        $total_files++;
                    }
                    $total_comp += $fn['compressed_size'];
                    $total_uncomp += $fn['filesize'];
                }
                ?>
                Files in archive: <?php echo $total_files ?><br>
                Total size: <?php echo fm_get_filesize($total_uncomp) ?><br>
                Size in archive: <?php echo fm_get_filesize($total_comp) ?><br>
                Compression: <?php echo round(($total_comp / $total_uncomp) * 100) ?>%<br>
                <?php
            }
            // Image info
            if ($is_image) {
                $image_size = getimagesize($file_path);
                echo 'Image sizes: ' . (isset($image_size[0]) ? $image_size[0] : '0') . ' x ' . (isset($image_size[1]) ? $image_size[1] : '0') . '<br>';
            }
            // Text info
            if ($is_text) {
                $is_utf8 = fm_is_utf8($content);
                if (function_exists('iconv')) {
                    if (!$is_utf8) {
                        $content = iconv(FM_ICONV_INPUT_ENC, 'UTF-8//IGNORE', $content);
                    }
                }
                echo 'Charset: ' . ($is_utf8 ? 'utf-8' : '8 bit') . '<br>';
            }
            ?>
        </p>
        <p>
            <b><a href="?p=<?php echo urlencode(FM_PATH) ?>&amp;dl=<?php echo urlencode($file) ?>"><i class="fa fa-cloud-download"></i> Download</a></b> &nbsp;
            <b><a href="<?php echo fm_enc($file_url) ?>" target="_blank"><i class="fa fa-external-link-square"></i> Open</a></b> &nbsp;
            <?php
            // ZIP actions
            if (!FM_READONLY && $is_zip && $filenames !== false) {
                $zip_name = pathinfo($file_path, PATHINFO_FILENAME);
                ?>
                <b><a href="?p=<?php echo urlencode(FM_PATH) ?>&amp;unzip=<?php echo urlencode($file) ?>"><i class="fa fa-check-circle"></i> UnZip</a></b> &nbsp;
                <b><a href="?p=<?php echo urlencode(FM_PATH) ?>&amp;unzip=<?php echo urlencode($file) ?>&amp;tofolder=1" title="UnZip to <?php echo fm_enc($zip_name) ?>"><i class="fa fa-check-circle"></i>
                    UnZip to folder</a></b> &nbsp;
                <?php
            }
            if($is_text && !FM_READONLY) {
            ?>
            <b><a href="?p=<?php echo urlencode(trim(FM_PATH)) ?>&amp;edit=<?php echo urlencode($file) ?>" class="edit-file"><i class="fa fa-pencil-square"></i> Edit</a></b> &nbsp;
            <b><a href="?p=<?php echo urlencode(trim(FM_PATH)) ?>&amp;edit=<?php echo urlencode($file) ?>&env=ace" class="edit-file"><i class="fa fa-pencil-square"></i> Advanced Edit</a></b> &nbsp;
            <?php }
            if($send_mail && !FM_READONLY) {
            ?>
            <b><a href="javascript:mailto('<?php echo urlencode(trim(FM_ROOT_PATH.'/'.FM_PATH)) ?>','<?php echo urlencode($file) ?>')"><i class="fa fa-pencil-square"></i> Mail</a></b> &nbsp;
            <?php } ?>
            <b><a href="?p=<?php echo urlencode(FM_PATH) ?>"><i class="fa fa-chevron-circle-left"></i> Back</a></b>
        </p>
        <?php
        if ($is_zip) {
            // ZIP content
            if ($filenames !== false) {
                echo '<code class="maxheight">';
                foreach ($filenames as $fn) {
                    if ($fn['folder']) {
                        echo '<b>' . fm_enc($fn['name']) . '</b><br>';
                    } else {
                        echo $fn['name'] . ' (' . fm_get_filesize($fn['filesize']) . ')<br>';
                    }
                }
                echo '</code>';
            } else {
                echo '<p>Error while fetching archive info</p>';
            }
        } elseif ($is_image) {
            // Image content
            if (in_array($ext, array('gif', 'jpg', 'jpeg', 'png', 'bmp', 'ico'))) {
                echo '<p><img src="' . fm_enc($file_url) . '" alt="" class="preview-img"></p>';
            }
        } elseif ($is_audio) {
            // Audio content
            echo '<p><audio src="' . fm_enc($file_url) . '" controls preload="metadata"></audio></p>';
        } elseif ($is_video) {
            // Video content
            echo '<div class="preview-video"><video src="' . fm_enc($file_url) . '" width="640" height="360" controls preload="metadata"></video></div>';
        } elseif ($is_text) {
            if (FM_USE_HIGHLIGHTJS) {
                // highlight
                $hljs_classes = array(
                    'shtml' => 'xml',
                    'htaccess' => 'apache',
                    'phtml' => 'php',
                    'lock' => 'json',
                    'svg' => 'xml',
                );
                $hljs_class = isset($hljs_classes[$ext]) ? 'lang-' . $hljs_classes[$ext] : 'lang-' . $ext;
                if (empty($ext) || in_array(strtolower($file), fm_get_text_names()) || preg_match('#\.min\.(css|js)$#i', $file)) {
                    $hljs_class = 'nohighlight';
                }
                $content = '<pre class="with-hljs"><code class="' . $hljs_class . '">' . fm_enc($content) . '</code></pre>';
            } elseif (in_array($ext, array('php', 'php4', 'php5', 'phtml', 'phps'))) {
                // php highlight
                $content = highlight_string($content, true);
            } else {
                $content = '<pre>' . fm_enc($content) . '</pre>';
            }
            echo $content;
        }
        ?>
    </div>
    <?php
    fm_show_footer();
    exit;
}

// file editor
if (isset($_GET['edit'])) {
    $file = $_GET['edit'];
    $file = fm_clean_path($file);
    $file = str_replace('/', '', $file);
    if ($file == '' || !is_file($path . '/' . $file)) {
        fm_set_msg('File not found', 'error');
        fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
    }

    fm_show_header(); // HEADER
    fm_show_nav_path(FM_PATH); // current path

    $file_url = FM_ROOT_URL . fm_convert_win((FM_PATH != '' ? '/' . FM_PATH : '') . '/' . $file);
    $file_path = $path . '/' . $file;

    //normal editer
    $isNormalEditor = true;
    if(isset($_GET['env'])) {
        if($_GET['env'] == "ace") {
            $isNormalEditor = false;
        }
    }

    //Save File
    if(isset($_POST['savedata'])) {
        $writedata = $_POST['savedata'];
        $fd=fopen($file_path,"w");
        @fwrite($fd, $writedata);
        fclose($fd);
        fm_set_msg('File Saved Successfully', 'alert');
    }

    $ext = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
    $mime_type = fm_get_mime_type($file_path);
    $filesize = filesize($file_path);
    $is_text = false;
    $content = ''; // for text

    if (in_array($ext, fm_get_text_exts()) || substr($mime_type, 0, 4) == 'text' || in_array($mime_type, fm_get_text_mimes())) {
        $is_text = true;
        $content = file_get_contents($file_path);
    }

    ?>
    <div class="path">
        <div class="edit-file-actions">
            <a title="Cancel" href="?p=<?php echo urlencode(trim(FM_PATH)) ?>&amp;view=<?php echo urlencode($file) ?>"><i class="fa fa-reply-all"></i> Cancel</a>
            <a title="Backup" href="javascript:backup('<?php echo urlencode($path) ?>','<?php echo urlencode($file) ?>')"><i class="fa fa-database"></i> Backup</a>
            <?php if($is_text) { ?>
                <?php if($isNormalEditor) { ?>
                    <a title="Advanced" href="?p=<?php echo urlencode(trim(FM_PATH)) ?>&amp;edit=<?php echo urlencode($file) ?>&amp;env=ace"><i class="fa fa-paper-plane"></i> Advanced Editor</a>
                    <button type="button" name="Save" data-url="<?php echo fm_enc($file_url) ?>" onclick="edit_save(this,'nrl')"><i class="fa fa-floppy-o"></i> Save</button>
                <?php } else { ?>
                    <a title="Plain Editor" href="?p=<?php echo urlencode(trim(FM_PATH)) ?>&amp;edit=<?php echo urlencode($file) ?>"><i class="fa fa-text-height"></i> Plain Editor</a>
                    <button type="button" name="Save" data-url="<?php echo fm_enc($file_url) ?>" onclick="edit_save(this,'ace')"><i class="fa fa-floppy-o"></i> Save</button>
                <?php } ?>
            <?php } ?>
        </div>
        <?php
        if ($is_text && $isNormalEditor) {
            echo '<textarea id="normal-editor" rows="33" cols="120" style="width: 99.5%;">'. htmlspecialchars($content) .'</textarea>';
        } elseif ($is_text) {
            echo '<div id="editor" contenteditable="true">'. htmlspecialchars($content) .'</div>';
        } else {
            fm_set_msg('FILE EXTENSION HAS NOT SUPPORTED', 'error');
        }
        ?>
    </div>
    <?php
    fm_show_footer();
    exit;
}

// chmod (not for Windows)
if (isset($_GET['chmod']) && !FM_READONLY && !FM_IS_WIN) {
    $file = $_GET['chmod'];
    $file = fm_clean_path($file);
    $file = str_replace('/', '', $file);
    if ($file == '' || (!is_file($path . '/' . $file) && !is_dir($path . '/' . $file))) {
        fm_set_msg('File not found', 'error');
        fm_redirect(FM_SELF_URL . '?p=' . urlencode(FM_PATH));
    }

    fm_show_header(); // HEADER
    fm_show_nav_path(FM_PATH); // current path

    $file_url = FM_ROOT_URL . (FM_PATH != '' ? '/' . FM_PATH : '') . '/' . $file;
    $file_path = $path . '/' . $file;

    $mode = fileperms($path . '/' . $file);

    ?>
    <div class="path">
        <p><b><?php echo 'Change Permissions'; ?></b></p>
        <p>
            <?php echo 'Full path:'; ?> <?php echo $file_path ?><br>
        </p>
        <form action="" method="post">
            <input type="hidden" name="p" value="<?php echo fm_enc(FM_PATH) ?>">
            <input type="hidden" name="chmod" value="<?php echo fm_enc($file) ?>">

            <table class="compact-table">
                <tr>
                    <td></td>
                    <td><b>Owner</b></td>
                    <td><b>Group</b></td>
                    <td><b>Other</b></td>
                </tr>
                <tr>
                    <td style="text-align: right"><b>Read</b></td>
                    <td><label><input type="checkbox" name="ur" value="1"<?php echo ($mode & 00400) ? ' checked' : '' ?>></label></td>
                    <td><label><input type="checkbox" name="gr" value="1"<?php echo ($mode & 00040) ? ' checked' : '' ?>></label></td>
                    <td><label><input type="checkbox" name="or" value="1"<?php echo ($mode & 00004) ? ' checked' : '' ?>></label></td>
                </tr>
                <tr>
                    <td style="text-align: right"><b>Write</b></td>
                    <td><label><input type="checkbox" name="uw" value="1"<?php echo ($mode & 00200) ? ' checked' : '' ?>></label></td>
                    <td><label><input type="checkbox" name="gw" value="1"<?php echo ($mode & 00020) ? ' checked' : '' ?>></label></td>
                    <td><label><input type="checkbox" name="ow" value="1"<?php echo ($mode & 00002) ? ' checked' : '' ?>></label></td>
                </tr>
                <tr>
                    <td style="text-align: right"><b>Execute</b></td>
                    <td><label><input type="checkbox" name="ux" value="1"<?php echo ($mode & 00100) ? ' checked' : '' ?>></label></td>
                    <td><label><input type="checkbox" name="gx" value="1"<?php echo ($mode & 00010) ? ' checked' : '' ?>></label></td>
                    <td><label><input type="checkbox" name="ox" value="1"<?php echo ($mode & 00001) ? ' checked' : '' ?>></label></td>
                </tr>
            </table>

            <p>
                <button type="submit" class="btn"><i class="fa fa-check-circle"></i> Change</button> &nbsp;
                <b><a href="?p=<?php echo urlencode(FM_PATH) ?>"><i class="fa fa-times-circle"></i> Cancel</a></b>
            </p>

        </form>

    </div>
    <?php
    fm_show_footer();
    exit;
}

//--- FILEMANAGER MAIN
fm_show_header(); // HEADER
fm_show_nav_path(FM_PATH); // current path

// messages
fm_show_message();

$num_files = count($files);
$num_folders = count($folders);
$all_files_size = 0;
?>
<form action="" method="post">
<input type="hidden" name="p" value="<?php echo fm_enc(FM_PATH) ?>">
<input type="hidden" name="group" value="1">
<?php if(FM_TREEVIEW) { ?>
<div class="file-tree-view" id="file-tree-view">
    <div class="tree-title">Browse</div>
<?php
//file tre view
    echo php_file_tree($_SERVER['DOCUMENT_ROOT'], "javascript:alert('You clicked on [link]');");
?>
</div>
<?php } ?>
<table class="table" id="main-table"><thead><tr>
<?php if (!FM_READONLY): ?><th style="width:3%"><label><input type="checkbox" title="Invert selection" onclick="checkbox_toggle()"></label></th><?php endif; ?>
<th>Tên</th><th style="width:10%">Kích cỡ</th>
<th style="width:12%">Thời gian thay đổi</th>
<?php if (!FM_IS_WIN): ?><th style="width:6%">Quyền</th><th style="width:10%">Người sở hữu</th><?php endif; ?>
<th style="width:<?php if (!FM_READONLY): ?>13<?php else: ?>6.5<?php endif; ?>%">Thao tác</th></tr></thead>
<?php
// link to parent folder
if ($parent !== false) {
    ?>
<tr><?php if (!FM_READONLY): ?><td></td><?php endif; ?><td colspan="<?php echo !FM_IS_WIN ? '6' : '4' ?>"><a href="?p=<?php echo urlencode($parent) ?>"><i class="fa fa-chevron-circle-left"></i> ..</a></td></tr>
<?php
}
foreach ($folders as $f) {
    $is_link = is_link($path . '/' . $f);
    $img = $is_link ? 'icon-link_folder' : 'fa fa-folder-o';
    $modif = date(FM_DATETIME_FORMAT, filemtime($path . '/' . $f));
    $perms = substr(decoct(fileperms($path . '/' . $f)), -4);
    if (function_exists('posix_getpwuid') && function_exists('posix_getgrgid')) {
        $owner = posix_getpwuid(fileowner($path . '/' . $f));
        $group = posix_getgrgid(filegroup($path . '/' . $f));
    } else {
        $owner = array('name' => '?');
        $group = array('name' => '?');
    }
    ?>
<tr>
<?php if (!FM_READONLY): ?><td><label><input type="checkbox" name="file[]" value="<?php echo fm_enc($f) ?>"></label></td><?php endif; ?>
<td><div class="filename"><a href="?p=<?php echo urlencode(trim(FM_PATH . '/' . $f, '/')) ?>"><i class="<?php echo $img ?>"></i> <?php echo fm_convert_win($f) ?></a><?php echo ($is_link ? ' &rarr; <i>' . readlink($path . '/' . $f) . '</i>' : '') ?></div></td>
<td>Thư mục</td><td><?php echo $modif ?></td>
<?php if (!FM_IS_WIN): ?>
<td><?php if (!FM_READONLY): ?><a title="Change Permissions" href="?p=<?php echo urlencode(FM_PATH) ?>&amp;chmod=<?php echo urlencode($f) ?>"><?php echo $perms ?></a><?php else: ?><?php echo $perms ?><?php endif; ?></td>
<td><?php echo $owner['name'] . ':' . $group['name'] ?></td>
<?php endif; ?>
<td class="inline-actions"><?php if (!FM_READONLY): ?>
<a title="Xóa" href="?p=<?php echo urlencode(FM_PATH) ?>&amp;del=<?php echo urlencode($f) ?>" onclick="return confirm('Delete folder?');"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
<a title="Đổi tên" href="#" onclick="rename('<?php echo fm_enc(FM_PATH) ?>', '<?php echo fm_enc($f) ?>');return false;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
<a title="Sao chép đến..." href="?p=&amp;copy=<?php echo urlencode(trim(FM_PATH . '/' . $f, '/')) ?>"><i class="fa fa-files-o" aria-hidden="true"></i></a>
<?php endif; ?>
<a title="Lấy link" href="<?php echo fm_enc(FM_ROOT_URL . (FM_PATH != '' ? '/' . FM_PATH : '') . '/' . $f . '/') ?>" target="_blank"><i class="fa fa-link" aria-hidden="true"></i></a>
</td></tr>
    <?php
    flush();
}

foreach ($files as $f) {
    $is_link = is_link($path . '/' . $f);
    $img = $is_link ? 'fa fa-file-text-o' : fm_get_file_icon_class($path . '/' . $f);
    $modif = date(FM_DATETIME_FORMAT, filemtime($path . '/' . $f));
    $filesize_raw = filesize($path . '/' . $f);
    $filesize = fm_get_filesize($filesize_raw);
    $filelink = '?p=' . urlencode(FM_PATH) . '&amp;view=' . urlencode($f);
    $all_files_size += $filesize_raw;
    $perms = substr(decoct(fileperms($path . '/' . $f)), -4);
    if (function_exists('posix_getpwuid') && function_exists('posix_getgrgid')) {
        $owner = posix_getpwuid(fileowner($path . '/' . $f));
        $group = posix_getgrgid(filegroup($path . '/' . $f));
    } else {
        $owner = array('name' => '?');
        $group = array('name' => '?');
    }
    ?>
<tr>
<?php if (!FM_READONLY): ?><td><label><input type="checkbox" name="file[]" value="<?php echo fm_enc($f) ?>"></label></td><?php endif; ?>
<td><div class="filename"><a href="<?php echo $filelink ?>" title="File info"><i class="<?php echo $img ?>"></i> <?php echo fm_convert_win($f) ?></a><?php echo ($is_link ? ' &rarr; <i>' . readlink($path . '/' . $f) . '</i>' : '') ?></div></td>
<td><span title="<?php printf('%s bytes', $filesize_raw) ?>"><?php echo $filesize ?></span></td>
<td><?php echo $modif ?></td>
<?php if (!FM_IS_WIN): ?>
<td><?php if (!FM_READONLY): ?><a title="<?php echo 'Change Permissions' ?>" href="?p=<?php echo urlencode(FM_PATH) ?>&amp;chmod=<?php echo urlencode($f) ?>"><?php echo $perms ?></a><?php else: ?><?php echo $perms ?><?php endif; ?></td>
<td><?php echo fm_enc($owner['name'] . ':' . $group['name']) ?></td>
<?php endif; ?>
<td class="inline-actions">
<?php if (!FM_READONLY): ?>
<a title="Delete" href="?p=<?php echo urlencode(FM_PATH) ?>&amp;del=<?php echo urlencode($f) ?>" onclick="return confirm('Delete file?');"><i class="fa fa-trash-o"></i></a>
<a title="Rename" href="#" onclick="rename('<?php echo fm_enc(FM_PATH) ?>', '<?php echo fm_enc($f) ?>');return false;"><i class="fa fa-pencil-square-o"></i></a>
<a title="Copy to..." href="?p=<?php echo urlencode(FM_PATH) ?>&amp;copy=<?php echo urlencode(trim(FM_PATH . '/' . $f, '/')) ?>"><i class="fa fa-files-o"></i></a>
<?php endif; ?>
<a title="Direct link" href="<?php echo fm_enc(FM_ROOT_URL . (FM_PATH != '' ? '/' . FM_PATH : '') . '/' . $f) ?>" target="_blank"><i class="fa fa-link"></i></a>
<a title="Download" href="?p=<?php echo urlencode(FM_PATH) ?>&amp;dl=<?php echo urlencode($f) ?>"><i class="fa fa-download"></i></a>
</td></tr>
    <?php
    flush();
}

if (empty($folders) && empty($files)) {
    ?>
<tr><?php if (!FM_READONLY): ?><td></td><?php endif; ?><td colspan="<?php echo !FM_IS_WIN ? '6' : '4' ?>"><em><?php echo 'Thư mục trống' ?></em></td></tr>
<?php
} else {
    ?>
<tr><?php if (!FM_READONLY): ?><td class="gray"></td><?php endif; ?><td class="gray" colspan="<?php echo !FM_IS_WIN ? '6' : '4' ?>">
Tổng dung lượng đã dùng: <span title="<?php printf('%s bytes', $all_files_size) ?>"><?php echo fm_get_filesize($all_files_size) ?></span>,
tệp: <?php echo $num_files ?>,
Thư mục: <?php echo $num_folders ?>
</td></tr>
<?php
}
?>
</table>
<?php if (!FM_READONLY): ?>
<p class="path footer-links"><a href="#/select-all" class="group-btn" onclick="select_all();return false;"><i class="fa fa-check-square"></i> Chọn tất cả</a> &nbsp;
<a href="#/unselect-all" class="group-btn" onclick="unselect_all();return false;"><i class="fa fa-window-close"></i> Bỏ chọn tất cả</a> &nbsp;
<a href="#/invert-all" class="group-btn" onclick="invert_all();return false;"><i class="fa fa-th-list"></i> Đảo ngược lựa chọn</a> &nbsp;
<input type="submit" class="hidden" name="delete" id="a-delete" value="Delete" onclick="return confirm('Xóa các file và folder đã chọn ?')">
<a href="javascript:document.getElementById('a-delete').click();" class="group-btn"><i class="fa fa-trash"></i> Xóa </a> &nbsp;
<input type="submit" class="hidden" name="zip" id="a-zip" value="Zip" onclick="return confirm('Create archive?')">
<a href="javascript:document.getElementById('a-zip').click();" class="group-btn"><i class="fa fa-file-archive-o"></i> Nén </a> &nbsp;
<input type="submit" class="hidden" name="copy" id="a-copy" value="Copy">
<a href="javascript:document.getElementById('a-copy').click();" class="group-btn"><i class="fa fa-files-o"></i> Sao chép </a>
<a href="/" target="_blank" class="float-right" style="color:silver">Hải Clover Manager</a></p>
<?php endif; ?>
</form>

<?php
fm_show_footer();

//--- END

// Functions

/**
 * Delete  file or folder (recursively)
 * @param string $path
 * @return bool
 */
function fm_rdelete($path)
{
    if (is_link($path)) {
        return unlink($path);
    } elseif (is_dir($path)) {
        $objects = scandir($path);
        $ok = true;
        if (is_array($objects)) {
            foreach ($objects as $file) {
                if ($file != '.' && $file != '..') {
                    if (!fm_rdelete($path . '/' . $file)) {
                        $ok = false;
                    }
                }
            }
        }
        return ($ok) ? rmdir($path) : false;
    } elseif (is_file($path)) {
        return unlink($path);
    }
    return false;
}

/**
 * Recursive chmod
 * @param string $path
 * @param int $filemode
 * @param int $dirmode
 * @return bool
 * @todo Will use in mass chmod
 */
function fm_rchmod($path, $filemode, $dirmode)
{
    if (is_dir($path)) {
        if (!chmod($path, $dirmode)) {
            return false;
        }
        $objects = scandir($path);
        if (is_array($objects)) {
            foreach ($objects as $file) {
                if ($file != '.' && $file != '..') {
                    if (!fm_rchmod($path . '/' . $file, $filemode, $dirmode)) {
                        return false;
                    }
                }
            }
        }
        return true;
    } elseif (is_link($path)) {
        return true;
    } elseif (is_file($path)) {
        return chmod($path, $filemode);
    }
    return false;
}

/**
 * Safely rename
 * @param string $old
 * @param string $new
 * @return bool|null
 */
function fm_rename($old, $new)
{
    return (!file_exists($new) && file_exists($old)) ? rename($old, $new) : null;
}

/**
 * Copy file or folder (recursively).
 * @param string $path
 * @param string $dest
 * @param bool $upd Update files
 * @param bool $force Create folder with same names instead file
 * @return bool
 */
function fm_rcopy($path, $dest, $upd = true, $force = true)
{
    if (is_dir($path)) {
        if (!fm_mkdir($dest, $force)) {
            return false;
        }
        $objects = scandir($path);
        $ok = true;
        if (is_array($objects)) {
            foreach ($objects as $file) {
                if ($file != '.' && $file != '..') {
                    if (!fm_rcopy($path . '/' . $file, $dest . '/' . $file)) {
                        $ok = false;
                    }
                }
            }
        }
        return $ok;
    } elseif (is_file($path)) {
        return fm_copy($path, $dest, $upd);
    }
    return false;
}

/**
 * Safely create folder
 * @param string $dir
 * @param bool $force
 * @return bool
 */
function fm_mkdir($dir, $force)
{
    if (file_exists($dir)) {
        if (is_dir($dir)) {
            return $dir;
        } elseif (!$force) {
            return false;
        }
        unlink($dir);
    }
    return mkdir($dir, 0777, true);
}

/**
 * Safely copy file
 * @param string $f1
 * @param string $f2
 * @param bool $upd
 * @return bool
 */
function fm_copy($f1, $f2, $upd)
{
    $time1 = filemtime($f1);
    if (file_exists($f2)) {
        $time2 = filemtime($f2);
        if ($time2 >= $time1 && $upd) {
            return false;
        }
    }
    $ok = copy($f1, $f2);
    if ($ok) {
        touch($f2, $time1);
    }
    return $ok;
}

/**
 * Get mime type
 * @param string $file_path
 * @return mixed|string
 */
function fm_get_mime_type($file_path)
{
    if (function_exists('finfo_open')) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file_path);
        finfo_close($finfo);
        return $mime;
    } elseif (function_exists('mime_content_type')) {
        return mime_content_type($file_path);
    } elseif (!stristr(ini_get('disable_functions'), 'shell_exec')) {
        $file = escapeshellarg($file_path);
        $mime = shell_exec('file -bi ' . $file);
        return $mime;
    } else {
        return '--';
    }
}

/**
 * HTTP Redirect
 * @param string $url
 * @param int $code
 */
function fm_redirect($url, $code = 302)
{
    header('Location: ' . $url, true, $code);
    exit;
}

/**
 * Clean path
 * @param string $path
 * @return string
 */
function fm_clean_path($path)
{
    $path = trim($path);
    $path = trim($path, '\\/');
    $path = str_replace(array('../', '..\\'), '', $path);
    if ($path == '..') {
        $path = '';
    }
    return str_replace('\\', '/', $path);
}

/**
 * Get parent path
 * @param string $path
 * @return bool|string
 */
function fm_get_parent_path($path)
{
    $path = fm_clean_path($path);
    if ($path != '') {
        $array = explode('/', $path);
        if (count($array) > 1) {
            $array = array_slice($array, 0, -1);
            return implode('/', $array);
        }
        return '';
    }
    return false;
}

/**
 * Get nice filesize
 * @param int $size
 * @return string
 */
function fm_get_filesize($size)
{
    if ($size < 1000) {
        return sprintf('%s B', $size);
    } elseif (($size / 1024) < 1000) {
        return sprintf('%s KiB', round(($size / 1024), 2));
    } elseif (($size / 1024 / 1024) < 1000) {
        return sprintf('%s MiB', round(($size / 1024 / 1024), 2));
    } elseif (($size / 1024 / 1024 / 1024) < 1000) {
        return sprintf('%s GiB', round(($size / 1024 / 1024 / 1024), 2));
    } else {
        return sprintf('%s TiB', round(($size / 1024 / 1024 / 1024 / 1024), 2));
    }
}

/**
 * Get info about zip archive
 * @param string $path
 * @return array|bool
 */
function fm_get_zif_info($path)
{
    if (function_exists('zip_open')) {
        $arch = zip_open($path);
        if ($arch) {
            $filenames = array();
            while ($zip_entry = zip_read($arch)) {
                $zip_name = zip_entry_name($zip_entry);
                $zip_folder = substr($zip_name, -1) == '/';
                $filenames[] = array(
                    'name' => $zip_name,
                    'filesize' => zip_entry_filesize($zip_entry),
                    'compressed_size' => zip_entry_compressedsize($zip_entry),
                    'folder' => $zip_folder
                    //'compression_method' => zip_entry_compressionmethod($zip_entry),
                );
            }
            zip_close($arch);
            return $filenames;
        }
    }
    return false;
}

/**
 * Encode html entities
 * @param string $text
 * @return string
 */
function fm_enc($text)
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

/**
 * This function scans the files folder recursively, and builds a large array
 * @param string $dir
 * @return json
 */
function scan($dir){
    $files = array();
    $_dir = $dir;
    $dir = FM_ROOT_PATH.'/'.$dir;
    // Is there actually such a folder/file?
    if(file_exists($dir)){
        foreach(scandir($dir) as $f) {
            if(!$f || $f[0] == '.') {
                continue; // Ignore hidden files
            }

            if(is_dir($dir . '/' . $f)) {
                // The path is a folder
                $files[] = array(
                    "name" => $f,
                    "type" => "folder",
                    "path" => $_dir.'/'.$f,
                    "items" => scan($dir . '/' . $f), // Recursively get the contents of the folder
                );
            } else {
                // It is a file
                $files[] = array(
                    "name" => $f,
                    "type" => "file",
                    "path" => $_dir,
                    "size" => filesize($dir . '/' . $f) // Gets the size of this file
                );
            }
        }
    }
    return $files;
}

/**
* Scan directory and return tree view
* @param string $directory
* @param boolean $first_call
*/
function php_file_tree_dir($directory, $first_call = true) {
	// Recursive function called by php_file_tree() to list directories/files

	$php_file_tree = "";
	// Get and sort directories/files
	if( function_exists("scandir") ) $file = scandir($directory);
	natcasesort($file);
	// Make directories first
	$files = $dirs = array();
	foreach($file as $this_file) {
		if( is_dir("$directory/$this_file" ) ) {
      if(!in_array($this_file, $GLOBALS['exclude_folders'])){
          $dirs[] = $this_file;
      }
    } else {
      $files[] = $this_file;
    }
	}
	$file = array_merge($dirs, $files);

	if( count($file) > 2 ) { // Use 2 instead of 0 to account for . and .. "directories"
		$php_file_tree = "<ul";
		if( $first_call ) { $php_file_tree .= " class=\"php-file-tree\""; $first_call = false; }
		$php_file_tree .= ">";
		foreach( $file as $this_file ) {
			if( $this_file != "." && $this_file != ".." ) {
				if( is_dir("$directory/$this_file") ) {
					// Directory
					$php_file_tree .= "<li class=\"pft-directory\"><i class=\"fa fa-folder-o\"></i><a href=\"#\">" . htmlspecialchars($this_file) . "</a>";
					$php_file_tree .= php_file_tree_dir("$directory/$this_file", false);
					$php_file_tree .= "</li>";
				} else {
					// File
                    $ext = fm_get_file_icon_class($this_file);
                    $path = str_replace($_SERVER['DOCUMENT_ROOT'],"",$directory);
					$link = "?p="."$path" ."&view=".urlencode($this_file);
					$php_file_tree .= "<li class=\"pft-file\"><a href=\"$link\"> <i class=\"$ext\"></i>" . htmlspecialchars($this_file) . "</a></li>";
				}
			}
		}
		$php_file_tree .= "</ul>";
	}
	return $php_file_tree;
}

/**
 * Scan directory and render tree view
 * @param string $directory
 */
function php_file_tree($directory) {
    // Remove trailing slash
    $code = "";
    if( substr($directory, -1) == "/" ) $directory = substr($directory, 0, strlen($directory) - 1);
    if(function_exists('php_file_tree_dir')) {
        $code .= php_file_tree_dir($directory);
        return $code;
    }
}

/**
 * Save message in session
 * @param string $msg
 * @param string $status
 */
function fm_set_msg($msg, $status = 'ok')
{
    $_SESSION['message'] = $msg;
    $_SESSION['status'] = $status;
}

/**
 * Check if string is in UTF-8
 * @param string $string
 * @return int
 */
function fm_is_utf8($string)
{
    return preg_match('//u', $string);
}

/**
 * Convert file name to UTF-8 in Windows
 * @param string $filename
 * @return string
 */
function fm_convert_win($filename)
{
    if (FM_IS_WIN && function_exists('iconv')) {
        $filename = iconv(FM_ICONV_INPUT_ENC, 'UTF-8//IGNORE', $filename);
    }
    return $filename;
}

/**
 * Get CSS classname for file
 * @param string $path
 * @return string
 */
function fm_get_file_icon_class($path)
{
    // get extension
    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));

    switch ($ext) {
        case 'ico': case 'gif': case 'jpg': case 'jpeg': case 'jpc': case 'jp2':
        case 'jpx': case 'xbm': case 'wbmp': case 'png': case 'bmp': case 'tif':
        case 'tiff': case 'svg':
            $img = 'fa fa-picture-o';
            break;
        case 'passwd': case 'ftpquota': case 'sql': case 'js': case 'json': case 'sh':
        case 'config': case 'twig': case 'tpl': case 'md': case 'gitignore':
        case 'c': case 'cpp': case 'cs': case 'py': case 'map': case 'lock': case 'dtd':
            $img = 'fa fa-file-code-o';
            break;
        case 'txt': case 'ini': case 'conf': case 'log': case 'htaccess':
            $img = 'fa fa-file-text-o';
            break;
        case 'css': case 'less': case 'sass': case 'scss':
            $img = 'fa fa-css3';
            break;
        case 'zip': case 'rar': case 'gz': case 'tar': case '7z':
            $img = 'fa fa-file-archive-o';
            break;
        case 'php': case 'php4': case 'php5': case 'phps': case 'phtml':
            $img = 'fa fa-code';
            break;
        case 'htm': case 'html': case 'shtml': case 'xhtml':
            $img = 'fa fa-html5';
            break;
        case 'xml': case 'xsl':
            $img = 'fa fa-file-excel-o';
            break;
        case 'wav': case 'mp3': case 'mp2': case 'm4a': case 'aac': case 'ogg':
        case 'oga': case 'wma': case 'mka': case 'flac': case 'ac3': case 'tds':
            $img = 'fa fa-music';
            break;
        case 'm3u': case 'm3u8': case 'pls': case 'cue':
            $img = 'fa fa-headphones';
            break;
        case 'avi': case 'mpg': case 'mpeg': case 'mp4': case 'm4v': case 'flv':
        case 'f4v': case 'ogm': case 'ogv': case 'mov': case 'mkv': case '3gp':
        case 'asf': case 'wmv':
            $img = 'fa fa-file-video-o';
            break;
        case 'eml': case 'msg':
            $img = 'fa fa-envelope-o';
            break;
        case 'xls': case 'xlsx':
            $img = 'fa fa-file-excel-o';
            break;
        case 'csv':
            $img = 'fa fa-file-text-o';
            break;
        case 'bak':
            $img = 'fa fa-clipboard';
            break;
        case 'doc': case 'docx':
            $img = 'fa fa-file-word-o';
            break;
        case 'ppt': case 'pptx':
            $img = 'fa fa-file-powerpoint-o';
            break;
        case 'ttf': case 'ttc': case 'otf': case 'woff':case 'woff2': case 'eot': case 'fon':
            $img = 'fa fa-font';
            break;
        case 'pdf':
            $img = 'fa fa-file-pdf-o';
            break;
        case 'psd': case 'ai': case 'eps': case 'fla': case 'swf':
            $img = 'fa fa-file-image-o';
            break;
        case 'exe': case 'msi':
            $img = 'fa fa-file-o';
            break;
        case 'bat':
            $img = 'fa fa-terminal';
            break;
        default:
            $img = 'fa fa-info-circle';
    }

    return $img;
}

/**
 * Get image files extensions
 * @return array
 */
function fm_get_image_exts()
{
    return array('ico', 'gif', 'jpg', 'jpeg', 'jpc', 'jp2', 'jpx', 'xbm', 'wbmp', 'png', 'bmp', 'tif', 'tiff', 'psd');
}

/**
 * Get video files extensions
 * @return array
 */
function fm_get_video_exts()
{
    return array('webm', 'mp4', 'm4v', 'ogm', 'ogv', 'mov');
}

/**
 * Get audio files extensions
 * @return array
 */
function fm_get_audio_exts()
{
    return array('wav', 'mp3', 'ogg', 'm4a');
}

/**
 * Get text file extensions
 * @return array
 */
function fm_get_text_exts()
{
    return array(
        'txt', 'css', 'ini', 'conf', 'log', 'htaccess', 'passwd', 'ftpquota', 'sql', 'js', 'json', 'sh', 'config',
        'php', 'php4', 'php5', 'phps', 'phtml', 'htm', 'html', 'shtml', 'xhtml', 'xml', 'xsl', 'm3u', 'm3u8', 'pls', 'cue',
        'eml', 'msg', 'csv', 'bat', 'twig', 'tpl', 'md', 'gitignore', 'less', 'sass', 'scss', 'c', 'cpp', 'cs', 'py',
        'map', 'lock', 'dtd', 'svg',
    );
}

/**
 * Get mime types of text files
 * @return array
 */
function fm_get_text_mimes()
{
    return array(
        'application/xml',
        'application/javascript',
        'application/x-javascript',
        'image/svg+xml',
        'message/rfc822',
    );
}

/**
 * Get file names of text files w/o extensions
 * @return array
 */
function fm_get_text_names()
{
    return array(
        'license',
        'readme',
        'authors',
        'contributors',
        'changelog',
    );
}

/**
 * Class to work with zip files (using ZipArchive)
 */
class FM_Zipper
{
    private $zip;

    public function __construct()
    {
        $this->zip = new ZipArchive();
    }

    /**
     * Create archive with name $filename and files $files (RELATIVE PATHS!)
     * @param string $filename
     * @param array|string $files
     * @return bool
     */
    public function create($filename, $files)
    {
        $res = $this->zip->open($filename, ZipArchive::CREATE);
        if ($res !== true) {
            return false;
        }
        if (is_array($files)) {
            foreach ($files as $f) {
                if (!$this->addFileOrDir($f)) {
                    $this->zip->close();
                    return false;
                }
            }
            $this->zip->close();
            return true;
        } else {
            if ($this->addFileOrDir($files)) {
                $this->zip->close();
                return true;
            }
            return false;
        }
    }

    /**
     * Extract archive $filename to folder $path (RELATIVE OR ABSOLUTE PATHS)
     * @param string $filename
     * @param string $path
     * @return bool
     */
    public function unzip($filename, $path)
    {
        $res = $this->zip->open($filename);
        if ($res !== true) {
            return false;
        }
        if ($this->zip->extractTo($path)) {
            $this->zip->close();
            return true;
        }
        return false;
    }

    /**
     * Add file/folder to archive
     * @param string $filename
     * @return bool
     */
    private function addFileOrDir($filename)
    {
        if (is_file($filename)) {
            return $this->zip->addFile($filename);
        } elseif (is_dir($filename)) {
            return $this->addDir($filename);
        }
        return false;
    }

    /**
     * Add folder recursively
     * @param string $path
     * @return bool
     */
    private function addDir($path)
    {
        if (!$this->zip->addEmptyDir($path)) {
            return false;
        }
        $objects = scandir($path);
        if (is_array($objects)) {
            foreach ($objects as $file) {
                if ($file != '.' && $file != '..') {
                    if (is_dir($path . '/' . $file)) {
                        if (!$this->addDir($path . '/' . $file)) {
                            return false;
                        }
                    } elseif (is_file($path . '/' . $file)) {
                        if (!$this->zip->addFile($path . '/' . $file)) {
                            return false;
                        }
                    }
                }
            }
            return true;
        }
        return false;
    }
}

//--- templates functions

/**
 * Show nav block
 * @param string $path
 */
function fm_show_nav_path($path)
{
    global $lang;
    ?>
<div class="path main-nav">

        <?php
        $path = fm_clean_path($path);
        $root_url = "<a href='?p='><i class='fa fa-home' aria-hidden='true' title='" . FM_ROOT_PATH . "'></i></a>";
        $sep = '<i class="fa fa-caret-right"></i>';
        if ($path != '') {
            $exploded = explode('/', $path);
            $count = count($exploded);
            $array = array();
            $parent = '';
            for ($i = 0; $i < $count; $i++) {
                $parent = trim($parent . '/' . $exploded[$i], '/');
                $parent_enc = urlencode($parent);
                $array[] = "<a href='?p={$parent_enc}'>" . fm_enc(fm_convert_win($exploded[$i])) . "</a>";
            }
            $root_url .= $sep . implode($sep, $array);
        }
        echo '<div class="break-word float-left">' . $root_url . '</div>';
        ?>

        <div class="float-right">
        <?php if (!FM_READONLY): ?>
        <a title="Search" href="javascript:showSearch('<?php echo urlencode(FM_PATH) ?>')"><i class="fa fa-search"></i></a>
        <a title="Upload files" href="?p=<?php echo urlencode(FM_PATH) ?>&amp;upload"><i class="fa fa-cloud-upload" aria-hidden="true"></i></a>
        <a title="New folder" href="#createNewItem" ><i class="fa fa-plus-square"></i></a>
        <?php endif; ?>
        <?php if (FM_USE_AUTH): ?><a title="Logout" href="?logout=1"><i class="fa fa-sign-out" aria-hidden="true"></i></a><?php endif; ?>
        </div>
</div>
<?php
}

/**
 * Show message from session
 */
function fm_show_message()
{
    if (isset($_SESSION['message'])) {
        $class = isset($_SESSION['status']) ? $_SESSION['status'] : 'ok';
        echo '<p class="message ' . $class . '">' . $_SESSION['message'] . '</p>';
        unset($_SESSION['message']);
        unset($_SESSION['status']);
    }
}

/**
 * Show page header in Login Form
 */
function fm_show_header_login()
{
    $sprites_ver = '20160315';
    header("Content-Type: text/html; charset=utf-8");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
    header("Pragma: no-cache");

    global $lang;
    ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Hải Clover Manager</title>
<meta name="Description" CONTENT="Author: CCP Programmers, H3K Tiny PHP File Manager">
<link rel="icon" href="<?php echo FM_SELF_URL ?>?img=favicon" type="image/png">
<link rel="shortcut icon" href="<?php echo FM_SELF_URL ?>?img=favicon" type="image/png">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
<style>
a img,img{border:none}.filename,td,th{white-space:nowrap}.close,.close:focus,.close:hover,.php-file-tree a,a{text-decoration:none}a,body,code,div,em,form,html,img,label,li,ol,p,pre,small,span,strong,table,td,th,tr,ul{margin:0;padding:0;vertical-align:baseline;outline:0;font-size:100%;background:0 0;border:none;text-decoration:none}p,table,ul{margin-bottom:10px}html{overflow-y:scroll}body{padding:0;font:13px/16px Tahoma,Arial,sans-serif;color:#222;background:#fff;margin:50px 30px 0}button,input,select,textarea{font-size:inherit;font-family:inherit}a{color:#296ea3}a:hover{color:#b00}img{vertical-align:middle;width: 142px;}span{color:#777}small{font-size:11px;color:#999}ul{list-style-type:none;margin-left:0}ul li{padding:3px 0}table{border-collapse:collapse;border-spacing:0;width:100%}.file-tree-view+#main-table{width:75%!important;float:left}td,th{padding:4px 7px;text-align:left;vertical-align:top;border:1px solid #ddd;background:#fff}td.gray,th{background-color:#eee}td.gray span{color:#222}tr:hover td{background-color:#f5f5f5}tr:hover td.gray{background-color:#eee}.table{width:100%;max-width:100%;margin-bottom:1rem}.table td,.table th{padding:.55rem;vertical-align:top;border-top:1px solid #ddd}.table thead th{vertical-align:bottom;border-bottom:2px solid #eceeef}.table tbody+tbody{border-top:2px solid #eceeef}.table .table{background-color:#fff}code,pre{display:block;margin-bottom:10px;font:13px/16px Consolas,'Courier New',Courier,monospace;border:1px dashed #ccc;padding:5px;overflow:auto}.hidden,.modal{display:none}.btn,.close{font-weight:700}pre.with-hljs{padding:0}pre.with-hljs code{margin:0;border:0;overflow:visible}code.maxheight,pre.maxheight{max-height:512px}input[type=checkbox]{margin:0;padding:0}.message,.path{padding:4px 7px;border:1px solid #ddd;background-color:#fff}.fa.fa-caret-right{font-size:1.2em;margin:0 4px;vertical-align:middle;color:#ececec}.fa.fa-home{font-size:1.2em;vertical-align:bottom}#wrapper{min-width:400px;margin:0 auto}.path{margin-bottom:10px}.right{text-align:right}.center,.close,.login-form{text-align:center}.float-right{float:right}.float-left{float:left}.message.ok{border-color:green;color:green}.message.error{border-color:red;color:red}.message.alert{border-color:orange;color:orange}.preview-img{max-width:100%;background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAIAAACQkWg2AAAAKklEQVR42mL5//8/Azbw+PFjrOJMDCSCUQ3EABZc4S0rKzsaSvTTABBgAMyfCMsY4B9iAAAAAElFTkSuQmCC)}.inline-actions>a>i{font-size:1em;margin-left:5px;background:#3785c1;color:#fff;padding:3px;border-radius:3px}.preview-video{position:relative;max-width:100%;height:0;padding-bottom:62.5%;margin-bottom:10px}.preview-video video{position:absolute;width:100%;height:100%;left:0;top:0;background:#000}.compact-table{border:0;width:auto}.compact-table td,.compact-table th{width:100px;border:0;text-align:center}.compact-table tr:hover td{background-color:#fff}.filename{max-width:420px;overflow:hidden;text-overflow:ellipsis}.break-word{word-wrap:break-word;margin-left:30px}.break-word.float-left a{color:#7d7d7d}.break-word+.float-right{padding-right:30px;position:relative}.break-word+.float-right>a{color:#7d7d7d;font-size:1.2em;margin-right:4px}.modal{position:fixed;z-index:1;padding-top:100px;left:0;top:0;width:100%;height:100%;overflow:auto;background-color:#000;background-color:rgba(0,0,0,.4)}#editor,.edit-file-actions{position:absolute;right:30px}.modal-content{background-color:#fefefe;margin:auto;padding:20px;border:1px solid #888;width:80%}.close:focus,.close:hover{color:#000;cursor:pointer}#editor{top:50px;bottom:5px;left:30px}.edit-file-actions{top:0;background:#fff;margin-top:5px}.edit-file-actions>a,.edit-file-actions>button{background:#fff;padding:5px 15px;cursor:pointer;color:#296ea3;border:1px solid #296ea3}.group-btn{background:#fff;padding:2px 6px;border:1px solid;cursor:pointer;color:#296ea3}.main-nav{position:fixed;top:0;left:0;padding:10px 30px 10px 1px;width:100%;background:#fff;color:#000;border:0;box-shadow:0 4px 5px 0 rgba(0,0,0,.14),0 1px 10px 0 rgba(0,0,0,.12),0 2px 4px -1px rgba(0,0,0,.2)}.login-form{width:320px;margin:0 auto;box-shadow:0 8px 10px 1px rgba(0,0,0,.14),0 3px 14px 2px rgba(0,0,0,.12),0 5px 5px -3px rgba(0,0,0,.2)}.login-form label,.path.login-form input{padding:8px;margin:10px}.footer-links{background:0 0;border:0;clear:both}select[name=lang]{border:none;position:relative;text-transform:uppercase;left:-30%;top:12px;color:silver}input[type=search]{height:30px;margin:5px;width:80%;border:1px solid #ccc}.path.login-form input[type=submit]{background-color:#4285f4;color:#fff;border:1px solid;border-radius:2px;font-weight:700;cursor:pointer}.modalDialog{position:fixed;font-family:Arial,Helvetica,sans-serif;top:0;right:0;bottom:0;left:0;background:rgba(0,0,0,.8);z-index:99999;opacity:0;-webkit-transition:opacity .4s ease-in;-moz-transition:opacity .4s ease-in;transition:opacity .4s ease-in;pointer-events:none}.modalDialog:target{opacity:1;pointer-events:auto}.modalDialog>.model-wrapper{max-width:400px;position:relative;margin:10% auto;padding:15px;border-radius:2px;background:#fff}.close{float:right;background:#fff;color:#000;line-height:25px;position:absolute;right:0;top:0;width:24px;border-radius:0 5px 0 0;font-size:18px}.close:hover{background:#e4e4e4}.modalDialog p{line-height:30px}div#searchresultWrapper{max-height:320px;overflow:auto}div#searchresultWrapper li{margin:8px 0;list-style:none}li.file:before,li.folder:before{font:normal normal normal 14px/1 FontAwesome;content:"\f016";margin-right:5px}li.folder:before{content:"\f114"}i.fa.fa-folder-o{color:#eeaf4b}i.fa.fa-picture-o{color:#26b99a}i.fa.fa-file-archive-o{color:#da7d7d}.footer-links i.fa.fa-file-archive-o{color:#296ea3}i.fa.fa-css3{color:#f36fa0}i.fa.fa-file-code-o{color:#ec6630}i.fa.fa-code{color:#cc4b4c}i.fa.fa-file-text-o{color:#0096e6}i.fa.fa-html5{color:#d75e72}i.fa.fa-file-excel-o{color:#09c55d}i.fa.fa-file-powerpoint-o{color:#f6712e}.file-tree-view{width:24%;float:left;overflow:auto;border:1px solid #ddd;border-right:0;background:#fff}.file-tree-view .tree-title{background:#eee;padding:9px 2px 9px 10px;font-weight:700}.file-tree-view ul{margin-left:15px;margin-bottom:0}.file-tree-view i{padding-right:3px}.php-file-tree{font-size:100%;letter-spacing:1px;line-height:1.5;margin-left:5px!important}.php-file-tree a{color:#296ea3}.php-file-tree A:hover{color:#b00}.php-file-tree .open{font-style:italic;color:#2183ce}.php-file-tree .closed{font-style:normal}#file-tree-view::-webkit-scrollbar{width:10px;background-color:#F5F5F5}#file-tree-view::-webkit-scrollbar-track{border-radius:10px;background:rgba(0,0,0,.1);border:1px solid #ccc}#file-tree-view::-webkit-scrollbar-thumb{border-radius:10px;background:linear-gradient(left,#fff,#e4e4e4);border:1px solid #aaa}#file-tree-view::-webkit-scrollbar-thumb:hover{background:#fff}#file-tree-view::-webkit-scrollbar-thumb:active{background:linear-gradient(left,#22ADD4,#1E98BA)}
</style>
</head>
<body>
<div id="wrapper">

<?php
}

/**
 * Show page footer in Login Form
 */
function fm_show_footer_login()
{
    ?>
</div>
</body>
</html>
<?php
}

/**
 * Show page header
 */
function fm_show_header()
{
    $sprites_ver = '20160315';
    header("Content-Type: text/html; charset=utf-8");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
    header("Pragma: no-cache");

    global $lang;
    ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>H3K | File Manager</title>
<meta name="Description" CONTENT="Author: CCP Programmers, H3K Tiny PHP File Manager">
<link rel="icon" href="<?php echo FM_SELF_URL ?>?img=favicon" type="image/png">
<link rel="shortcut icon" href="<?php echo FM_SELF_URL ?>?img=favicon" type="image/png">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
<?php if (isset($_GET['view']) && FM_USE_HIGHLIGHTJS): ?>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.2.0/styles/<?php echo FM_HIGHLIGHTJS_STYLE ?>.min.css">
<?php endif; ?>
<style>
a img,img{border:none}.filename,td,th{white-space:nowrap}.close,.close:focus,.close:hover,.php-file-tree a,a{text-decoration:none}a,body,code,div,em,form,html,img,label,li,ol,p,pre,small,span,strong,table,td,th,tr,ul{margin:0;padding:0;vertical-align:baseline;outline:0;font-size:100%;background:0 0;border:none;text-decoration:none}p,table,ul{margin-bottom:10px}html{overflow-y:scroll}body{padding:0;font:13px/16px Tahoma,Arial,sans-serif;color:#222;background:#F7F7F7;margin:50px 30px 0}button,input,select,textarea{font-size:inherit;font-family:inherit}a{color:#296ea3}a:hover{color:#b00}img{vertical-align:middle}span{color:#777}small{font-size:11px;color:#999}ul{list-style-type:none;margin-left:0}ul li{padding:3px 0}table{border-collapse:collapse;border-spacing:0;width:100%}.file-tree-view+#main-table{width:75%!important;float:left}td,th{padding:4px 7px;text-align:left;vertical-align:top;border:1px solid #ddd;background:#fff}td.gray,th{background-color:#eee}td.gray span{color:#222}tr:hover td{background-color:#f5f5f5}tr:hover td.gray{background-color:#eee}.table{width:100%;max-width:100%;margin-bottom:1rem}.table td,.table th{padding:.55rem;vertical-align:top;border-top:1px solid #ddd}.table thead th{vertical-align:bottom;border-bottom:2px solid #eceeef}.table tbody+tbody{border-top:2px solid #eceeef}.table .table{background-color:#fff}code,pre{display:block;margin-bottom:10px;font:13px/16px Consolas,'Courier New',Courier,monospace;border:1px dashed #ccc;padding:5px;overflow:auto}.hidden,.modal{display:none}.with-hljs{padding:0}pre.with-hljs code{margin:0;border:0;overflow:visible}code.maxheight,pre.maxheight{max-height:512px}input[type=checkbox]{margin:0;padding:0}.message,.path{padding:4px 7px;border:1px solid #ddd;background-color:#fff}.fa.fa-caret-right{font-size:1.2em;margin:0 4px;vertical-align:middle;color:#ececec}.fa.fa-home{font-size:1.2em;vertical-align:bottom}#wrapper{min-width:400px;margin:0 auto}.path{margin-bottom:10px}.right{text-align:right}.center,.close,.login-form{text-align:center}.float-right{float:right}.float-left{float:left}.message.ok{border-color:green;color:green}.message.error{border-color:red;color:red}.message.alert{border-color:orange;color:orange}.btn{border:0;background:0 0;padding:0;margin:0;color:#296ea3;cursor:pointer}.btn:hover{color:#b00}.preview-img{max-width:100%;background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAIAAACQkWg2AAAAKklEQVR42mL5//8/Azbw+PFjrOJMDCSCUQ3EABZc4S0rKzsaSvTTABBgAMyfCMsY4B9iAAAAAElFTkSuQmCC)}.inline-actions>a>i{font-size:1em;margin-left:5px;background:#3785c1;color:#fff;padding:3px;border-radius:3px}.preview-video{position:relative;max-width:100%;height:0;padding-bottom:62.5%;margin-bottom:10px}.preview-video video{position:absolute;width:100%;height:100%;left:0;top:0;background:#000}.compact-table{border:0;width:auto}.compact-table td,.compact-table th{width:100px;border:0;text-align:center}.compact-table tr:hover td{background-color:#fff}.filename{max-width:420px;overflow:hidden;text-overflow:ellipsis}.break-word{word-wrap:break-word;margin-left:30px}.break-word.float-left a{color:#7d7d7d}.break-word+.float-right{padding-right:30px;position:relative}.break-word+.float-right>a{color:#7d7d7d;font-size:1.2em;margin-right:4px}.modal{position:fixed;z-index:1;padding-top:100px;left:0;top:0;width:100%;height:100%;overflow:auto;background-color:#000;background-color:rgba(0,0,0,.4)}#editor,.edit-file-actions{position:absolute;right:30px}.modal-content{background-color:#fefefe;margin:auto;padding:20px;border:1px solid #888;width:80%}.close:focus,.close:hover{color:#000;cursor:pointer}#editor{top:50px;bottom:5px;left:30px}.edit-file-actions{top:0;background:#fff;margin-top:5px}.edit-file-actions>a,.edit-file-actions>button{background:#fff;padding:5px 15px;cursor:pointer;color:#296ea3;border:1px solid #296ea3}.group-btn{background:#fff;padding:2px 6px;border:1px solid;cursor:pointer;color:#296ea3}.main-nav{position:fixed;top:0;left:0;padding:10px 30px 10px 1px;width:100%;background:#fff;color:#000;border:0;box-shadow:0 4px 5px 0 rgba(0,0,0,.14),0 1px 10px 0 rgba(0,0,0,.12),0 2px 4px -1px rgba(0,0,0,.2)}.login-form{width:320px;margin:0 auto;box-shadow:0 8px 10px 1px rgba(0,0,0,.14),0 3px 14px 2px rgba(0,0,0,.12),0 5px 5px -3px rgba(0,0,0,.2)}.login-form label,.path.login-form input{padding:8px;margin:10px}.footer-links{background:0 0;border:0;clear:both}select[name=lang]{border:none;position:relative;text-transform:uppercase;left:-30%;top:12px;color:silver}input[type=search]{height:30px;margin:5px;width:80%;border:1px solid #ccc}.path.login-form input[type=submit]{background-color:#4285f4;color:#fff;border:1px solid;border-radius:2px;font-weight:700;cursor:pointer}.modalDialog{position:fixed;font-family:Arial,Helvetica,sans-serif;top:0;right:0;bottom:0;left:0;background:rgba(0,0,0,.8);z-index:99999;opacity:0;-webkit-transition:opacity .4s ease-in;-moz-transition:opacity .4s ease-in;transition:opacity .4s ease-in;pointer-events:none}.modalDialog:target{opacity:1;pointer-events:auto}.modalDialog>.model-wrapper{max-width:400px;position:relative;margin:10% auto;padding:15px;border-radius:2px;background:#fff}.close{float:right;background:#fff;color:#000;line-height:25px;position:absolute;right:0;top:0;width:24px;border-radius:0 5px 0 0;font-size:18px}.close:hover{background:#e4e4e4}.modalDialog p{line-height:30px}div#searchresultWrapper{max-height:320px;overflow:auto}div#searchresultWrapper li{margin:8px 0;list-style:none}li.file:before,li.folder:before{font:normal normal normal 14px/1 FontAwesome;content:"\f016";margin-right:5px}li.folder:before{content:"\f114"}i.fa.fa-folder-o{color:#eeaf4b}i.fa.fa-picture-o{color:#26b99a}i.fa.fa-file-archive-o{color:#da7d7d}.footer-links i.fa.fa-file-archive-o{color:#296ea3}i.fa.fa-css3{color:#f36fa0}i.fa.fa-file-code-o{color:#ec6630}i.fa.fa-code{color:#cc4b4c}i.fa.fa-file-text-o{color:#0096e6}i.fa.fa-html5{color:#d75e72}i.fa.fa-file-excel-o{color:#09c55d}i.fa.fa-file-powerpoint-o{color:#f6712e}.file-tree-view{width:24%;float:left;overflow:auto;border:1px solid #ddd;border-right:0;background:#fff}.file-tree-view .tree-title{background:#eee;padding:9px 2px 9px 10px;font-weight:700}.file-tree-view ul{margin-left:15px;margin-bottom:0}.file-tree-view i{padding-right:3px}.php-file-tree{font-size:100%;letter-spacing:1px;line-height:1.5;margin-left:5px!important}.php-file-tree a{color:#296ea3}.php-file-tree A:hover{color:#b00}.php-file-tree .open{font-style:italic;color:#2183ce}.php-file-tree .closed{font-style:normal}#file-tree-view::-webkit-scrollbar{width:10px;background-color:#F5F5F5}#file-tree-view::-webkit-scrollbar-track{border-radius:10px;background:rgba(0,0,0,.1);border:1px solid #ccc}#file-tree-view::-webkit-scrollbar-thumb{border-radius:10px;background:linear-gradient(left,#fff,#e4e4e4);border:1px solid #aaa}#file-tree-view::-webkit-scrollbar-thumb:hover{background:#fff}#file-tree-view::-webkit-scrollbar-thumb:active{background:linear-gradient(left,#22ADD4,#1E98BA)}
</style>
</head>
<body>
<div id="wrapper">
  <div id="createNewItem" class="modalDialog"><div class="model-wrapper"><a href="#close" title="Close" class="close">X</a><h2>Create New Item</h2><p>
        <label for="newfile">Item Type &nbsp; : </label><input type="radio" name="newfile" id="newfile" value="file">File <input type="radio" name="newfile" value="folder" checked> Folder<br><label for="newfilename">Item Name : </label><input type="text" name="newfilename" id="newfilename" value=""><br>
        <input type="submit" name="submit" class="group-btn" value="Create Now" onclick="newfolder('<?php echo fm_enc(FM_PATH) ?>');return false;"></p></div></div>
    <div id="searchResult" class="modalDialog"><div class="model-wrapper"><a href="#close" title="Close" class="close">X</a>
    <input type="search" name="search" value="" placeholder="Find a item in current folder...">
    <h2>Search Results</h2>
    <div id="searchresultWrapper"></div>
    </div></div>
<?php
}

/**
 * Show page footer
 */
function fm_show_footer()
{
    ?>
</div>
<script>
function newfolder(e){var t=document.getElementById("newfilename").value,n=document.querySelector('input[name="newfile"]:checked').value;null!==t&&""!==t&&n&&(window.location.hash="#",window.location.search="p="+encodeURIComponent(e)+"&new="+encodeURIComponent(t)+"&type="+encodeURIComponent(n))}function rename(e,t){var n=prompt("New name",t);null!==n&&""!==n&&n!=t&&(window.location.search="p="+encodeURIComponent(e)+"&ren="+encodeURIComponent(t)+"&to="+encodeURIComponent(n))}function change_checkboxes(e,t){for(var n=e.length-1;n>=0;n--)e[n].checked="boolean"==typeof t?t:!e[n].checked}function get_checkboxes(){for(var e=document.getElementsByName("file[]"),t=[],n=e.length-1;n>=0;n--)(e[n].type="checkbox")&&t.push(e[n]);return t}function select_all(){change_checkboxes(get_checkboxes(),!0)}function unselect_all(){change_checkboxes(get_checkboxes(),!1)}function invert_all(){change_checkboxes(get_checkboxes())}function mailto(e,t){var n=new XMLHttpRequest,a="path="+e+"&file="+t+"&type=mail&ajax=true";n.open("POST","",!0),n.setRequestHeader("Content-type","application/x-www-form-urlencoded"),n.onreadystatechange=function(){4==n.readyState&&200==n.status&&alert(n.responseText)},n.send(a)}function showSearch(e){var t=new XMLHttpRequest,n="path="+e+"&type=search&ajax=true";t.open("POST","",!0),t.setRequestHeader("Content-type","application/x-www-form-urlencoded"),t.onreadystatechange=function(){4==t.readyState&&200==t.status&&(window.searchObj=t.responseText,document.getElementById("searchresultWrapper").innerHTML="",window.location.hash="#searchResult")},t.send(n)}function getSearchResult(e,t){var n=[],a=[];return e.forEach(function(e){"folder"===e.type?(getSearchResult(e.items,t),e.name.toLowerCase().match(t)&&n.push(e)):"file"===e.type&&e.name.toLowerCase().match(t)&&a.push(e)}),{folders:n,files:a}}function checkbox_toggle(){var e=get_checkboxes();e.push(this),change_checkboxes(e)}function backup(e,t){var n=new XMLHttpRequest,a="path="+e+"&file="+t+"&type=backup&ajax=true";return n.open("POST","",!0),n.setRequestHeader("Content-type","application/x-www-form-urlencoded"),n.onreadystatechange=function(){4==n.readyState&&200==n.status&&alert(n.responseText)},n.send(a),!1}function edit_save(e,t){var n="ace"==t?editor.getSession().getValue():document.getElementById("normal-editor").value;if(n){var a=document.createElement("form");a.setAttribute("method","POST"),a.setAttribute("action","");var o=document.createElement("textarea");o.setAttribute("type","textarea"),o.setAttribute("name","savedata");var c=document.createTextNode(n);o.appendChild(c),a.appendChild(o),document.body.appendChild(a),a.submit()}}function init_php_file_tree(){if(document.getElementsByTagName){for(var e=document.getElementsByTagName("LI"),t=0;t<e.length;t++){var n=e[t].className;if(n.indexOf("pft-directory")>-1)for(var a=e[t].childNodes,o=0;o<a.length;o++)"A"==a[o].tagName&&(a[o].onclick=function(){for(var e=this.nextSibling;;){if(null==e)return!1;if("UL"==e.tagName){var t="none"==e.style.display;return e.style.display=t?"block":"none",this.className=t?"open":"closed",!1}e=e.nextSibling}return!1},a[o].className=n.indexOf("open")>-1?"open":"closed"),"UL"==a[o].tagName&&(a[o].style.display=n.indexOf("open")>-1?"block":"none")}return!1}}var searchEl=document.querySelector("input[type=search]"),timeout=null;searchEl.onkeyup=function(e){clearTimeout(timeout);var t=JSON.parse(window.searchObj),n=document.querySelector("input[type=search]").value;timeout=setTimeout(function(){if(n.length>=2){var e=getSearchResult(t,n),a="",o="";e.folders.forEach(function(e){a+='<li class="'+e.type+'"><a href="?p='+e.path+'">'+e.name+"</a></li>"}),e.files.forEach(function(e){o+='<li class="'+e.type+'"><a href="?p='+e.path+"&view="+e.name+'">'+e.name+"</a></li>"}),document.getElementById("searchresultWrapper").innerHTML='<div class="model-wrapper">'+a+o+"</div>"}},500)},window.onload=init_php_file_tree;if(document.getElementById("file-tree-view")){var tableViewHt=document.getElementById("main-table").offsetHeight-2;document.getElementById("file-tree-view").setAttribute("style","height:"+tableViewHt+"px")};
</script>
<?php if (isset($_GET['view']) && FM_USE_HIGHLIGHTJS): ?>
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
<?php endif; ?>
<?php if (isset($_GET['edit']) && isset($_GET['env']) && FM_EDIT_FILE): ?>
<script src="//cdnjs.cloudflare.com/ajax/libs/ace/1.2.9/ace.js"></script>
<script>var editor = ace.edit("editor");editor.getSession().setMode("ace/mode/javascript");</script>
<?php endif; ?>
</body>
</html>
<?php
}

/**
 * Show image
 * @param string $img
 */
function fm_show_image($img)
{
    $modified_time = gmdate('D, d M Y 00:00:00') . ' GMT';
    $expires_time = gmdate('D, d M Y 00:00:00', strtotime('+1 day')) . ' GMT';

    $img = trim($img);
    $images = fm_get_images();
    $image = 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAEElEQVR42mL4//8/A0CAAQAI/AL+26JNFgAAAABJRU5ErkJggg==';
    if (isset($images[$img])) {
        $image = $images[$img];
    }
    $image = base64_decode($image);
    if (function_exists('mb_strlen')) {
        $size = mb_strlen($image, '8bit');
    } else {
        $size = strlen($image);
    }

    if (function_exists('header_remove')) {
        header_remove('Cache-Control');
        header_remove('Pragma');
    } else {
        header('Cache-Control:');
        header('Pragma:');
    }

    header('Last-Modified: ' . $modified_time, true, 200);
    header('Expires: ' . $expires_time);
    header('Content-Length: ' . $size);
    header('Content-Type: image/png');
    echo $image;

    exit;
}

/**
 * Get base64-encoded images
 * @return array
 */
function fm_get_images()
{
    return array(
        'favicon' => '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ZweE2mzFNLdm15X64Ft+hi9uvWtivRVsUJzcq+ragfgiDWb15lgEvTEIZeFJtN1Mot0o0fXkCtKAihegIbDzrL3BbaedAEkcxMXCeorFHVFVg6FZHz/AOD1OC6FZy5oOrSryxFp5fg3q7/KiIiIiIiIiIiInJlZ2hLF/yPeEELNl2IqHzMGF5rd8HpgQGURMVlnpJ9dcCnQoTCzlHKaaP5YR4qFMI5w2P4VMD9hPxWxXp2q3MzLPIcXnm5wOeDnos83xWR0+mh+7VJggkaw50ZSBIlIJDmNZUnUaEdp5Ut+5Kf6dHDTyJyo6oqsHQrI+f4Bw9s1eHjrQeU+lu3r+GGgEzpIj/N48ePHjx48ePHjx48ePHjx48eHZc4JnNFl/w63EOBErzG9XmVMeawXq4SFx6Y2PAGVejQOvpQrVdfMjzHHx4aMm4LBLzbBEZ91wePHgTO511LN6UCZyKAywUKfgZBHRpqhPNIPEaSlSg1PCEslnHjSiKmU8sf8AbP/aAAwDAQACAAMAAAAQ888888888888888888888888888888888888884wwwwwwwwww088884w884w0488084ww0ww888oMMMMMMMIMI888888U88AIMoU8AokMIAEIU88ooU84M8sA8k8YUw88U88A8oAU8AoQw8A4gU88o8c84U8M88Iok8s88U88A8oAY8AoEM8AsIU88o80w8I4UEoooU8888Q80I8UcckEoc84A8oU88o40cIU0804goc0U8ss8ccss8sM8sc88s88c88oo8880AwkkI4Ig88ocU0cAUowc0c88Q8s0888o8c8sss8c8M8MMM8swUQsgYEEMUA84c8A8888c888888888888888MMsMc8MMMs88sc8888888888888888888888888888888888888888888//8QAFBEBAAAAAAAAAAAAAAAAAAAAgP/aAAgBAwEBPxBL/wD/xAAUEQEAAAAAAAAAAAAAAAAAAACA/9oACAECAQE/EEv/AP/EACsQAQABAwIDCAMBAQEAAAAAAAERACExQVEQYXEggZGhwdHw8TBAseFQcP/aAAgBAQABPxD/ANgRiV6AQRLiOH9Z8+fPnz58+fPnz58+fPnz58+fXDci8KSkMJP4zsqngEq9CvtX2o7Ip4BInU7VvYk1wcSGK+1fak3RhORB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',
        'sprites' => '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
RK5CYII=',
    );
}
?>
