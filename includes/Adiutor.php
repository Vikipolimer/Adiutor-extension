<?php

/**
 * Entry point for Adiutor extension.
 *
 * @file
 * @ingroup Extensions
 */

namespace MediaWiki\Extension\Adiutor;

use MediaWiki\CommentStore\CommentStoreComment;
use MediaWiki\Content\Content;
use MediaWiki\Extension\Adiutor\LocalizationConfiguration;
use MediaWiki\Revision\SlotRecord;
use MediaWiki\Storage\PageUpdater;
use MediaWiki\MediaWikiServices;
use ChangeTags;
use TextContent;
use User;

class Adiutor
{
    /**
     * This method is called when the Adiutor extension is loaded.
     * It creates and saves configuration pages for the extension if they do not already exist.
     * The configuration pages are defined in the $configurationPages array.
     * Each page is checked if it already exists, and if not, a new page is created with the specified content.
     * The content is encoded as JSON and saved as the main slot content of the page.
     * The method uses MediaWiki's PageUpdater to create and save the pages.
     * The user used for creating the pages is User::newFromId(0), which represents the system user.
     * After saving each page, the save status is stored in the $saveStatus variable.
     */
    public static function onExtensionLoad()
    {
        $tagName = 'Adiutor';
        ChangeTags::defineTag($tagName);

        $configurationPages = [
            'MediaWiki:AdiutorRequestPageProtection.json' => LocalizationConfiguration::PAGE_PROTECTION_CONFIGURATION,
            'MediaWiki:AdiutorCreateSpeedyDeletion.json' => LocalizationConfiguration::SPEEDY_DELETION_REQUEST_CONFIGURATION,
            'MediaWiki:AdiutorDeletionPropose.json' => LocalizationConfiguration::DELETION_PROPOSE_CONFIGURATION,
            'MediaWiki:AdiutorRequestPageMove.json' => LocalizationConfiguration::PAGE_MOVE_CONFIGURATION,
            'MediaWiki:AdiutorRequestRevisionDeletion.json' => LocalizationConfiguration::REVISION_DELETION_CONFIGURATION,
            'MediaWiki:AdiutorArticleTagging.json' => LocalizationConfiguration::ARTICLE_TAGGING_CONFIGURATION,
        ];

        $user = User::newFromId(0);
        $services = MediaWikiServices::getInstance();
        $titleFactory = $services->getTitleFactory();

        foreach ($configurationPages as $pageTitle => $content) {
            $title = $titleFactory->newFromText($pageTitle);
            $pageContent = json_encode($content, JSON_PRETTY_PRINT);
            // Check if the page already exists
            if (!$title->exists()) {
                $pageUpdater = MediaWikiServices::getInstance()
                    ->getWikiPageFactory()
                    ->newFromTitle($title)
                    ->newPageUpdater($user);
                $pageUpdater->setContent(SlotRecord::MAIN, new TextContent($pageContent));
                $pageUpdater->saveRevision(
                    CommentStoreComment::newUnsavedComment('Initial content for Adiutor localization file'),
                    EDIT_INTERNAL | EDIT_MINOR | EDIT_AUTOSUMMARY
                );
                $saveStatus = $pageUpdater->getStatus();
            }
        }
    }
}
