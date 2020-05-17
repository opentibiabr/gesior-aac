<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 19/08/2018
 * Time: 11:45
 */

require_once("PHPMailer");

class SendMail extends Website
{
    
    private $mail;
    private $template;
    
    /**
     * SendMail constructor.
     */
    public function __construct ()
    {
        $this->mail = new PHPMailer(TRUE);
        try {
            /** Server settings */
            $this->mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $this->mail->isSMTP();                                      // Set mailer to use SMTP
            $this->mail->Host = Website::getWebsiteConfig()->getValue('smtp_host');           // Specify main and backup SMTP servers
            $this->mail->SMTPAuth = Website::getWebsiteConfig()->getValue('smtp_auth');       // Enable SMTP authentication
            $this->mail->Username = Website::getWebsiteConfig()->getValue('smtp_user');       // SMTP username
            $this->mail->Password = Website::getWebsiteConfig()->getValue('smtp_pass');       // SMTP password
            $this->mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $this->mail->Port = 587;                                    // TCP port to connect to
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $this->mail->ErrorInfo;
        }
    }
    
    /**
     * @param $sendTo
     * @param $nameSendTo
     * @param $subject
     * @param $mailDescription
     * @param $mailBodyDescription
     * @param $mailBody
     * @return bool
     */
    public function send ($sendTo, $nameSendTo, $subject, $mailDescription, $mailBodyDescription, $mailBody)
    {
        global $config;
        try {
            /** Recipients */
            $this->mail->setFrom(Website::getWebsiteConfig()->getValue('smtp_user'), "Contato - " . $config['server']['serverName']);
            $this->mail->addAddress($sendTo, $nameSendTo);     // Add a recipient
            
            /** Content */
            $this->mail->isHTML(TRUE);                                  // Set email format to HTML
            $this->mail->Subject = $subject;
            $this->mail->Body = $this->makeTemplate($mailDescription, $nameSendTo, $mailBodyDescription, $mailBody);
            
            /** Enviar */
            if($this->mail->send()){
                return TRUE;
            }else{
                return FALSE;
            }
        } catch (\Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $this->mail->ErrorInfo;
        }
    }
    
    
    /**
     * @param $mailDescription
     * @param $nameSendTo
     * @param $mailBodyDescription
     * @param $mailBody
     * @return string
     */
    private function makeTemplate ($mailDescription, $nameSendTo, $mailBodyDescription, $mailBody)
    {
        global $config;
        
        $templateHeader = "
<div marginwidth='0' marginheight='0' style='margin:0;padding:0;height:100%;width:100%;background-color:#f7f7f7'>
    <center>
        <table align='center' border='0' cellpadding='0' cellspacing='0' height='100%' width='100%' id='m_163543659143129539bodyTable' style='border-collapse:collapse;height:100%;margin:0;padding:0;width:100%;background-color:#f7f7f7'>
            <tbody>
                <tr>
                    <td align='center' valign='top' id='m_163543659143129539bodyCell' style='height:100%;margin:0;padding:40px;width:100%;font-family:Helvetica,Arial,sans-serif;line-height:160%'>
                        <table border='0' cellpadding='0' cellspacing='0' id='m_163543659143129539templateContainer' style='border-collapse:collapse;width:600px;background-color:#ffffff;border:1px solid #d9d9d9'>
                            <tbody>
                                <tr>
                                    <td align='center' valign='top' style='font-family:Helvetica,Arial,sans-serif;line-height:160%'>
                                        <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse:collapse'>
                                            <tbody>
                                                <tr>
                                                    <td align='center' style='font-family:Helvetica,Arial,sans-serif;line-height:160%;padding-top:10px;padding-bottom:5px;background: #fff;'>
                                                        <img src='" . Website::getWebsiteConfig()->getValue('realurl') . "/layouts/tibiacom/images/global/header/tibia-logo-artwork-top.png' alt='" . $config['server']['serverName'] . "' id='m_163543659143129539nuLogo' width='150' style='border:0;height:auto;line-height:100%;outline:none;text-decoration:none;max-width:170px;width:170px'>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style='font-family:Helvetica,Arial,sans-serif;line-height:160%'>
                                        <table border='0' cellpadding='0' cellspacing='0' width='100%' id='m_163543659143129539templateHeader' style='border-collapse:collapse;background-color:black;border-top:1px solid #ffffff;border-bottom:1px solid #ffffff'>
                                            <tbody>
                                                <tr>
                                                    <td valign='top' class='m_163543659143129539headerContent' style='font-family:Helvetica,Arial,sans-serif;line-height:100%;color:#505050;font-size:20px;font-weight:bold;padding:50px 0;text-align:left;vertical-align:middle'>
                                                        <!--<img src='https://ci3.googleusercontent.com/proxy/JMeIll9Tyq4x_CnC0tRfKKTN_HZ_n9rBbMSmM6d-V_9gNH0_6o2bnc1BkDhZFuzwEhygVjnChaCZOU0kDaXYBY5LmblhyvoWhl4MfOb8BA=s0-d-e1-ft#http://nu-emails.s3.amazonaws.com/header_waiting_list.png' alt='Retorno sobre o pedido do seu cartão' style='max-width:600px;border:0;height:auto;line-height:100%;outline:none;text-decoration:none' id='m_163543659143129539headerImage' class='CToWUd'>-->
														<img style='float: left; vertical-align: middle' src='" . Website::getWebsiteConfig()->getValue('realurl') . "layouts/tibiacom/images/global/content/headline-bracer-left.gif'/>
														<img style='float: right; vertical-align: middle' src='" . Website::getWebsiteConfig()->getValue('realurl') . "layouts/tibiacom/images/global/content/headline-bracer-right.gif'/>
														<div style='text-align: center; color:#fff'>
															{$mailDescription}
														</div>
													</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td class='m_163543659143129539bodyContent' style='font-family:Helvetica,Arial,sans-serif;line-height:160%;color:#404040;font-size:16px;padding-top:64px;padding-bottom:40px;padding-right:72px;padding-left:72px;background:#ffffff'>
                                        <table border='0' cellpadding='0' cellspacing='0' width='100%' id='m_163543659143129539templateBody' style='border-collapse:collapse;background-color:#ffffff'>
                                            <tbody>
                                                <tr>
                                                    <td valign='top' style='font-family:Helvetica,Arial,sans-serif;line-height:160%;padding-bottom:32px;text-align:center'>
                                                        <h2 class='m_163543659143129539greeting' style='display:block;font-family:Helvetica,Arial,sans-serif;font-style:normal;font-weight:bold;line-height:100%;letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;text-align:center;color:#404040;font-size:20px'>Olá, <strong class='m_163543659143129539highlight' style='color:#6d2177;font-weight:600'>{$nameSendTo}</strong>!</h2>
                                                        <h3 class='m_163543659143129539greeting' style='display:block;font-family:Helvetica,Arial,sans-serif;font-style:normal;font-weight:bold;line-height:100%;letter-spacing:normal;margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;text-align:center;color:#404040;font-size:20px'>{$mailBodyDescription}</h3>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style='font-family:Helvetica,Arial,sans-serif;line-height:160%;padding-bottom:32px;text-align:center'>
												        <p>";
        $templateBody = $mailBody;
        $templateFooter = "
                                                        </p>
													</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td class='m_163543659143129539footerContent' style='font-family:Helvetica,Arial,sans-serif;line-height:160%;background:#ffffff'>
                                        <table border='0' cellpadding='0' cellspacing='0' width='100%' id='m_163543659143129539templateFooter' style='border-collapse:collapse;background-color:#ffffff'>
                                            <tbody>
                                                <tr>
                                                    <td width='80%' style='font-family:Helvetica,Arial,sans-serif;line-height:160%;padding-bottom:16px;text-align:center'>
                                                        <hr class='m_163543659143129539sectionDivider' style='width:80%;border:0;border-top:1px solid #ddd'>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class='m_163543659143129539contact' style='font-family:Helvetica,Arial,sans-serif;line-height:160%;padding-bottom:16px;text-align:center;padding-left:12%;padding-right:12%'>
                                                        <p style='margin:0;color:#999;font-size:12px'>
                                                            Em caso de qualquer dúvida, fique à vontade para responder esse email ou nos contatar no <a href='" . $config['base_url'] . '?subtopic=ticket' . "'>Ticket</a>.
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class='m_163543659143129539spaceS' style='font-family:Helvetica,Arial,sans-serif;line-height:160%;padding-bottom:8px;text-align:center'>
                                                        <a href='" . $config['social']['facebook'] . "' style='color:#6d2177;font-weight:bold;text-decoration:none' target='_blank' data-saferedirecturl=''>
                                                        <img alt='Facebook' src='https://ci5.googleusercontent.com/proxy/-1ZasfLgR3Y4sunI-6-USX3SE0z_0ZaRuTlecIG6yDcYBp4hKUF4hCrTryfoEKBYlNMWEDYulM3hcs1UMfRYKzGHI-Q=s0-d-e1-ft#http://nu-emails.s3.amazonaws.com/ico-face.png' width='32' class='m_163543659143129539icon CToWUd' style='border:0;height:auto;line-height:100%;outline:none;text-decoration:none'>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style='font-family:Helvetica,Arial,sans-serif;line-height:160%;padding-bottom:16px;text-align:center'>
                                                        <hr class='m_163543659143129539shortDivider' style='margin-right:auto;margin-left:auto;width:30px;border:0;border-top:1px solid #ddd'>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class='m_163543659143129539spaceXL' style='font-family:Helvetica,Arial,sans-serif;line-height:160%;padding-bottom:40px;text-align:center'>
                                                        <p style='margin:0;color:#999;font-size:12px'><span class='il'>" . $config['server']['serverName'] . "</span> " . date('Y') . "</p>
                                                        <span class='m_163543659143129539hidden' style='color:#ffffff;font-size:0;height:0'></span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </center>
</div>";
        
        $this->template = $templateHeader;
        $this->template .= $templateBody;
        $this->template .= $templateFooter;
        
        return $this->template;
    }
}
