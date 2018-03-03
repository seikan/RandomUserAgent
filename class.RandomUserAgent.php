<?php

/**
 * RandomUserAgent: Randomly generate browser user agent that looks valid.
 *
 * Copyright (c) 2018 Sei Kan
 *
 * Distributed under the terms of the MIT License.
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright  2018 Sei Kan <seikan.dev@gmail.com>
 * @license    http://www.opensource.org/licenses/mit-license.php The MIT License
 *
 * @see       https://github.com/seikan/RandomUserAgent
 */
class RandomUserAgent
{
	const WINDOWS = 1;
	const LINUX = 2;
	const MAC_OS = 3;

	const FIREFOX = 1;
	const EDGE = 2;
	const IE = 3;
	const CHROME = 4;
	const SAFARI = 5;

	private $platform;

	/**
	 * Get a random user agent.
	 *
	 * @return string
	 */
	public function getUserAgent()
	{
		return $this->getBrowser($this->getBrowserByPlatform($this->getPlatform()));
	}

	/**
	 * Get a random platform number.
	 *
	 * @return int
	 */
	private function getPlatform()
	{
		$this->platform = mt_rand(1, 3);

		return $this->platform;
	}

	/**
	 * Get a random browser number by platform.
	 *
	 * @param mixed $platform
	 *
	 * @return int
	 */
	private function getBrowserByPlatform($platform)
	{
		switch ($platform) {
			case self::WINDOWS:
				$browsers = [
					self::FIREFOX, self::IE, self::EDGE, self::CHROME, self::SAFARI,
				];
				break;

			case self::LINUX:
				$browsers = [
					self::FIREFOX, self::CHROME,
				];
				break;

			case self::MAC_OS:
				$browsers = [
					self::FIREFOX, self::CHROME, self::SAFARI,
				];
				break;
		}

		return $browsers[mt_rand(0, count($browsers) - 1)];
	}

	/**
	 * Get browser user agent.
	 *
	 * @param mixed $browser
	 *
	 * @return string
	 */
	private function getBrowser($browser)
	{
		switch ($browser) {
			case self::FIREFOX:
				return $this->firefox();

			case self::EDGE:
				return $this->edge();

			case self::IE:
				return $this->ie();

			case self::CHROME:
				return $this->chrome();

			case self::SAFARI:
				return $this->safari();
		}
	}

	/**
	 * Generate user agent for Firefox browser.
	 *
	 * @return string
	 */
	private function firefox()
	{
		$version = mt_rand(40, 60) . '.' . mt_rand(0, 5);

		switch ($this->platform) {
			case self::WINDOWS:
				$architectures = [
					'', 'WOW64; ', 'Win64; x64; ', 'Win64; ',
				];

				return 'Mozilla/5.0 (' . $this->getWindowsNT() . '; ' . $architectures[mt_rand(0, count($architectures) - 1)] . 'rv:' . $version . ') Gecko/20' . mt_rand(10, 15) . '0101 Firefox/' . $version;

			case self::LINUX:
				$systems = [
					'', 'U; ', 'Ubuntu; ',
				];

				return 'Mozilla/5.0 (X11; ' . $systems[mt_rand(0, count($systems) - 1)] . $this->getLinux() . '; rv:' . $version . ') Gecko/20' . mt_rand(10, 15) . '0101 Firefox/' . $version;

			case self::MAC_OS:
				$languages = [
					'', '; ' . $this->getLanguageCode() . ';',
				];

				return 'Mozilla/5.0 (Macintosh; ' . $this->getMac() . ' Mac OS X 10.' . mt_rand(9, 15) . $languages[mt_rand(0, count($languages) - 1)] . ' rv:' . $version . ') Gecko/20' . mt_rand(10, 15) . '0101 Firefox/' . $version;
		}
	}

	/**
	 * Generate user agent for Microsoft Edge browser.
	 *
	 * @return string
	 */
	private function edge()
	{
		$architectures = [
			'', '; WOW64', '; Win64; x64', '; Win64',
		];

		return 'Mozilla/5.0 (Windows NT 10.0' . $architectures[mt_rand(0, count($architectures) - 1)] . ') AppleWebKit/537.36 (KHTML, like Gecko) Chrome/' . mt_rand(42, 64) . '.0.' . mt_rand(2300, 3200) . '.' . mt_rand(110, 135) . ' Safari/537.36 Edge/' . mt_rand(12, 18) . '.' . mt_rand(1400, 1800);
	}

	/**
	 * Generate user agent for Microsoft Internet Explorer browser.
	 *
	 * @return string
	 */
	private function ie()
	{
		$architectures = [
			'', 'WOW64; ', 'Win64; x64; ', 'Win64; ',
		];

		$extras = [
			'',
			'; .NET CLR 1.1.' . rand(4320, 4325),
			'; WOW64',
			'; SLCC2; Media Center PC 6.0; InfoPath.3',
			'; .NET CLR 1.1.' . mt_rand(1000, 5000) . '; .NET CLR 2.0.' . mt_rand(1000, 6000),
			'; SLCC2; .NET CLR 2.' . mt_rand(50000, 55000) . '; .NET CLR 3.5.' . mt_rand(30000, 35000) . '; .NET CLR 3.' . mt_rand(30000, 35000) . '; .NET4.0C; .NET4.0E',
			'; SLCC2; .NET CLR 2.0.' . mt_rand(50000, 55000) . '; .NET CLR 3.5.30729; .NET CLR 3.0.' . mt_rand(30000, 35000) . '; Media Center PC 6.0; .NET4.0C; InfoPath.3; .NET4.0E',
		];

		return 'Mozilla/5.0 (compatible; MSIE ' . mt_rand(7, 9) . '.0; ' . $this->getWindowsNT() . '; ' . $architectures[mt_rand(0, count($architectures) - 1)] . 'Trident/' . mt_rand(3, 7) . '.0' . $extras[mt_rand(0, count($extras) - 1)] . ')';
	}

	/**
	 * Generate user agent for Google Chrome browser.
	 *
	 * @return string
	 */
	private function chrome()
	{
		$version = mt_rand(42, 66) . '.0.' . mt_rand(2500, 3300) . '.' . mt_rand(0, 199);

		switch ($this->platform) {
			case self::WINDOWS:
				$architectures = [
					'', '; WOW64', '; Win64; x64', '; Win64',
				];

				return 'Mozilla/5.0 (' . $this->getWindowsNT() . $architectures[mt_rand(0, count($architectures) - 1)] . ') AppleWebKit/537.36 (KHTML, like Gecko) Chrome/' . $version . ' Safari/537.36';

			case self::LINUX:
				$systems = [
					'', ' Ubuntu Chromium/' . $version,
				];

				$languages = [
					'', '; ' . $this->getLanguageCode(),
				];

				return 'Mozilla/5.0 (X11; ' . ((mt_rand(0, 10) > 7) ? 'U; ' : '') . $this->getLinux() . $languages[mt_rand(0, count($languages) - 1)] . ') AppleWebKit/537.36 (KHTML, like Gecko)' . $systems[mt_rand(0, count($systems) - 1)] . ' Chrome/' . $version . ' Safari/537.36';

			case self::MAC_OS:
				$extras = [
					'', ' OPR/' . mt_rand(44, 49) . '.0.' . mt_rand(2200, 2500) . '.' . mt_rand(10, 199),
				];

				return 'Mozilla/5.0 (Macintosh; ' . $this->getMac() . ' Mac OS X 10_' . mt_rand(5, 15) . '_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/' . $version . ' Safari/537.36' . $extras[mt_rand(0, count($extras) - 1)];
		}
	}

	/**
	 * Generate user agent for Apple Safari browser.
	 *
	 * @return string
	 */
	private function safari()
	{
		$version = mt_rand(531, 604) . '.' . mt_rand(0, 50) . ((mt_rand(0, 10) > 7) ? ('.' . mt_rand(0, 199)) : '');

		switch ($this->platform) {
			case self::WINDOWS:
				$architectures = [
					'', '; WOW64', '; Win64; x64', '; Win64',
				];

				$languages = [
					'', '; ' . $this->getLanguageCode(),
				];

				return 'Mozilla/5.0 (' . $this->getWindowsNT() . $architectures[mt_rand(0, count($architectures) - 1)] . $languages[mt_rand(0, count($languages) - 1)] . ') AppleWebKit/' . $version . ' (KHTML, like Gecko) Version/' . mt_rand(3, 5) . '.' . mt_rand(0, 1) . '.' . mt_rand(0, 5) . ' Safari/' . $version;

			case self::MAC_OS:
				return 'Mozilla/5.0 (Macintosh; ' . $this->getMac() . ' Mac OS X 10_' . mt_rand(5, 13) . '_' . mt_rand(0, 9) . ') AppleWebKit/' . $version . ' (KHTML, like Gecko) Version/' . mt_rand(5, 11) . '.0.' . mt_rand(0, 10) . ' Safari/' . $version;
		}
	}

	/**
	 * Generate Windows NT version.
	 *
	 * @return string
	 */
	private function getWindowsNT()
	{
		return 'Windows NT ' . mt_rand(5, 10) . '.' . mt_rand(0, 1);
	}

	/**
	 * Generate Linux architecture.
	 *
	 * @return string
	 */
	private function getLinux()
	{
		$codes = [
			'i686', 'i686 (x86_64)', 'x86_64', 'armv6l', 'armv7l', 'amd64',
		];

		return 'Linux ' . $codes[mt_rand(0, count($codes) - 1)];
	}

	/**
	 * Generate Mac OS architecture.
	 *
	 * @return string
	 */
	private function getMac()
	{
		$codes = [
			'Intel', 'PPC', 'U; Intel', 'U; PPC',
		];

		return $codes[mt_rand(0, count($codes) - 1)];
	}

	/**
	 * Generate browser language code.
	 *
	 * @return string
	 */
	private function getLanguageCode()
	{
		$codes = [
			'en-CA', 'en-US', 'en-GB', 'es', 'es-AR', 'es-ES', 'es-MX', 'fr', 'fr-FR', 'fr-US', 'de', 'de-DE', 'ru', 'ru-MO', 'zh', 'zh-TW', 'zh-CN', 'zh-SG',
		];

		return $codes[mt_rand(0, count($codes) - 1)];
	}
}
