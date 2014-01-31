<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Mail helper
 *
 * @package    fusionFramework
 * @category   Core
 * @author     Maxim Kerstens
 * @copyright  (c) 2013-2014 Maxim Kerstens
 * @license    BSD
 */
class Mail {
	/**
	 * Setup SMTP transport
	 *
	 * @param string $cfg
	 * @return Swift_SmtpTransport
	 */
	protected function _transport_smtp($cfg)
	{
		return Swift_SmtpTransport::newInstance($cfg['host'], $cfg['port'], $cfg['security'])
			->setUsername($cfg['username'])
			->setPassword($cfg['password']);
	}

	/**
	 * Uses the mail function provided by PHP as transport.
	 *
	 * @param null $cfg
	 * @return Swift_MailTransport
	 */
	protected function _transport_mail($cfg=null)
	{
		return Swift_MailTransport::newInstance();
	}

	/**
	 * Setup sendmail transport.
	 *
	 * @param $cfg
	 * @return Swift_SendmailTransport
	 */
	protected function _transport_sendmail($cfg)
	{
		return Swift_SendmailTransport::newInstance($cfg['command']);
	}

	/**
	 * Load a transport method to send mails.
	 *
	 * @param string|null $type
	 * @return Swift_Transport
	 * @throws Kohana_Exception
	 */
	public function transport($type=null)
	{
		$config = Kohana::$config->load('mail.transports');

		if($type == null)
		{
			$type = $config['default'];
		}

		if(!method_exists($this, '_transport_'.$type))
		{
			throw new Kohana_Exception('The email transport ":transport" does not exist.', array(':transport' => $type));
		}

		return call_user_func(array($this, '_transport_'.$type), $config[$type]);
	}

	/**
	 * Setup a swiftmailer_message with defaults.
	 *
	 * @param string $to Email to send the message to
	 * @param string $subject Subject of the mail
	 * @param string $content Mail body
	 * @return Swift_Mime_SimpleMessage
	 */
	public function message($to, $subject, $content)
	{
		$sender = Kohana::$config->load('mail.sender');

		return Swift_Message::newInstance($subject, $content)
			->setFrom($sender['address'], $sender['name'])
			->setTo($to);
	}

	/**
	 * Send a previously setup message.
	 *
	 * @param Swift_Mime_Message $message Message object to send
	 * @param null $transport Which transport method to use
	 * @return bool
	 */
	public function send(Swift_Mime_Message $message, $transport=null)
	{
		$mailer = Swift_Mailer::newInstance($this->transport($transport));

		return $mailer->send($message) > 0;
	}
}