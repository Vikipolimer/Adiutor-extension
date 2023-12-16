<template>
    <cdx-message class="top-message">
        <cdx-button :action="saveButtonAction" :class="saveButtonClass" :weight="saveButtonWeight"
            @click="saveConfiguration" :disabled="saveButtonDisabled">
            {{ saveButtonLabel }}
        </cdx-button>
        <h3 style="display: initial;">{{ $i18n('adiutor-proposed-deletion-configuration') }}</h3>
        <p style="margin-top: 22px;">{{ $i18n('adiutor-proposed-deletion-description') }}</p>
    </cdx-message>
    <cdx-message type="warning" dismiss-button-label="{{ $i18n('adiutor-close') }}">
        <h3>{{ $i18n('adiutor-parameters') }}</h3>
        <p>{{ $i18n('adiutor-parameters-description') }}</p>
        <ul>
            <li><strong>$1</strong>: {{ $i18n('adiutor-parameters-page-name') }}</li>
            <li><strong>$2</strong>: {{ $i18n('adiutor-parameters-rationale') }}</li>
            <li><strong>$3</strong>: {{ $i18n('adiutor-parameters-day') }}</li>
            <li><strong>$4</strong>: {{ $i18n('adiutor-parameters-month') }}</li>
            <li><strong>$5</strong>: {{ $i18n('adiutor-parameters-year') }}</li>
            <li><strong>$6</strong>: {{ $i18n('adiutor-parameters-requester') }}</li>
        </ul>
    </cdx-message>
    <cdx-message>
        <strong>{{ $i18n('adiutor-settings') }}</strong>
        <cdx-label input-id="prodNotificationTemplate">{{ $i18n('adiutor-prod-notification-template') }}</cdx-label>
        <cdx-text-input v-model="prodNotificationTemplate" id="prodNotificationTemplate"
            aria-label="{{ $i18n('adiutor-prod-notification-template') }}"></cdx-text-input>
    </cdx-message>
    <cdx-message>
        <cdx-field>
            <strong>{{ $i18n('adiutor-in-page-request-templating-configuration') }}</strong>
            <cdx-label input-id="standardProposeTemplate">{{ $i18n('adiutor-proposed-deletion-template') }}</cdx-label>
            <cdx-text-input v-model="standardProposeTemplate" id="standardProposeTemplate"
                aria-label="{{ $i18n('adiutor-proposed-deletion-template') }}"></cdx-text-input>
            <template #help-text>
                {{ $i18n('adiutor-proposed-deletion-template-description') }}
            </template>
        </cdx-field>
        <cdx-field>
            <cdx-label input-id="livingPersonProposeTemplate">{{ $i18n('adiutor-proposed-deletion-blps-template') }}</cdx-label>
            <cdx-text-input v-model="livingPersonProposeTemplate" id="livingPersonProposeTemplate"
                aria-label="{{ $i18n('adiutor-proposed-deletion-blps-template') }}"></cdx-text-input>
            <template #help-text>
                {{ $i18n('adiutor-proposed-deletion-blps-template-description') }}
            </template>
        </cdx-field>
    </cdx-message>
    <cdx-message>
        <cdx-field>
            <strong>{{ $i18n('adiutor-summaries') }}</strong>
            <cdx-label input-id="apiPostSummaryforLog">{{ $i18n('adiutor-api-post-summary-for-log') }}</cdx-label>
            <cdx-text-input v-model="apiPostSummaryforLog" id="apiPostSummaryforLog"
                aria-label="{{ $i18n('adiutor-api-post-summary-for-log') }}"></cdx-text-input>
            <cdx-label input-id="apiPostSummary">{{ $i18n('adiutor-api-post-summary') }}</cdx-label>
            <cdx-text-input v-model="apiPostSummary" id="apiPostSummary"
                aria-label="{{ $i18n('adiutor-api-post-summary-for-talk-page') }}"></cdx-text-input>
            <cdx-label input-id="apiPostSummaryforCreator">{{ $i18n('adiutor-api-post-summary-for-creator') }}</cdx-label>
            <cdx-text-input v-model="apiPostSummaryforCreator" id="apiPostSummaryforCreator"
                aria-label="{{ $i18n('adiutor-api-post-summary-for-creator') }}"></cdx-text-input>
        </cdx-field>
    </cdx-message>
</template>
<script>
const { defineComponent, watch, ref, computed } = require('vue');
const { CdxCard, CdxCombobox, CdxTabs, CdxTab, CdxMessage, CdxTextInput, CdxCheckbox, CdxField, CdxRadio, CdxTextArea, CdxButton } = require('@wikimedia/codex');
const dprConfiguration = mw.config.get('AdiutorDeletionPropose');
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
        const standardProposeTemplate = ref(dprConfiguration.standardProposeTemplate);
        const livingPersonProposeTemplate = ref(dprConfiguration.livingPersonProposeTemplate);
        const apiPostSummary = ref(dprConfiguration.apiPostSummary);
        const apiPostSummaryforCreator = ref(dprConfiguration.apiPostSummaryforCreator);
        const prodNotificationTemplate = ref(dprConfiguration.prodNotificationTemplate);
        const apiPostSummaryforLog = ref(dprConfiguration.apiPostSummaryforLog);

        return {
            standardProposeTemplate,
            livingPersonProposeTemplate,
            apiPostSummary,
            apiPostSummaryforCreator,
            prodNotificationTemplate,
            apiPostSummaryforLog,

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

        async saveConfiguration() {
            // Change the button label and disable it during the save operation
            this.saveButtonLabel = mw.message('adiutor-configurations-saving').text();
            this.saveButtonAction = 'default';
            this.saveButtonDisabled = true;

            // Prepare the data to be sent in the HTTP request
            const data = {
                title: 'MediaWiki:AdiutorDeletionPropose.json',
                content: {
                    "standardProposeTemplate": this.standardProposeTemplate,
                    "livingPersonProposeTemplate": this.livingPersonProposeTemplate,
                    "apiPostSummary": this.apiPostSummary,
                    "apiPostSummaryforCreator": this.apiPostSummaryforCreator,
                    "prodNotificationTemplate": this.prodNotificationTemplate,
                    "apiPostSummaryforLog": this.apiPostSummaryforLog,
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
                    this.saveButtonLabel = mw.message('adiutor-configurations-saving').text();
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