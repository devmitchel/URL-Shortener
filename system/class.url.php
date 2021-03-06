<?php

/*
 * Functions of this off the URL class.
 * ----------------------
 * URLError()
 * URLSuccess()
 * postURL()
*/

class url {

    public function URLError($errorName) {
        echo '
            <div class="notice notice-error">
                <i class="fad fa-minus-circle ulicon"></i>
                <p>'.$errorName.'</p>
            </div>';
    }

    public function URLSuccess($successName) {
        echo'
            <div class="notice notice-success">
                <i class="fad fa-check-circle ulicon"></i>
                <p>'.$successName.'</p>
            </div>';
    }

    public function postURL() {

        if(isset($_POST['submit-url'])) {
            $url = $_POST['url'];
            $pincodes = array("1111", "2222", "3333");
            $pincode = $_POST['pincode'];

            if (in_array($pincode, $pincodes)) {
                $string = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 5)), 0, 6);

                if(is_dir($string)) {
                    return (new url)->URLError('Er is iets mis gegaan, probeer het opnieuw.');
                } else {
                    mkdir($string);
                    $file = dirname('../')."/$string/index.php";
                    $index = fopen($file, 'w');
                    $data = '<?php header("Location: '.$url.'"); ?>';
                    fwrite($index, $data);
                    fclose($index);

                    return (new url)->URLSuccess("<a href='https://url.jansen.work/$string' target='_blank'>http://url.jansen.work/$string</a>");
                }
            } else {
                return (new url)->URLError('You don\'t have access to use this service.');
            }

        }
    }

}
