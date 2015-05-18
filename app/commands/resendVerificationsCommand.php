<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class resendVerificationsCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'resend';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Resend verification emails.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$users = User::whereNotNull('token')->whereNotNull('email')->get();

		foreach ($users as $user) {
			try {
				$email = $user->email;
				Mail::send('emails.auth.verify', array('token' => $user->token, 'fname' => $user->fname, 'lname' => $user->lname), function ($message) use ($email)
				{
					$message->to($email)->subject('Verify your account for BMSITM Reconnect');
				});
			}catch (Exception $e) {
		// Probably invalid email address
				Log::warning($e);
			}
		}

	}
}
