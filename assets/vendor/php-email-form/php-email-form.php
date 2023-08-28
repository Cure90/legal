<?php
class PHP_Email_Form {
    public $to = '';
    public $from_name = '';
    public $from_email = '';
    public $subject = '';
    public $smtp = array(
        'host' => '',
        'username' => '',
        'password' => '',
        'port' => ''
    );
    public $recaptcha_secret_key = '';
    public $ajax = false;

    public function add_message($message, $label = '', $length = 0) {
        if ($label != '') {
            $this->message .= "$label: $message\n";
        } else {
            $this->message .= "$message\n";
        }
    }

    public function send() {
        
        $recaptcha_response = isset($_POST['recaptcha-response']) ? $_POST['recaptcha-response'] : '';

        if (!empty($this->recaptcha_secret_key) && !empty($recaptcha_response)) {
            $recaptcha_verify_url = "https://www.google.com/recaptcha/api/siteverify";
            $recaptcha_data = array(
                'secret' => $this->recaptcha_secret_key,
                'response' => $recaptcha_response
            );

            $recaptcha_options = array(
                'http' => array(
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method' => 'POST',
                    'content' => http_build_query($recaptcha_data)
                )
            );

            $recaptcha_context = stream_context_create($recaptcha_options);
            $recaptcha_result = file_get_contents($recaptcha_verify_url, false, $recaptcha_context);

            if (!$recaptcha_result) {
                return $this->ajax ? "error" : false;
            }

            $recaptcha_result = json_decode($recaptcha_result, true);

            if (!$recaptcha_result['success']) {
                return $this->ajax ? "error" : false;
            }
        }else {
            return $this->ajax ? "error" : false;
        }
        $message = $this->message;
        
        $headers = "From: $this->from_name <$this->from_email>" . "\r\n";
        $headers .= "Reply-To: $this->from_email" . "\r\n";
        $headers .= "Content-type: text/plain; charset=UTF-8" . "\r\n";
        
        if (!empty($this->smtp['host']) && !empty($this->smtp['username']) && !empty($this->smtp['password']) && !empty($this->smtp['port'])) {
            ini_set('SMTP', $this->smtp['host']);
            ini_set('smtp_port', $this->smtp['port']);
            ini_set('sendmail_from', $this->from_email);
            
            $headers = "From: $this->from_name <$this->from_email>" . "\r\n";
            $headers .= "Reply-To: $this->from_email" . "\r\n";
            $headers .= "Content-type: text/plain; charset=UTF-8" . "\r\n";
            
            $params = "-f " . $this->from_email;
            
            $success = mail($this->to, $this->subject, $message, $headers, $params);
        } else {
            $success = mail($this->to, $this->subject, $message, $headers);
        }
        
        if ($this->ajax) {
            return $success ? "OK" : true;
        } else {
            return $success;
        }
    }

    // Otras funciones y métodos según sea necesario
}
?>
