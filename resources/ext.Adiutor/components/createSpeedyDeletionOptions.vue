<template>
    <cdx-message class="top-message">
        <cdx-button :action="saveButtonAction" :class="saveButtonClass" :weight="saveButtonWeight"
            @click="saveConfiguration" :disabled="saveButtonDisabled">
            {{ saveButtonLabel }}
        </cdx-button>
        <h3 style="display: initial;">{{ $i18n('adiutor-create-speedy-deletion-configuration-title') }}</h3>
        <p style="margin-top: 22px;">{{ $i18n('adiutor-create-speedy-deletion-configuration-description') }}</p>
    </cdx-message>
    <cdx-message type="warning" dismiss-button-label="Close">
        <h3>{{ $i18n('adiutor-parameters') }}</h3>
        <p>{{ $i18n('adiutor-parameters-description') }}</p>
        <ul>
            <li><strong>$1</strong>: {{ $i18n('adiutor-parameters-page-name') }}</li>
            <li><strong>$2</strong>: {{ $i18n('adiutor-parameters-reason-data') }}</li>
            <li><strong>$3</strong>: {{ $i18n('adiutor-parameters-reason-value') }}</li>
        </ul>
    </cdx-message>
    <cdx-message>
        <strong>{{ $i18n('adiutor-settings') }}</strong>
        <cdx-label input-id="speedyDeletionPolicyLink">{{ $i18n('adiutor-speedy-deletion-policy-link') }}</cdx-label>
        <cdx-text-input v-model="speedyDeletionPolicyLink" id="speedyDeletionPolicyLink"
            aria-label="{{ $i18n('adiutor-speedy-deletion-policy-link') }}"></cdx-text-input>
        <cdx-label input-id="speedyDeletionPolicyPageShortcut">{{ $i18n('adiutor-speedy-deletion-policy-page-shortcut')
        }}</cdx-label>
        <cdx-text-input v-model="speedyDeletionPolicyPageShortcut" id="speedyDeletionPolicyPageShortcut"
            aria-label="{{ $i18n('adiutor-speedy-deletion-policy-page-shortcut') }}"></cdx-text-input>
        <cdx-label input-id="csdNotificationTemplate">{{ $i18n('adiutor-csd-notification-template') }}</cdx-label>
        <cdx-text-input v-model="csdNotificationTemplate" id="csdNotificationTemplate"
            aria-label="{{ $i18n('adiutor-csd-notification-template') }}"></cdx-text-input>
        <cdx-label input-id="copyVioReasonValue">{{ $i18n('adiutor-copy-vio-reason-value') }}</cdx-label>
        <cdx-text-input v-model="copyVioReasonValue" id="copyVioReasonValue"
            aria-label="{{ $i18n('adiutor-copy-vio-reason-value') }}"></cdx-text-input>
    </cdx-message>
    <cdx-message>
        <cdx-field>
            <strong>{{ $i18n('adiutor-in-page-request-templating-configuration') }}</strong>
            <cdx-label input-id="csdTemplateStartSingleReason">{{ $i18n('adiutor-single-reason-template') }}</cdx-label>
            <cdx-text-input v-model="csdTemplateStartSingleReason" id="csdTemplateStartSingleReason"
                aria-label="{{ $i18n('adiutor-single-reason-template') }}"></cdx-text-input>
            <template #help-text>
                {{ $i18n('adiutor-single-reason-template-description') }}
            </template>
        </cdx-field>
        <cdx-field :is-fieldset="true">
            <template #label>
                {{ $i18n('adiutor-postfix-reason-usage') }}
            </template>
            <cdx-radio v-for="postfix in postfixReasonUsageRadios" :key="'radio-' + postfix.value"
                v-model="postfixReasonUsage" name="radio-group-{{postfix.value}}-descriptions" :input-value="postfix.value">
                {{ postfix.label }}
                <template #description> {{ postfix.description }}
                    <h5>{{ $i18n('adiutor-output') }}</h5>
                    <pre> {{ csdTemplateStartSingleReason }}{{ postfix.output }}</pre>
                </template>
            </cdx-radio>
        </cdx-field>
        <cdx-field>
            <cdx-label input-id="csdTemplateStartMultipleReason">{{ $i18n('adiutor-multiple-reason-template') }}</cdx-label>
            <cdx-text-input v-model="csdTemplateStartMultipleReason" id="csdTemplateStartMultipleReason"
                aria-label="{{ $i18n('adiutor-multiple-reason-template') }}"></cdx-text-input>
            <template #help-text>
                {{ $i18n('adiutor-multiple-reason-template-description') }}
            </template>
        </cdx-field>
        <cdx-field :is-fieldset="true">
            <template #label>
                {{ $i18n('adiutor-multiple-reason-separation') }}
            </template>
            <cdx-radio v-for="separator in multipleReasonSeparationRadios" :key="'radio-' + separator.value"
                v-model="multipleReasonSeparation" name="radio-group-{{separator.value}}-descriptions"
                :input-value="separator.value">
                {{ separator.label }}
                <template #description> {{ separator.description }}
                    <h5>{{ $i18n('adiutor-output') }}</h5>
                    <pre> {{ csdTemplateStartMultipleReason }}{{ separator.output }}</pre>
                </template>
            </cdx-radio>
        </cdx-field>
    </cdx-message>
    <cdx-message>
        <cdx-field>
            <strong>{{ $i18n('adiutor-summaries') }}</strong>
            <cdx-label input-id="singleReasonSummary">{{ $i18n('adiutor-single-reason-summary') }}</cdx-label>
            <cdx-text-input v-model="singleReasonSummary" id="singleReasonSummary"
                aria-label="{{ $i18n('adiutor-single-reason-summary') }}"></cdx-text-input>
            <cdx-label input-id="multipleReasonSummary">{{ $i18n('adiutor-multiple-reason-summary') }}</cdx-label>
            <cdx-text-input v-model="multipleReasonSummary" id="multipleReasonSummary"
                aria-label="{{ $i18n('adiutor-multiple-reason-summary') }}"></cdx-text-input>
            <cdx-label input-id="apiPostSummaryforTalkPage">{{ $i18n('adiutor-api-post-summary-for-talk-page')
            }}</cdx-label>
            <cdx-text-input v-model="apiPostSummaryforTalkPage" id="apiPostSummaryforTalkPage"
                aria-label="{{ $i18n('adiutor-api-post-summary-for-talk-page') }}"></cdx-text-input>
            <cdx-label input-id="apiPostSummaryforLog">{{ $i18n('adiutor-api-post-summary-for-log') }}</cdx-label>
            <cdx-text-input v-model="apiPostSummaryforLog" id="apiPostSummaryforLog"
                aria-label="{{ $i18n('adiutor-api-post-summary-for-log') }}"></cdx-text-input>
        </cdx-field>
    </cdx-message>
    <cdx-field>
        <table width="100%" id="adiutor-options-props">
            <caption>
                {{ $i18n('adiutor-speedy-deletion-reasons') }} <cdx-button class="add-new-button" weight="quiet"
                    @click="addNewNameSpace">{{ $i18n('adiutor-add-new') }}</cdx-button>
            </caption>
            <tr>
                <th>{{ $i18n('adiutor-name-space') }}</th>
                <th>{{ $i18n('adiutor-name') }}</th>
                <th>{{ $i18n('adiutor-action') }}</th>
            </tr>
            <tr v-for="(reasonNamespace, index) in speedyDeletionReasons" :key="index">
                <td><cdx-text-input v-model="reasonNamespace.namespace" aria-label="{{ $i18n('adiutor-name-space') }}"
                        :disabled="isNamespaceDisabled(reasonNamespace)"></cdx-text-input></td>
                <td><cdx-text-input v-model="reasonNamespace.name"
                        aria-label="{{ $i18n('adiutor-name') }}"></cdx-text-input></td>
                <td><cdx-button action="destructive" @click="deleteNameSpace(reasonNamespace)"
                        :disabled="isNamespaceDisabled(reasonNamespace)">{{ $i18n('adiutor-delete') }}</cdx-button></td>
            </tr>
        </table>
    </cdx-field>
    <cdx-field v-for="(reasonNamespace, namespaceIndex) in speedyDeletionReasons" :key="'nestedTable-' + namespaceIndex">
        <table width="100%" id="adiutor-options-props">
            <caption>
                {{ $i18n('adiutor-deletion-reasons-for') }} {{ reasonNamespace.name }}
                <cdx-button class="add-new-button" weight="quiet" @click="addNewReason(namespaceIndex)">{{
                    $i18n('adiutor-add-new') }}</cdx-button>
            </caption>
            <tr>
                <th>{{ $i18n('adiutor-value') }}</th>
                <th>{{ $i18n('adiutor-data') }}</th>
                <th>{{ $i18n('adiutor-label') }}</th>
                <th>{{ $i18n('adiutor-help') }}</th>
                <th>{{ $i18n('adiutor-action') }}</th>
            </tr>
            <tr v-for="(reason, reasonIndex) in reasonNamespace.reasons" :key="'reason-' + reasonIndex">
                <td><cdx-text-input style="min-width: 50px;" v-model="reason.value"
                        aria-label="{{ $i18n('adiutor-value') }}"></cdx-text-input></td>
                <td><cdx-text-input v-model="reason.data" aria-label="{{ $i18n('adiutor-data') }}"></cdx-text-input></td>
                <td><cdx-text-input v-model="reason.label" aria-label="{{ $i18n('adiutor-label') }}"></cdx-text-input></td>
                <td><cdx-text-input v-model="reason.help" aria-label="{{ $i18n('adiutor-help') }}"></cdx-text-input></td>
                <td><cdx-button action="destructive" @click="deleteReason(namespaceIndex, reasonIndex)">{{
                    $i18n('adiutor-delete') }}</cdx-button></td>
            </tr>
        </table>
    </cdx-field>
</template>
<script>
const { defineComponent, ref } = require('vue');
const { CdxCard, CdxCombobox, CdxTabs, CdxTab, CdxMessage, CdxTextInput, CdxCheckbox, CdxField, CdxRadio, CdxTextArea, CdxButton } = require('@wikimedia/codex');
const csdConfiguration = mw.config.get('AdiutorCreateSpeedyDeletion');
module.exports = defineComponent({
    name: '',
    components: {
        CdxCard,
        CdxCombobox,
        CdxTextInput,
        CdxTabs,
        CdxTab,
        CdxMessage,
        CdxCheckbox,
        CdxField,
        CdxRadio, CdxTextArea, CdxButton
    },
    props: {
        framed: {
            type: Boolean,
            default: false
        }
    },
    setup() {
        const speedyDeletionReasons = ref(csdConfiguration.speedyDeletionReasons);
        const csdTemplateStartSingleReason = ref(csdConfiguration.csdTemplateStartSingleReason);
        const csdTemplateStartMultipleReason = ref(csdConfiguration.csdTemplateStartMultipleReason);
        const speedyDeletionPolicyLink = ref(csdConfiguration.speedyDeletionPolicyLink);
        const speedyDeletionPolicyPageShortcut = ref(csdConfiguration.speedyDeletionPolicyPageShortcut);
        const apiPostSummaryforTalkPage = ref(csdConfiguration.apiPostSummaryforTalkPage);
        const apiPostSummaryforLog = ref(csdConfiguration.apiPostSummaryforLog);
        const csdNotificationTemplate = ref(csdConfiguration.csdNotificationTemplate);
        const singleReasonSummary = ref(csdConfiguration.singleReasonSummary);
        const multipleReasonSummary = ref(csdConfiguration.multipleReasonSummary);
        const copyVioReasonValue = ref(csdConfiguration.copyVioReasonValue);
        const postfixReasonUsage = ref(csdConfiguration.postfixReasonUsage);
        const postfixReasonUsageRadios = [
            {
                label: mw.message('adiutor-csd-use-reason-value').text(),
                description: mw.message('adiutor-csd-use-reason-value-description').text(),
                value: 'value',
                parameter: '$3',
                output: 'A1}}',
            },
            {
                label: mw.message('adiutor-csd-use-reason-data').text(),
                description: mw.message('adiutor-csd-use-reason-data-description').text(),
                value: 'data',
                parameter: '$2',
                output: '[[WP:CSD#A1|A1]]: Short article without enough context to identify the subject}}',
            }
        ];
        const multipleReasonSeparation = ref(csdConfiguration.multipleReasonSeparation);
        const multipleReasonSeparationRadios = [
            {
                label: mw.message('adiutor-csd-use-vertical-bar').text(),
                description: mw.message('adiutor-csd-use-vertical-bar-description').text(),
                value: 'vertical_bar',
                parameter: '$3',
                output: '|A1|G1}}',
            },
            {
                label: mw.message('adiutor-csd-default').text(),
                description: mw.message('adiutor-csd-default-description').text(),
                description: 'When activated, reasons within the speedy deletion template are separated by "and".',
                value: 'default',
                parameter: '$2',
                output: '[[WP:CSD#A1]] and [[WP:CSD#G1]]}}',
            }
        ];

        return {
            speedyDeletionReasons,
            csdTemplateStartSingleReason,
            csdTemplateStartMultipleReason,
            speedyDeletionPolicyLink,
            speedyDeletionPolicyPageShortcut,
            apiPostSummaryforTalkPage,
            apiPostSummaryforLog,
            csdNotificationTemplate,
            singleReasonSummary,
            multipleReasonSummary,
            copyVioReasonValue,
            postfixReasonUsage,
            postfixReasonUsageRadios,
            multipleReasonSeparation,
            multipleReasonSeparationRadios
        };
    },
    data() {
        return {
            saveButtonLabel: mw.message('adiutor-save-configurations').text(),
            saveButtonAction: 'progressive',
            saveButtonClass: 'save-button',
            saveButtonWeight: 'primary',
            saveButtonDisabled: false,
        };
    },
    methods: {

        isNamespaceDisabled(reasonNamespace) {
            const disabledNamespaces = ["general", "redirect", "other"];
            return disabledNamespaces.includes(reasonNamespace.namespace);
        },

        addNewNameSpace() {
            const newNameSpace = {
                name: '',
                namespace: '',
                items: []
            };
            this.speedyDeletionReasons.push(newNameSpace);
        },

        deleteNameSpace(namespace) {
            const index = this.speedyDeletionReasons.indexOf(namespace);
            if (index !== -1) {
                this.speedyDeletionReasons.splice(index, 1);
            }
        },

        addNewReason(namespaceIndex) {
            // Find the namespace based on the provided namespaceIndex
            const reasonNamespace = this.speedyDeletionReasons[namespaceIndex];

            if (reasonNamespace) {
                const newReason = {
                    namespace: reasonNamespace.namespace,
                    value: '',
                    data: '',
                    selected: false,
                    label: '',
                    help: '',
                };
                reasonNamespace.reasons.push(newReason);
            }
        },

        deleteReason(namespaceIndex, reasonIndex) {
            // Find the namespace based on the provided namespaceIndex
            const reasonNamespace = this.speedyDeletionReasons[namespaceIndex];

            // Check if the reasonNamespace and the reason exist (a safety check)
            if (reasonNamespace && reasonNamespace.reasons[reasonIndex]) {
                // Use splice to remove the reason at the specified reasonIndex
                reasonNamespace.reasons.splice(reasonIndex, 1);
            }
        },

        async saveConfiguration() {
            // Change the button label and disable it during the save operation
            this.saveButtonLabel = mw.message('adiutor-configurations-saving').text();
            this.saveButtonAction = 'default';
            this.saveButtonDisabled = true;

            // Prepare the data to be sent in the HTTP request
            const data = {
                title: 'MediaWiki:AdiutorCreateSpeedyDeletion.json',
                content: {
                    "speedyDeletionReasons": this.speedyDeletionReasons,
                    "csdTemplateStartSingleReason": this.csdTemplateStartSingleReason,
                    "csdTemplateStartMultipleReason": this.csdTemplateStartMultipleReason,
                    "postfixReasonUsage": this.postfixReasonUsage,
                    "multipleReasonSeparation": this.multipleReasonSeparation,
                    "speedyDeletionPolicyLink": this.speedyDeletionPolicyLink,
                    "speedyDeletionPolicyPageShortcut": this.speedyDeletionPolicyPageShortcut,
                    "apiPostSummaryforTalkPage": this.apiPostSummaryforTalkPage,
                    "apiPostSummaryforLog": this.apiPostSummaryforLog,
                    "csdNotificationTemplate": this.csdNotificationTemplate,
                    "singleReasonSummary": this.singleReasonSummary,
                    "multipleReasonSummary": this.multipleReasonSummary,
                    "copyVioReasonValue": this.copyVioReasonValue,
                }
            };

            // Define the API endpoint URL
            const apiUrl = '/mediawiki/rest.php/adiutor/v0/updatelocalconfiguration';

            try {
                // Send a POST request to the API with the data
                const response = await fetch(apiUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data),
                });

                if (!response.ok) {
                    // Handle HTTP error if the response status is not OK
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                // Parse the response data as JSON
                const responseData = await response.json();

                if (responseData.status === 'success') {
                    // Display a success notification if the update was successful
                    mw.notify(mw.message('adiutor-localization-settings-has-been-updated').text(), {
                        title: mw.msg('adiutor-operation-completed'),
                        type: 'success'
                    });
                    // Revert the button label and enable it after a delay (2 seconds)
                    this.saveButtonLabel = mw.message('adiutor-save-configurations').text();
                    this.saveButtonAction = 'progressive';
                    this.saveButtonDisabled = false;
                } else {
                    // Log an error message if the update was not successful
                    console.error('Error updating configuration');
                    this.saveButtonLabel = mw.message('adiutor-try-again').text();
                    this.saveButtonAction = 'destructive';
                    this.saveButtonDisabled = false;
                }
            } catch (error) {
                // Handle any fetch-related errors and log them
                console.error('Fetch error:', error);
            }
        }

    },
});
</script>
<style lang="less">
cdx-label {
    font-weight: 900;
    margin-top: 10px;
    display: block;
}

.cdx-field {
    margin-top: 10px;
    display: block;
}

.top-message {
    margin-top: 10px;
}
</style>