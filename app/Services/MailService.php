<?php
declare( strict_types = 1 );

namespace App\Services;

use App\Mail\ReplyMail;
use Illuminate\Mail\Mailer;

/**
 * Class MailService
 * @package App\Services
 */
class MailService
{
	/**
	 * @var Mailer
	 */
	private $mailer;

	/**
	 * MailService constructor.
	 * @param Mailer $mailer
	 */
	public function __construct (Mailer $mailer)
	{
		$this->mailer = $mailer;
	}

	/**
	 * @param string $sender
	 * @param string $to
	 * @param string $content
	 */
	public function send (string $sender, string $to, string $content)
	{
		$this->mailer->to($to)
		             ->send(new ReplyMail($sender, $content));
	}
}