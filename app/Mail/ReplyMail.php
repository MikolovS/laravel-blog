<?php
declare( strict_types = 1 );

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class ReplyMail
 * @package App\Mail
 */
class ReplyMail extends Mailable
{
	use Queueable, SerializesModels;

	/**
	 * @var string
	 */
	private $content;
	/**
	 * @var string
	 */
	private $sender;

	/**
	 * ReplyMail constructor.
	 * @param string $sender
	 * @param string $content
	 */
	public function __construct (string $sender, string $content)
	{
		$this->content = $content;
		$this->sender  = $sender;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build ()
	{
		return $this->view('mail.reply')
		            ->with([
			            'content' => $this->content,
			            'sender'    => $this->sender,
		            ]);
	}
}
