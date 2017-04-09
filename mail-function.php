<?php
global $EmailMessage;
class sendNotification{
    // account details
    var $CompanyEmail_;
    var $company_name_;
    var $companyurl_;
    var $company_id_;
    // recipients details
    var $recipient_name_;
    var $recipient_email_;
        // new line character
    var $eol_;
    // senders details
    var $senders_from_name_;
    var $senders_from_email_;
    var $senders_reply_name_;
    var $senders_reply_email_;
    // subject
    var $Subject_;
    // debug
    var $debug;
    // senders domain
    var $senders_domain_;

    function sendNotification($companyname='&Mine',$companyurl='http://andmine.com/',$sendersDomain='andmine.com',$CompanyEmail){
        // account details
        $this->company_name_ = $companyname;
        $this->companyurl_ = $companyurl;
        // new line character
        $this->eol_ = $this->eol();
        //sendors domain
        $this->senders_domain_ = $sendersDomain;
        $this->CompanyEmail_ = $CompanyEmail;

    }

    function eol(){
        if (strtoupper(substr(PHP_OS,0,3)=='WIN'))
            return "\r\n";
        elseif (strtoupper(substr(PHP_OS,0,3)=='MAC'))
            return "\r";
        else
            return "\n";
    }

    function getHeaders($mimeboundary,$BCC=''){
        $BCC = ($BCC==''?"":$BCC.",");//."Send&Mine<send@andmine.com>"; need to added individually which should be send to edm.

        # Common Headers
        $From = $this->senders_from_name_.' <'.$this->senders_from_email_.'>';
        $Reply = $this->senders_reply_name_.' <'.$this->senders_reply_email_.'>';
        $headers  = 'From: '.$From.$this->eol_;
        $headers .= 'Reply-To: '.$Reply.$this->eol_;
        $headers .= 'Return-Path: <www-data>'.$this->eol_;    // these two to set reply address
        $headers .= 'Sender: '.$this->senders_from_name_.' <'.$this->CompanyEmail_.'>'.$this->eol_; //these two to set sender address-for DKIM and Domain Keys
        if($_SERVER['SERVER_NAME']!='localhost' && $BCC!='')
            $headers .= 'Bcc: '.$BCC.$this->eol_;
        $headers .= "Message-ID: <".date('YmdHis').".".mt_rand(7,9999)."@".$this->senders_domain_.">".$this->eol_;
        //$headers .= "X-AndmineEDM:".$this->NTGIDs.$this->eol_;
        $headers .= "X-Mailer: PHP v".phpversion().$this->eol_;          // These two to help avoid spam-filters
        # Boundry for marking the split & Multitype Headers
        $headers .= 'MIME-Version: 1.0'.$this->eol_;
        $headers .= "Content-Type: multipart/mixed; boundary=\"".$mimeboundary."\"".$this->eol_;
        $headers .= "This part of the E-mail should never be seen. If".$this->eol_;
        $headers .= "you are reading this, consider upgrading your e-mail".$this->eol_;
        $headers .= "client to a MIME-compatible client.".$this->eol_;

        return $headers;

    }
    // function to send emails
    // details - contains comma separated name and emails on seperate index
    // $details['Email'] = "abc@xyz.com,xyz@abc.com";
    // $details['Name'] = "abc,xyz";
    // $Subject - Subject of the Email
    // $file_path - path of the file o be attached
    // $attach_file - attachment to be done or not -> true or false
    function sendMail($details,$Subject,$file_path=null,$attach_file=false){
        //echo "Here";
        $mime_boundary = md5(uniqid(time()));
        $To = $details['Name']."<".$details['Email'].">";
        // name and email should have same number of values seperated by comma, for email sending to multiple persons
        $emailArray = explode(",",$details['Email']);
        $nameArray = explode(",",$details['Name']);
        $BCC = '';
        if(count($emailArray)>1){
            for($r=0;$r<count($emailArray);$r++){
                if($r==0)
                    $To = $nameArray[$r]."<".$emailArray[$r].">";
                else
                    $BCC .= $nameArray[$r]."<".$emailArray[$r].">,";
            }
        }
        $subject = $Subject;
        //$subject = "=?UTF-8?Q?".imap_8bit($subject)."?=";
        $headers = $this->getHeaders($mime_boundary,$BCC);
        $message = $this->getMessage($file_path,$attach_file,$mime_boundary);
        //echo "here";
        if((isset($this->debug) && $this->debug == true)){
            echo "<textarea rows=100 cols=100>$headers\n----\n$message</textarea>";
            return -1;
        }
        if($_SERVER['SERVER_NAME']=='localhost'){
            mail('rajendra@localhost.com', $subject, $message, $headers); // need to setup local server for this to work on your local machine
        }
        else{
            //echo "Email ";
            if(mail($To, $subject, $message, $headers))
            {
                return 'true';
            }
            else
            {
                return 'false';
            }
            //echo "Sent";
        }
    }
    // returns the message
    function getMessage($FileName='',$attach_file=false,$mime_boundary){
        $Message = $this->getTextMessage();
        $msg ='';



        # Open the first part of the mail
        $msg .= "--".$mime_boundary.$this->eol_;
        //we must define a different MIME boundary for this section
        $htmlalt_mime_boundary = $mime_boundary."_htmlalt";
        # Setup for text OR html -
        $msg .= "Content-Type: multipart/alternative; boundary=\"".$htmlalt_mime_boundary."\"".$this->eol_.$this->eol_;


        # Text Version
        $msg .= "--".$htmlalt_mime_boundary.$this->eol_;
        //$msg .= "Content-Type: text/plain; charset=iso-8859-1".$this->eol_;
        $msg .= "Content-Type: text/plain; charset=\"UTF-8\"".$this->eol_;
        $msg .= 'MIME-Version: 1.0'.$this->eol_;
        $msg .= "Content-Transfer-Encoding: 8bit".$this->eol_.$this->eol_;
        $msg .= $Message['PlainText'].$this->eol_.$this->eol_;

        # HTML Version
        $msg .= "--".$htmlalt_mime_boundary.$this->eol_;
        //$msg .= "Content-Type: text/html; charset=iso-8859-1".$this->eol_;
        $msg .= "Content-Type: text/html; charset=\"UTF-8\"".$this->eol_;
        $msg .= 'MIME-Version: 1.0'.$this->eol_;
        $msg .= "Content-Transfer-Encoding: 8bit".$this->eol_.$this->eol_;
        $msg .= $Message['HTML'].$this->eol_.$this->eol_; //function tidyCleanUp is at Shared.php file
        //$msg .= $Message['HTML'].$this->eol_.$this->eol_; //function tidyCleanUp is at Shared.php file
        $msg .= "--".$htmlalt_mime_boundary."--".$this->eol_.$this->eol_;

        # IF Needed attachment goes here
        if ($FileName != '' && $attach_file==true){
            if(file_exists($FileName)){
                preg_match("/(.*)\.([^\.]+)/i",basename($FileName), $regs);
                $ext = strtolower($regs[2]);
                $type = "application";
                if($ext == 'pdf') $type='application/pdf';
                if($ext == 'gif') $type='image/gif';
                if($ext == 'jpg') $type='image/jpg';
                if($ext == 'jpeg') $type='image/jpeg';
                if($ext == 'png') $type='image/png';
                if($ext == 'htm') $type='application/html';
                if($ext == 'html') $type='application/html';

                $FileNameArr = explode("/",$FileName);
                $flName = $FileNameArr[(count($FileNameArr)-1)];

                # File for Attachment
                $handle = fopen($FileName, 'rb');
                $f_contents = fread($handle, filesize($FileName));
                $f_contents = chunk_split(base64_encode($f_contents));//Encode The Data For Transition using base64_encode();
                $f_type = filetype($FileName);
                fclose($handle);

                # Attachment
                //$msg .= "--".$htmlalt_mime_boundary.$this->eol_;
                $msg .= "--".$mime_boundary.$this->eol_;
                $msg .= "Content-Type:".$type."; name=\"".$flName."\"".$this->eol_;
                $msg .= "Content-Transfer-Encoding: base64".$this->eol_;
                $msg .= "Content-Description: \"".$flName."\"".$this->eol_;
                $msg .= "Content-Disposition: inline; filename=\"".$flName."\"".$this->eol_.$this->eol_; // !! This line needs TWO end of lines !! IMPORTANT !!
                $msg .= $f_contents.$this->eol_.$this->eol_;
            }
        }

        # Finished
        //$msg .= "--".$htmlalt_mime_boundary."--".$this->eol_.$this->eol_;
        $msg .= "--".$mime_boundary."--".$this->eol_.$this->eol_;  // finish with two eol's for better security. see Injection.

        return $msg;
    }
    // $MessageFor is the function name that should exists on the file - core/lib/sendNotificationEmailText.php
    function getTextMessage(){
        global $EmailMessage;
        // return message from here.
        $Message = array();
        $Message['PlainText'] = $EmailMessage['PlainText'];
        $Message['HTML'] = $EmailMessage['HTML'];
        return $Message;
    }

    function tidyCleanUp($content){
        //
        //  Same content is returned if tidy extenstion is not enabled in server.
        //  This need to be tested once extension is enabled in server later.
        //
        if (!extension_loaded('tidy')) {
                @dl('tidy.so');
        }
        if(class_exists("tidy")){
                $config = array(
                                'indent' => 'auto',
                                'indent-spaces'=>2,
                                'output-xhtml' => TRUE,
                                'quote-marks' =>TRUE,
                                'wrap' => 78,
                                'char-encoding' => 'raw'
                                );
                $tidy = new tidy();
                //$tidy->parseString($content,$config,'utf8');
                $tidy->parseString($content,$config);
                $tidy->cleanRepair();
                return $tidy;
        }
        else
            return $content;

    }
}
?>