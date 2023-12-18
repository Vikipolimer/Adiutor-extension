<?php

/**
 * This file contains the LocalizationConfiguration class, which defines various configuration constants
 * for the Adiutor extension in MediaWiki.
 *
 * The LocalizationConfiguration class contains constants for deletion propose configuration,
 * page protection configuration, speedy deletion request configuration, page move configuration,
 * revision deletion configuration, and article tagging configuration.
 *
 * @package MediaWiki\Extension\Adiutor
 */

namespace MediaWiki\Extension\Adiutor;

class LocalizationConfiguration
{
    public const DELETION_PROPOSE_CONFIGURATION = [
        'moduleEnabled' => false,
        'standardProposeTemplate' => '{{subst:Proposed deletion|concern=$2}}',
        'livingPersonProposeTemplate' => '{{Prod blp/dated|concern=$2|user=$6|timestamp=$3 $4 $5|help=off}}',
        'apiPostSummary' => 'Proposed deletion of the page per [[WP:PROD]]',
        'apiPostSummaryforCreator' => 'Proposed deletion of [[$1|$1]] per [[WP:PROD]]',
        'apiPostSummaryforLog' => 'Logging the page [[$1|$1]] as a pending deletion candidate per [[WP:PROD]].',
        'prodNotificationTemplate' => '{{subst:Proposed deletion notify|$1}}'
    ];

    public const PAGE_PROTECTION_CONFIGURATION = [
        'moduleEnabled' => false,
        'protectionDurations' => [
            [
                'value' => 'temporary',
                'data' => 'Temporary',
                'label' => 'Temporary'
            ],
            [
                'value' => 'indefinite',
                'data' => 'Indefinite',
                'label' => 'Indefinite'
            ]
        ],
        'protectionTypes' => [
            [
                'value' => 'semi-protection',
                'data' => 'Semi-protection',
                'label' => 'Semi-protection'
            ],
            [
                'value' => 'full-protection',
                'data' => 'Full protection',
                'label' => 'Full protection'
            ]
        ],
        'noticeBoardTitle' => 'Wikipedia:Requests for page protection',
        'addNewSection' => false,
        'sectionTitle' => 'Protection request for [[$1|$1]]',
        'useExistSection' => false,
        'sectionId' => null,
        'textModificationDirection' => 'appendtext',
        'contentPattern' => 'Protection Type: $2 $3 Rationale: $4 ~~~~',
        'apiPostSummary' => 'Protection requested for [[$1|$1]]'
    ];

    public const SPEEDY_DELETION_REQUEST_CONFIGURATION = [
        'moduleEnabled' => false,
        'speedyDeletionReasons' => [
            [
                'name' => 'Articles',
                'namespace' => 0,
                'reasons' => [
                    [
                        'namespace' => 0,
                        'value' => 'A1',
                        'data' => '[[WP:CSD#A1|A1]]: Short article without enough context to identify the subject',
                        'selected' => false,
                        'label' => 'A1 - No context.',
                        'help' => 'Short article without enough context to identify the subject'
                    ],
                    [
                        'namespace' => 0,
                        'value' => 'A2',
                        'data' => '[[WP:CSD#A2|A2]]: Article in a foreign language that exists on another project',
                        'selected' => false,
                        'label' => 'A2 - Article in a foreign language',
                        'help' => 'Article in a foreign language that exists on another project'
                    ],
                    [
                        'namespace' => 0,
                        'value' => 'A3',
                        'data' => '[[WP:CSD#A3|A3]]: No content',
                        'selected' => false,
                        'label' => 'A3 - No content',
                        'help' => 'Article in a foreign language that exists on another project'
                    ]
                ]
            ],
            [
                'name' => 'Files',
                'namespace' => 6,
                'reasons' => [
                    [
                        'namespace' => 6,
                        'value' => 'F1',
                        'data' => '[[WP:CSD#F1|CSD:F1]]: Test file',
                        'selected' => false,
                        'label' => 'F1 - File uploaded for test',
                        'help' => 'This is a help text about the criteria'
                    ]
                ]
            ],
            [
                'name' => 'Categories',
                'namespace' => 14,
                'reasons' => [
                    [
                        'data' => '[[WP:CSD#C1|CSD:C1]]: Test category',
                        'value' => 'C1',
                        'selected' => false,
                        'label' => 'C1 - Category created for test',
                        'namespace' => 14,
                        'help' => 'This is a help text about the criteria'
                    ]
                ]
            ],
            [
                'name' => 'User pages',
                'namespace' => 2,
                'reasons' => [
                    [
                        'data' => '[[WP:CSD#U1|CSD:U1]]: Test user page',
                        'value' => 'U1',
                        'selected' => false,
                        'label' => 'U1 - User page created for test',
                        'namespace' => 2,
                        'help' => 'This is a help text about the criteria'
                    ]
                ]
            ],
            [
                'name' => 'Templates',
                'namespace' => 10,
                'reasons' => [
                    [
                        'data' => '[[WP:CSD#T1|CSD:T1]]: Test template',
                        'value' => 'T1',
                        'selected' => false,
                        'label' => 'T1 - Template created for test',
                        'namespace' => 10,
                        'help' => 'This is a help text about the criteria'
                    ]
                ]
            ],
            [
                'name' => 'Portals',
                'namespace' => 100,
                'reasons' => [
                    [
                        'data' => '[[WP:CSD#T1|CSD:P1]]: Test portal',
                        'value' => 'P1',
                        'selected' => false,
                        'label' => 'P1 - Portal created for test',
                        'namespace' => 100,
                        'help' => 'This is a help text about the criteria'
                    ]
                ]
            ],
            [
                'name' => 'General',
                'namespace' => 'general',
                'reasons' => [
                    [
                        'data' => '[[WP:CSD#G1|G1]]: [[WP:PN|Patent nonsense]], meaningless, or incomprehensible',
                        'value' => 'G1',
                        'selected' => false,
                        'label' => 'G1 -  Patent nonsense',
                        'namespace' => 'general',
                        'help' => 'This is a help text about the criteria'
                    ],
                    [
                        'data' => '[[WP:CSD#G2|G2]]: Test page',
                        'value' => 'G2',
                        'selected' => false,
                        'label' => 'G2 - Test page',
                        'namespace' => 'general',
                        'help' => 'This is a help text about the criteria'
                    ],
                    [
                        'data' => '[[WP:CSD#G3|G3]]: [[WP:Vandalism|Vandalism]]',
                        'value' => 'G3',
                        'selected' => false,
                        'label' => 'G3 - Pure vandalism',
                        'namespace' => 'general',
                        'help' => 'This is a help text about the criteria'
                    ],
                    [
                        'data' => '[[WP:CSD#G4|G4]]: Unambiguous [[WP:CV|copyright infringement]]',
                        'value' => 'G4',
                        'selected' => false,
                        'label' => 'G4 - Unambiguous copyright infringement',
                        'namespace' => 'general',
                        'help' => 'This is a help text about the criteria'
                    ]
                ]
            ],
            [
                'name' => 'Redirects',
                'namespace' => 'redirect',
                'reasons' => [
                    [
                        'data' => '[[WP:CSD#R1|CSD:R1]]: A test redirect',
                        'value' => 'R1',
                        'selected' => false,
                        'label' => 'R1 - A test redirect',
                        'namespace' => 'redirect',
                        'help' => 'This is a help text about the criteria'
                    ]
                ]
            ],
            [
                'name' => 'Other',
                'namespace' => 'other',
                'reasons' => [
                    [
                        'data' => '[[Other|other]]: reason',
                        'value' => '01',
                        'selected' => false,
                        'label' => 'Other reason',
                        'namespace' => 'other',
                        'help' => 'This is a help text about the criteria'
                    ]
                ]
            ]
        ],
        'csdTemplateStartSingleReason' => '{{Db-',
        'csdTemplateStartMultipleReason' => '{{Db-multiple',
        'postfixReasonUsage' => 'value',
        'multipleReasonSeparation' => 'vertical_bar',
        'speedyDeletionPolicyLink' => 'Wikipedia:Criteria_for_speedy_deletion',
        'speedyDeletionPolicyPageShortcut' => 'WP:CSD',
        'apiPostSummaryforTalkPage' => '[[WP:CSD#G1]]: Discussion page of the deleted article',
        'apiPostSummaryforLog' => 'Log record of the speedy deletion request of [[$1]] is being logged.',
        'csdNotificationTemplate' => '{{subst:CSD-Notification|1=$1|2=$2}}',
        'singleReasonSummary' => 'Requesting speedy deletion for the page per $2.',
        'multipleReasonSummary' => 'Requesting speedy deletion for the page per $2.',
        'copyVioReasonValue' => 'G4'
    ];

    public const PAGE_MOVE_CONFIGURATION = [
        'moduleEnabled' => false,
        'noticeBoardTitle' => 'Wikipedia:Page move requests',
        'addNewSection' => false,
        'sectionTitle' => 'Page move request for [[$1]]',
        'useExistSection' => false,
        'sectionId' => null,
        'textModificationDirection' => 'appendtext',
        'contentPattern' => "Move [[\$1]] to [[\$2]]\n\nRationale: \$3 ~~~~",
        'apiPostSummary' => 'Page move request created for [[$1|$1]].'
    ];

    public const REVISION_DELETION_CONFIGURATION = [
        'moduleEnabled' => false,
        'noticeBoardTitle' => 'Wikipedia:Revision deletion/Noticeboard',
        'addNewSection' => false,
        'sectionTitle' => 'Revision deletion request for [[$1]]',
        'useExistSection' => false,
        'sectionId' => null,
        'textModificationDirection' => 'appendtext',
        'contentPattern' => "*'''Revision:''' [[Special:Diff/\$1]]\n*'''Rationale:''' \$2\n*'''Comment:''' \$3 ~~~~\n*'''Outcome:'''",
        'apiPostSummary' => 'Created a revision deletion request for [[$1]] page.'
    ];

    public const ARTICLE_TAGGING_CONFIGURATION = [
        'moduleEnabled' => false,
        'tagList' => [
            [
                'label' => 'Cleanup and maintenance',
                'tags' => [
                    [
                        'tag' => 'Cleanup',
                        'description' => 'Article requires cleanup',
                        'items' => [
                            [
                                'name' => 'cleanup',
                                'required' => true,
                                'parameter' => 'reason',
                                'type' => 'input',
                                'label' => 'Specific reason why cleanup is needed:',
                                'help' => 'Required.',
                                'value' => '',
                                'tooltip' => ''
                            ]
                        ]
                    ],
                    [
                        'tag' => 'Cleanup rewrite',
                        'description' => "Article needs to be rewritten entirely to comply with Wikipedia's quality standards",
                        'items' => []
                    ],
                    [
                        'tag' => 'Copy edit',
                        'description' => 'Article requires copy editing for grammar, style, cohesion, tone, or spelling',
                        'items' => [
                            [
                                'name' => 'copyEdit',
                                'required' => false,
                                'parameter' => 'for',
                                'type' => 'input',
                                'label' => '"This article may require copy editing for..."',
                                'help' => 'e.g. "consistent spelling". Optional.',
                                'value' => '',
                                'tooltip' => ''
                            ]
                        ]
                    ]
                ]
            ],
            [
                'label' => 'Potentially unwanted content',
                'tags' => [
                    [
                        'tag' => 'Close paraphrasing',
                        'description' => 'Article contains close paraphrasing of a non-free copyrighted source',
                        'items' => [
                            [
                                'name' => 'closeParaphrasing',
                                'required' => false,
                                'parameter' => 'source',
                                'type' => 'input',
                                'label' => 'Source:',
                                'help' => 'Source that has been closely paraphrased',
                                'value' => '',
                                'tooltip' => ''
                            ]
                        ]
                    ],
                    [
                        'tag' => 'Copypaste',
                        'description' => 'Article appears to have been copied and pasted from another location',
                        'excludeMI' => true,
                        'items' => [
                            [
                                'name' => 'copypaste',
                                'required' => false,
                                'parameter' => 'url',
                                'type' => 'input',
                                'label' => 'Source URL:',
                                'help' => 'If known.',
                                'value' => '',
                                'tooltip' => ''
                            ]
                        ]
                    ],
                    [
                        'tag' => 'AI-generated',
                        'description' => 'Article content appears to be generated by a large language model',
                        'items' => []
                    ],
                    [
                        'tag' => 'External links',
                        'description' => 'Article external links may not follow content policies or guidelines',
                        'items' => []
                    ],
                    [
                        'tag' => 'Non-free',
                        'description' => 'Article may contain excessive or improper use of copyrighted materials',
                        'items' => []
                    ]
                ]
            ], [
                'label' => 'Structure, formatting, and lead section',
                'tags' => [
                    [
                        'tag' => 'Cleanup reorganize',
                        'description' => "Article needs reorganization to comply with Wikipedia's layout guidelines",
                        'items' => []
                    ],
                    [
                        'tag' => 'Lead missing',
                        'description' => 'Article no lead section',
                        'items' => []
                    ],
                    [
                        'tag' => 'Lead rewrite',
                        'description' => 'Article lead section needs to be rewritten to comply with guidelines',
                        'items' => []
                    ],
                    [
                        'tag' => 'Lead too long',
                        'description' => 'Article lead section is too long for the length of the article',
                        'items' => []
                    ],
                    [
                        'tag' => 'Lead too short',
                        'description' => 'Article lead section is too short and should be expanded to summarize key points',
                        'items' => []
                    ],
                    [
                        'tag' => 'Sections',
                        'description' => 'Article needs to be divided into sections by topic',
                        'items' => []
                    ],
                    [
                        'tag' => 'Too many sections',
                        'description' => 'Article has too many section headers dividing up content and should be condensed',
                        'items' => []
                    ],
                    [
                        'tag' => 'Very long',
                        'description' => 'Article is too long to read and navigate comfortably',
                        'items' => []
                    ]
                ]
            ],
            [
                'label' => 'Fiction-related cleanup',
                'tags' => [
                    [
                        'tag' => 'All plot',
                        'description' => 'Article almost entirely a plot summary',
                        'items' => []
                    ],
                    [
                        'tag' => 'Fiction',
                        'description' => 'Article fails to distinguish between fact and fiction',
                        'items' => []
                    ],
                    [
                        'tag' => 'In-universe',
                        'description' => 'Article subject is fictional and needs rewriting to provide a non-fictional perspective',
                        'items' => []
                    ],
                    [
                        'tag' => 'Long plot',
                        'description' => 'Article plot summary is too long or excessively detailed',
                        'items' => []
                    ],
                    [
                        'tag' => 'No plot',
                        'description' => 'Article needs a plot summary',
                        'items' => []
                    ]
                ]
            ],
            [
                'label' => 'General content issues',
                'tags' => [
                    [
                        'tag' => 'Notability',
                        'description' => 'Article subject may not meet the general notability guideline',
                        'items' => [
                            [
                                'name' => 'notability',
                                'required' => false,
                                'parameter' => 'Academics',
                                'type' => 'checkbox',
                                'label' => 'Academics: notability guideline for academics',
                                'help' => '',
                                'value' => 'Academics'
                            ],
                            [
                                'name' => 'notability',
                                'required' => false,
                                'parameter' => 'Astro',
                                'type' => 'checkbox',
                                'label' => 'Astro: notability guideline for astronomical objects',
                                'help' => '',
                                'value' => 'Astro'
                            ],
                            [
                                'name' => 'notability',
                                'required' => false,
                                'parameter' => 'Biographies',
                                'type' => 'checkbox',
                                'label' => 'Biographies: notability guideline for biographies',
                                'help' => '',
                                'value' => 'Biographies'
                            ],
                            [
                                'name' => 'notability',
                                'required' => false,
                                'parameter' => 'Books',
                                'type' => 'checkbox',
                                'label' => 'Books: notability guideline for books',
                                'help' => '',
                                'value' => 'Books'
                            ],
                            [
                                'name' => 'notability',
                                'required' => false,
                                'parameter' => 'Companies',
                                'type' => 'checkbox',
                                'label' => 'Companies: notability guidelines for companies and organizations',
                                'help' => '',
                                'value' => 'Companies'
                            ],
                            [
                                'name' => 'notability',
                                'required' => false,
                                'parameter' => 'Events',
                                'type' => 'checkbox',
                                'label' => 'Events: notability guideline for events',
                                'help' => '',
                                'value' => 'Events'
                            ],
                            [
                                'name' => 'notability',
                                'required' => false,
                                'parameter' => 'Films',
                                'type' => 'checkbox',
                                'label' => 'Films: notability guideline for films',
                                'help' => '',
                                'value' => 'Films'
                            ],
                            [
                                'name' => 'notability',
                                'required' => false,
                                'parameter' => 'Geographic',
                                'type' => 'checkbox',
                                'label' => 'Geographic: notability guideline for geographic features',
                                'help' => '',
                                'value' => 'Geographic'
                            ],
                            [
                                'name' => 'notability',
                                'required' => false,
                                'parameter' => 'Lists',
                                'type' => 'checkbox',
                                'label' => 'Lists: notability guideline for stand-alone lists',
                                'help' => '',
                                'value' => 'Lists'
                            ],
                            [
                                'name' => 'notability',
                                'required' => false,
                                'parameter' => 'Music',
                                'type' => 'checkbox',
                                'label' => 'Music: notability guideline for music',
                                'help' => '',
                                'value' => 'Music'
                            ],
                            [
                                'name' => 'notability',
                                'required' => false,
                                'parameter' => 'Neologisms',
                                'type' => 'checkbox',
                                'label' => 'Neologisms: notability guideline for neologisms',
                                'help' => '',
                                'value' => 'Neologisms'
                            ],
                            [
                                'name' => 'notability',
                                'required' => false,
                                'parameter' => 'Numbers',
                                'type' => 'checkbox',
                                'label' => 'Numbers: notability guideline for numbers',
                                'help' => '',
                                'value' => 'Numbers'
                            ],
                            [
                                'name' => 'notability',
                                'required' => false,
                                'parameter' => 'Products',
                                'type' => 'checkbox',
                                'label' => 'Products: notability guideline for products and services',
                                'help' => '',
                                'value' => 'Products'
                            ],
                            [
                                'name' => 'notability',
                                'required' => false,
                                'parameter' => 'Sports',
                                'type' => 'checkbox',
                                'label' => 'Sports: notability guideline for sports and athletics',
                                'help' => '',
                                'value' => 'Sports'
                            ],
                            [
                                'name' => 'notability',
                                'required' => false,
                                'parameter' => 'Television',
                                'type' => 'checkbox',
                                'label' => 'Television: notability guideline for television shows',
                                'help' => '',
                                'value' => 'Television'
                            ],
                            [
                                'name' => 'notability',
                                'required' => false,
                                'parameter' => 'Web',
                                'type' => 'checkbox',
                                'label' => 'Web: notability guideline for web content',
                                'help' => '',
                                'value' => 'Web'
                            ]
                        ]
                    ],
                    [
                        'tag' => 'Advert',
                        'description' => 'Article written like an advertisement',
                        'items' => []
                    ],
                    [
                        'tag' => 'Cleanup tense',
                        'description' => 'Article does not follow guidelines on the use of different tenses.',
                        'items' => []
                    ],
                    [
                        'tag' => 'Essay-like',
                        'description' => 'Article written like a personal reflection, personal essay, or argumentative essay',
                        'items' => []
                    ],
                    [
                        'tag' => 'Fanpov',
                        'description' => "Article written from a fan's point of view",
                        'items' => []
                    ],
                    [
                        'tag' => 'Inappropriate person',
                        'description' => 'Article uses first-person or second-person inappropriately',
                        'items' => []
                    ],
                    [
                        'tag' => 'Like resume',
                        'description' => 'Article written like a resume',
                        'items' => []
                    ],
                    [
                        'tag' => 'Manual',
                        'description' => 'Article written like a manual or guidebook',
                        'items' => []
                    ],
                    [
                        'tag' => 'Cleanup-PR',
                        'description' => 'Article reads like a press release or news article',
                        'items' => [
                            [
                                'name' => 'cleanupPR1',
                                'required' => false,
                                'parameter' => '1',
                                'type' => 'input',
                                'label' => 'Article',
                                'help' => '',
                                'value' => 'article'
                            ]
                        ]
                    ],
                    [
                        'tag' => 'Over-quotation',
                        'description' => 'Article has too many or too-lengthy quotations for an encyclopedic entry',
                        'items' => []
                    ],
                    [
                        'tag' => 'Prose',
                        'description' => 'Article is written in a list format but may read better as prose',
                        'items' => []
                    ],
                    [
                        'tag' => 'Technical',
                        'description' => 'Article is too technical for most readers to understand',
                        'items' => []
                    ],
                    [
                        'tag' => 'Tone',
                        'description' => "Article's tone or style may not reflect the encyclopedic tone used on Wikipedia",
                        'items' => []
                    ]
                ]
            ],
            [
                'label' => 'Sense (or lack thereof)',
                'tags' => [
                    [
                        'tag' => 'Confusing',
                        'description' => 'Article confusing or unclear',
                        'items' => []
                    ],
                    [
                        'tag' => 'Incomprehensible',
                        'description' => 'Article very hard to understand or incomprehensible',
                        'items' => []
                    ],
                    [
                        'tag' => 'Unfocused',
                        'description' => 'Article lacks focus or is about more than one topic',
                        'items' => []
                    ]
                ]
            ],
            [
                'label' => 'Information and detail',
                'tags' => [
                    [
                        'tag' => 'Context',
                        'description' => 'Article insufficient context for those unfamiliar with the subject',
                        'items' => []
                    ],
                    [
                        'tag' => 'Excessive examples',
                        'description' => 'Article may contain indiscriminate, excessive, or irrelevant examples',
                        'items' => []
                    ],
                    [
                        'tag' => 'Expert needed',
                        'description' => 'Article needs attention from an expert on the subject',
                        'items' => [
                            [
                                'name' => 'expertNeeded',
                                'required' => false,
                                'parameter' => '1',
                                'type' => 'input',
                                'label' => 'Name of relevant WikiProject:',
                                'help' => 'Optionally, enter the name of a WikiProject which might be able to help recruit an expert. Don\'t include the "WikiProject" prefix.',
                                'value' => '',
                                'tooltip' => ''
                            ],
                            [
                                'name' => 'expertNeededReason',
                                'required' => false,
                                'parameter' => 'reason',
                                'type' => 'input',
                                'label' => 'Reason:',
                                'help' => 'Short explanation describing the issue. Either Reason or Talk link is required.',
                                'value' => '',
                                'tooltip' => ''
                            ],
                            [
                                'name' => 'expertNeededTalk',
                                'required' => false,
                                'parameter' => 'talk',
                                'type' => 'input',
                                'label' => 'Talk discussion:',
                                'help' => "Name of the section of this article's talk page where the issue is being discussed. Do not give a link, just the name of the section. Either Reason or Talk link is required.",
                                'value' => '',
                                'tooltip' => ''
                            ]
                        ]
                    ],
                    [
                        'tag' => 'Overly detailed',
                        'description' => 'Article excessive amount of intricate detail',
                        'items' => []
                    ],
                    [
                        'tag' => 'Undue weight',
                        'description' => 'Article lends undue weight to certain ideas, incidents, or controversies',
                        'items' => []
                    ]
                ]
            ],
            [
                'label' => 'Timeliness',
                'tags' => [
                    [
                        'tag' => 'Current',
                        'description' => 'Article documents a current event',
                        'items' => []
                    ],
                    [
                        'tag' => 'Current related',
                        'description' => 'Article documents a topic affected by a current event',
                        'items' => []
                    ],
                    [
                        'tag' => 'Update',
                        'description' => 'Article needs additional up-to-date information added',
                        'items' => [
                            [
                                'name' => 'updatePart',
                                'required' => false,
                                'parameter' => 'part',
                                'type' => 'input',
                                'label' => 'What part of the article:',
                                'help' => 'Part that needs updating',
                                'value' => '',
                                'tooltip' => ''
                            ],
                            [
                                'name' => 'updateReason',
                                'required' => false,
                                'parameter' => 'reason',
                                'type' => 'input',
                                'label' => 'Reason:',
                                'help' => 'Explanation why the article is out of date',
                                'value' => '',
                                'tooltip' => ''
                            ]
                        ]
                    ]
                ]
            ],
            [
                'label' => 'Neutrality, bias, and factual accuracy',
                'tags' => [
                    [
                        'tag' => 'Autobiography',
                        'description' => 'Article is an autobiography and may not be written neutrally',
                        'items' => []
                    ],
                    [
                        'tag' => 'COI',
                        'description' => 'Article creator or major contributor may have a conflict of interest',
                        'items' => [
                            [
                                'name' => 'coiReason',
                                'required' => false,
                                'parameter' => 'source',
                                'type' => 'textarea',
                                'label' => "Explanation for COI tag (will be posted on this article's talk page):",
                                'help' => 'Optional, but strongly recommended. Leave blank if not wanted.',
                                'value' => ''
                            ]
                        ]
                    ],
                    [
                        'tag' => 'Disputed',
                        'description' => 'Article has questionable factual accuracy',
                        'items' => []
                    ],
                    [
                        'tag' => 'Hoax',
                        'description' => 'Article may partially or completely be a hoax',
                        'items' => []
                    ],
                    [
                        'tag' => 'Globalize',
                        'description' => 'Article may not represent a worldwide view of the subject',
                        'items' => [
                            [
                                'name' => 'globalize1',
                                'required' => false,
                                'parameter' => '1',
                                'type' => 'hidden',
                                'label' => '',
                                'help' => '',
                                'value' => 'article'
                            ],
                            [
                                'name' => 'globalizeRegion',
                                'required' => false,
                                'parameter' => '2',
                                'type' => 'input',
                                'label' => 'Over-represented country or region',
                                'help' => '',
                                'value' => ''
                            ]
                        ]
                    ],
                    [
                        'tag' => 'Paid contributions',
                        'description' => 'Article contains paid contributions and may therefore require cleanup',
                        'items' => []
                    ],
                    [
                        'tag' => 'Peacock',
                        'description' => 'Article contains wording that promotes the subject in a subjective manner without adding information',
                        'items' => []
                    ],
                    [
                        'tag' => 'POV',
                        'description' => 'Article does not maintain a neutral point of view',
                        'items' => []
                    ],
                    [
                        'tag' => 'Recentism',
                        'description' => 'Article is slanted towards recent events',
                        'items' => []
                    ],
                    [
                        'tag' => 'Too few opinions',
                        'description' => 'Article may not include all significant viewpoints',
                        'items' => []
                    ],
                    [
                        'tag' => 'Undisclosed paid',
                        'description' => 'Article may have been created or edited in return for undisclosed payments',
                        'items' => []
                    ],
                    [
                        'tag' => 'Weasel',
                        'description' => "Article's neutrality or verifiability is compromised by the use of weasel words",
                        'items' => []
                    ]
                ]
            ],
            [
                'label' => 'Verifiability and sources',
                'tags' => [
                    [
                        'tag' => 'BLP sources',
                        'description' => 'Article is a BLP (Biography of Living Persons) that needs additional sources for verification',
                        'items' => []
                    ],
                    [
                        'tag' => 'BLP unsourced',
                        'description' => 'Article is a BLP that has no sources at all (use BLP PROD instead for new articles)',
                        'items' => []
                    ],
                    [
                        'tag' => 'More citations needed',
                        'description' => 'Article needs additional references or sources for verification',
                        'items' => []
                    ],
                    [
                        'tag' => 'One source',
                        'description' => 'Article relies largely or entirely on a single source',
                        'items' => []
                    ],
                    [
                        'tag' => 'Original research',
                        'description' => 'Article contains original research',
                        'items' => []
                    ],
                    [
                        'tag' => 'Primary sources',
                        'description' => 'Article relies too much on references to primary sources and needs secondary sources',
                        'items' => []
                    ],
                    [
                        'tag' => 'Self-published',
                        'description' => 'Article contains excessive or inappropriate references to self-published sources',
                        'items' => []
                    ],
                    [
                        'tag' => 'Sources exist',
                        'description' => 'Article is on a notable topic, and sources are available that could be added to the article',
                        'items' => []
                    ],
                    [
                        'tag' => 'Third-party',
                        'description' => 'Article relies too heavily on sources that are too closely associated with the subject',
                        'items' => []
                    ],
                    [
                        'tag' => 'Unreferenced',
                        'description' => 'Article does not cite any sources at all',
                        'items' => []
                    ],
                    [
                        'tag' => 'Unreliable sources',
                        'description' => 'Article may have some references that are not reliable',
                        'items' => []
                    ]
                ]
            ],
            [
                'label' => 'Specific content issues',
                'tags' => [
                    [
                        'tag' => 'Not English',
                        'description' => 'Article is written in a language other than English and needs translation',
                        'items' => [
                            [
                                'name' => 'translationNotify',
                                'required' => false,
                                'parameter' => 'Notify article creator',
                                'type' => 'checkbox',
                                'label' => 'Notify article creator',
                                'help' => "Places {{uw-notenglish}} on the creator's talk page.",
                                'checked' => true,
                                'tooltip' => ''
                            ]
                        ]
                    ],
                    [
                        'tag' => 'Rough translation',
                        'description' => 'Article is a poor translation from another language',
                        'items' => []
                    ],
                    [
                        'tag' => 'Expand language',
                        'description' => 'Article should be expanded with text translated from an article in a foreign-language Wikipedia',
                        'items' => [
                            [
                                'name' => 'expandLangTopic',
                                'required' => true,
                                'parameter' => 'topic',
                                'type' => 'hidden',
                                'label' => '',
                                'help' => '',
                                'value' => ''
                            ],
                            [
                                'name' => 'expandLanguageLangCode',
                                'required' => true,
                                'parameter' => 'langcode',
                                'type' => 'input',
                                'label' => 'Language code:',
                                'help' => 'Language code of the language from which the article is to be expanded from',
                                'value' => ''
                            ],
                            [
                                'name' => 'expandLanguageArticle',
                                'required' => false,
                                'parameter' => 'otherarticle',
                                'type' => 'input',
                                'label' => 'Name of article:',
                                'help' => 'Name of the article to be expanded from, without the interwiki prefix',
                                'value' => ''
                            ]
                        ]
                    ],
                    [
                        'tag' => 'Citations missing translations',
                        'description' => 'Article citations need translation',
                        'items' => []
                    ]
                ]
            ], [
                'label' => 'Links',
                'tags' => [
                    ['tag' => 'Dead end', 'description' => 'Article has no links to other articles', 'items' => []],
                    ['tag' => 'Orphan', 'description' => 'Article linked to from no other articles', 'items' => []],
                    ['tag' => 'Overlinked', 'description' => 'Article too many duplicate and/or irrelevant links to other articles', 'items' => []],
                    ['tag' => 'Underlinked', 'description' => 'Article needs more wikilinks to other articles', 'items' => []]
                ]
            ], [
                'label' => 'Referencing technique',
                'tags' => [
                    ['tag' => 'Citation style', 'description' => 'Article unclear or inconsistent citation style', 'items' => []],
                    ['tag' => 'Cleanup bare URLs', 'description' => 'Article uses bare URLs for references, which are prone to link rot', 'items' => []],
                    ['tag' => 'More footnotes needed', 'description' => 'Article has some references, but insufficient inline citations', 'items' => []],
                    ['tag' => 'No footnotes', 'description' => 'Article has references, but lacks inline citations', 'items' => []]
                ]
            ], [
                'label' => 'Categories',
                'tags' => [
                    ['tag' => 'Improve categories', 'description' => 'Article needs additional or more specific categories', 'items' => []],
                    ['tag' => 'Uncategorized', 'description' => 'Article not added to any categories', 'items' => []]
                ]
            ], [
                'label' => 'Informational',
                'tags' => [
                    ['tag' => 'GOCEinuse', 'description' => 'Article currently undergoing a major copy edit by the Guild of Copy Editors', 'items' => []],
                    ['tag' => 'In use', 'description' => 'Article undergoing a major edit for a short while', 'items' => []],
                    ['tag' => 'Under construction', 'description' => 'Article in the process of an expansion or major restructuring', 'items' => []]
                ]
            ]
        ],
        'useMultipleIssuesTemplate' => true,
        'multipleIssuesTemplate' => 'Multiple issues',
        'uncategorizedTemplate' => 'Uncategorized',
        'apiPostSummary' => 'Page has been tagged'
    ];

    public const CONFIGURATION_MAP = [
        'deletion_propose' => self::DELETION_PROPOSE_CONFIGURATION,
        'request_page_protection' => self::REQUEST_PAGE_PROTECTION_CONFIGURATION,
        'create_speedy_deletion_request' => self::CREATE_SPEEDY_DELETION_REQUEST_CONFIGURATION,
        'request_page_move' => self::PAGE_MOVE_CONFIGURATION,
        'request_revision_deletion' => self::REVISION_DELETION_CONFIGURATION,
        'article_tagging' => self::ARTICLE_TAGGING_CONFIGURATION,
    ];
}
