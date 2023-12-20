<?php

/**
 * Adiutor Special page.
 *
 * @file
 */

namespace MediaWiki\Extension\Adiutor;

class AdiutorSettings extends \SpecialPage
{
    /**
     * Initialize the special page.
     */
    public function __construct()
    {
        parent::__construct('AdiutorSettings');
    }

    /**
     * Returns the description of the AdiutorSettings object.
     *
     * @return string The description of the AdiutorSettings object.
     */
    public function getDescription()
    {
        return $this->msg('adiutor-settings')->text();
    }

    /**
     * Shows the page to the user.
     * @param string $sub The subpage string argument (if any).
     */
    public function execute($sub)
    {
        $user = $this->getUser();
        if (!$user->isAllowed('editinterface')) {
            throw new \PermissionsError('editinterface');
        }
        $out = $this->getOutput();
        $out->setPageTitle($this->msg('adiutor-settings'));
        $out->addHtml('<div id="adiutor-settings"></div>');
    }

    protected function getGroupName()
    {
        return 'other';
    }
}
