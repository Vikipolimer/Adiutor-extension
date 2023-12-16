<?php
namespace MediaWiki\Extension\Adiutor\HookHandler;

use MediaWiki\Permissions\PermissionManager;
use MediaWiki\Preferences\Hook\GetPreferencesHook;
use MediaWiki\User\UserGroupManager;
use MediaWiki\User\UserIdentity;
use MediaWiki\User\UserOptionsLookup;
use ExtensionRegistry;

class PreferencesHandler implements GetPreferencesHook
{
	/**
	 * @var PermissionManager
	 */
	private $permissionManager;

	/**
	 * @var UserOptionsLookup
	 */
	private $userOptionsLookup;

	/**
	 * @var UserGroupManager
	 */
	private $userGroupManager;

	/**
	 * @param PermissionManager $permissionManager
	 * @param UserOptionsLookup $userOptionsLookup
	 * @param UserGroupManager $userGroupManager
	 */
	public function __construct(
		PermissionManager $permissionManager,
		UserOptionsLookup $userOptionsLookup,
		UserGroupManager $userGroupManager
	) {
		$this->permissionManager = $permissionManager;
		$this->userOptionsLookup = $userOptionsLookup;
		$this->userGroupManager = $userGroupManager;
	}

	/**
	 * @inheritDoc
	 */
	public function onGetPreferences($user, &$preferences): void
	{
		if (!$this->permissionManager->userHasRight($user, 'edit')) {
			return;
		}

		$isBetaFeatureLoaded = ExtensionRegistry::getInstance()->isLoaded('BetaFeatures');
		if (
			$isBetaFeatureLoaded && !$this->userOptionsLookup->getOption($user, 'adiutor-beta-feature-enable')
		) {
			return;
		}
	}

	/**
	 * @param array $options
	 * @param string $option
	 * @return bool The option is set and truthy
	 */
	private function isTruthy($options, $option): bool
	{
		return !empty($options[$option]);
	}

	/**
	 * @param array $options
	 * @param string $option
	 * @return bool The option is set and falsey
	 */
	private function isFalsey($options, $option): bool
	{
		return isset($options[$option]) && !$options[$option];
	}

	/**
	 * @param UserIdentity $user
	 * @param array &$modifiedOptions
	 * @param array $originalOptions
	 */
	public function onSaveUserOptions($user, &$modifiedOptions, $originalOptions)
	{
		$betaFeatureIsEnabled = $this->isTruthy($originalOptions, 'adiutor-beta-feature-enable');
		$betaFeatureIsDisabled = !$betaFeatureIsEnabled;

		$betaFeatureWillEnable = $this->isTruthy($modifiedOptions, 'adiutor-beta-feature-enable');
		$betaFeatureWillDisable = $this->isFalsey($modifiedOptions, 'adiutor-beta-feature-enable');

		$autoEnrollIsEnabled = $this->isTruthy($originalOptions, 'betafeatures-auto-enroll');
		$autoEnrollIsDisabled = !$autoEnrollIsEnabled;
		$autoEnrollWillEnable = $this->isTruthy($modifiedOptions, 'betafeatures-auto-enroll');

		if (
			($betaFeatureIsEnabled && $betaFeatureWillDisable) ||
			($betaFeatureIsDisabled && $betaFeatureWillEnable) ||
			($betaFeatureIsDisabled && $autoEnrollIsDisabled && $autoEnrollWillEnable)
		) {
			return;
		}
	}
}
