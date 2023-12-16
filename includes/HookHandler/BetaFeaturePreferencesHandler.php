<?php
namespace MediaWiki\Extension\Adiutor\HookHandler;

use MediaWiki\Permissions\PermissionManager;
use Config;
use User;

class BetaFeaturePreferencesHandler
{
	/**
	 * @var Config
	 */
	private $config;

	/**
	 * @var PermissionManager
	 */
	private $permissionManager;

	/**
	 * @param Config $config
	 * @param PermissionManager $permissionManager
	 */
	public function __construct(
		Config $config,
		PermissionManager $permissionManager
	) {
		$this->config = $config;
		$this->permissionManager = $permissionManager;
	}

	/**
	 * @param User $user
	 * @param array[] &$betaPrefs
	 */
	public function onGetBetaFeaturePreferences($user, &$betaPrefs)
	{
		$extensionAssetsPath = $this->config->get('ExtensionAssetsPath');

		if (
			$this->permissionManager->userHasRight($user, 'edit')
		) {
			$url = 'https://mediawiki.org/wiki/';
			$infoLink = $url . 'Extension:Adiutor';
			$discussionLink = $url . 'Extension_talk:Adiutor';
			$betaPrefs['adiutor-beta-feature-enable'] = [
				'label-message' => 'adiutor-title',
				'desc-message' => 'adiutor-desc',
				'info-link' => $infoLink,
				'discussion-link' => $discussionLink,
				'requirements' => [
					'javascript' => true,
				],
			];
		}
	}
}
