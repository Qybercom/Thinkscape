<?php
namespace Services;

use Models\User;
use Quark\Extensions\Facebook\Facebook;
use Quark\Extensions\Mail\Mail;
use Quark\Extensions\PushNotification\Providers\MicrosoftNotificationTemplate;
use Quark\Extensions\PushNotification\PushNotification;
use Quark\IQuarkAuthorizableLiteService;
use Quark\IQuarkGetService;

use Quark\Quark;
use Quark\QuarkCertificate;
use Quark\QuarkDTO;
use Quark\QuarkFile;
use Quark\QuarkLocalizedString;
use Quark\QuarkModel;
use Quark\QuarkSession;

use Quark\Extensions\PushNotification\Device;
use Quark\Extensions\PushNotification\Providers\Microsoft;

use Models\Test;
use Quark\QuarkView;
use ViewModels\TestView;

/**
 * Class TestService
 *
 * @package Services
 */
class TestService implements IQuarkGetService, IQuarkAuthorizableLiteService {
	/**
	 * @param QuarkDTO $request
	 *
	 * @return string
	 */
	public function AuthorizationProvider (QuarkDTO $request) {
		return THINK_SESSION;
	}

	/**
	 * @param QuarkDTO     $request
	 * @param QuarkSession $session
	 *
	 * @return bool|mixed
	 */
	public function AuthorizationCriteria (QuarkDTO $request, QuarkSession $session) {
		return $session->User() != null;
	}

	/**
	 * @param QuarkDTO $request
	 * @param          $criteria
	 *
	 * @return mixed
	 */
	public function AuthorizationFailed (QuarkDTO $request, $criteria) {
		return '401';
	}

	/**
	 * @param QuarkDTO     $request
	 * @param QuarkSession $session
	 *
	 * @return mixed
	 */
	public function Get (QuarkDTO $request, QuarkSession $session) {
		//var_dump($session->Login(null));

		//$facebook = new Facebook(THINK_FACEBOOK);
		//Quark::Redirect($facebook->LoginURL(Quark::WebHost() . '/facebook'));
		//print_r($session);
		print_r($session->User()->facebook->Session(THINK_FACEBOOK)->Profile());

		//echo $facebook->LoginURL(Quark::WebHost() . '/facebook');
		//$locale = new QuarkLocalizedString(111);

		//echo $locale->Link($locale->Unlink());
		//return new QuarkView(new TestView());
		//print_r($session);
		/*$file = new QuarkFile(__FILE__);
		return $file->Download();*/
		/*$mail = new Mail(THINK_MAIL_GOOGLE,
			'Welcome to Thinkscape',
			'Encoding test<br>
			Here it. Проверка кодировки компонента Mail фреймворка Quark.<br>
			<br>
			Отлично, все работает =) на винфоне норм (при неправильном заголовке были кракозябры)
			'
		);

		$mail->To('alex025@evolutex.ru');
		$mail->To('saniafd93@gmail.com');

		//$mail->File(new QuarkFile(__FILE__));
		//$mail->File(new QuarkFile(Quark::Host() . '/index.php'));

		//var_dump($mail->Test());
		var_dump($mail->Send());

		echo $mail->Log();*/
		/*$push = new PushNotification(THINK_PUSH, array(
			'foo' => 'bar'
		));

		$push->Options(new Microsoft(), array(
			Microsoft::OPTION_VISUAL => array(
				(new MicrosoftNotificationTemplate(MicrosoftNotificationTemplate::TOAST_TEXT_02))
					->Text('hello')
					->Text('world')
			)
		));

		//$push->Device(new Device(Apple::TYPE, '<a3c831bb 17556b84 1ad09016 329a056a 59b7e42f 603e41e7 a12316ee 848e5bad>'));
		$push->Device(new Device(Microsoft::TYPE, 'https://db3.notify.windows.com/?token=AwYAAAAPmSS20fQksR5djm%2fBYkqzjffGmx8dzOmUKzXoP2WSNhXGqKtQ%2fOiYMAAIfETDglnRb0bXMsmn8hYy4IokLOi6%2fwyRJpX%2f6I1hZG8N0MRzRdpMiyc0ENVcAnBBdXoHfMI%3d'));
		//$push->Device(new Device(Microsoft::TYPE, 'https://db3.notify.windows.com/?token=AwYAAADzlzGuYY7PK4YqaB%2bXToDyQfnMZkmNkWtFT531R4Ma%2fBstbIWC6S%2f8EhNeA21BM8jZZZOG%2b%2fk6RFB1F%2b7cM%2bcU3X5oqfbQYiBNDwkrqapIBVmsJj5QrlH1oPkFg%2fAajEc%3d'));
		//$push->Device(new Device(Microsoft::TYPE, 'https://db3.notify.windows.com/?token=AwYAAAA0yGqqVuyG6bBH9lszOIboxaj5%2fJnajHciJB2Z5T730%2buAcRoV2CxWOJFLnaQdOopLMktTD%2bc2Zt5eegD9UJWfpAi6r%2fdXqa0MNVhG5yl9zF8PDai14CnSPmFVfUiyIXI%3d'));

		var_dump($push->Send());*/
		/*echo 'test';
		$test = new QuarkModel(new Test());

		$test->id = 1;
		$test->Create();*/

	}
}