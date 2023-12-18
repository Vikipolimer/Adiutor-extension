<template>
    <cdx-field class="top-message">
        <cdx-button :action="saveButtonAction" :class="saveButtonClass" :weight="saveButtonWeight"
            @click="saveConfiguration" :disabled="saveButtonDisabled">
            {{ saveButtonLabel }}
        </cdx-button>
        <h3 style="display: initial;">{{ $i18n('adiutor-request-page-move-configuration') }}</h3>
        <p style="margin-top: 22px;">{{ $i18n('adiutor-request-page-move-description') }}</p>
    </cdx-field>
    <cdx-message type="warning" dismiss-button-label="{{ $i18n('adiutor-close') }}">
        <h3>{{ $i18n('adiutor-parameters') }}</h3>
        <p>{{ $i18n('adiutor-parameters-description') }}</p>
        <ul>
            <li><strong>$1</strong>: {{ $i18n('adiutor-parameters-page-name') }}</li>
            <li><strong>$2</strong>: {{ $i18n('adiutor-parameters-new-page-name') }}</li>
            <li><strong>$3</strong>: {{ $i18n('adiutor-parameters-rationale') }}</li>
        </ul>
    </cdx-message>
    <cdx-field>
        <strong>{{ $i18n('adiutor-settings-label') }}</strong>
        <cdx-field :is-fieldset="true">
            <cdx-toggle-switch v-model="moduleEnabled">
                <cdx-label input-id="moduleEnabled">{{ $i18n('adiutor-module-enabled') }}</cdx-label>
                <template #description>
                    {{ $i18n('adiutor-module-enabled-description') }}
                </template>
            </cdx-toggle-switch>
        </cdx-field>
        <cdx-field :is-fieldset="true">
            <cdx-label input-id="noticeBoardTitle">{{ $i18n('adiutor-noticeboard') }}</cdx-label>
            <cdx-text-input v-model="noticeBoardTitle" id="noticeBoardTitle"
                aria-label="{{ $i18n('adiutor-noticeboard') }}"></cdx-text-input>
        </cdx-field>
        <cdx-field :is-fieldset="true">
            <cdx-label input-id="contentPattern">{{ $i18n('adiutor-content-pattern') }}</cdx-label>
            <cdx-text-area v-model="contentPattern" id="contentPattern"
                aria-label="{{ $i18n('adiutor-content-pattern') }}"></cdx-text-area>
            <template #help-text>
                {{ $i18n('adiutor-content-pattern-description') }}
            </template>
        </cdx-field>
        <cdx-field :is-fieldset="true">
            <cdx-toggle-switch v-model="addNewSection">
                <cdx-label input-id="addNewSection">{{ $i18n('adiutor-create-new-section') }}</cdx-label>
                <template #description>
                    {{ $i18n('adiutor-new-section-description') }}
                </template>
            </cdx-toggle-switch>
        </cdx-field>
        <cdx-field :is-fieldset="true" v-if="addNewSection">
            <cdx-label input-id="sectionTitle">{{ $i18n('adiutor-new-section-title') }}</cdx-label>
            <cdx-text-input v-model="sectionTitle" id="sectionTitle"
                aria-label="{{ $i18n('adiutor-new-section-title') }}"></cdx-text-input>
        </cdx-field>
        <cdx-field :is-fieldset="true" v-if="!addNewSection">
            <cdx-toggle-switch v-model="useExistSection">
                <cdx-label input-id="useExistSection">{{ $i18n('adiutor-use-exist-section') }}</cdx-label>
                <template #description>
                    {{ $i18n('adiutor-use-exist-section-description') }}
                </template>
            </cdx-toggle-switch>
        </cdx-field>
        <cdx-field :is-fieldset="true" v-if="useExistSection">
            <cdx-label input-id="sectionId">{{ $i18n('adiutor-section-id') }}</cdx-label>
            <cdx-text-input v-model="sectionId" id="sectionId"
                aria-label="{{ $i18n('adiutor-section-id') }}"></cdx-text-input>
            <template #help-text>
                {{ $i18n('adiutor-section-id-description') }}
            </template>
        </cdx-field>
        <cdx-field :is-fieldset="true">
            <template #description v-if="!addNewSection && !useExistSection">
                {{ $i18n('adiutor-no-section-description') }}
            </template>
            <template #label>
                {{ $i18n('adiutor-text-modification-direction') }}
            </template>
            <cdx-radio v-for="direction in textModificationDirectionRadios" :key="'rpm-radio-' + direction.value"
                v-model="textModificationDirection" name="rpm-radio-group-{{direction.value}}-descriptions"
                :input-value="direction.value">
                {{ direction.label }}
                <template #description> {{ direction.description }} </template>
            </cdx-radio>
        </cdx-field>
    </cdx-field>
    <cdx-field>
        <cdx-field>
            <strong>{{ $i18n('adiutor-summaries') }}</strong>
            <cdx-label input-id="apiPostSummary">{{ $i18n('adiutor-api-post-summary') }}</cdx-label>
            <cdx-text-input v-model="apiPostSummary" id="apiPostSummary"
                aria-label="{{ $i18n('adiutor-api-post-summary') }}"></cdx-text-input>
        </cdx-field>
    </cdx-field>
</template>
<script>
const { defineComponent, watch, ref, computed } = require('vue');
const { CdxCard, CdxCombobox, CdxTabs, CdxTab, CdxMessage, CdxTextInput, CdxToggleSwitch, CdxButton, CdxCheckbox, CdxField, CdxRadio, CdxTextArea } = require('@wikimedia/codex');
const rpmConfiguration = mw.config.get('AdiutorRequestPageMove');
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
        CdxToggleSwitch,
        CdxField, CdxButton,
        CdxRadio, CdxTextArea
    },
    props: {
        framed: {
            type: Boolean,
            default: false
        }
    },
    setup() {
        const noticeBoardTitle = ref(rpmConfiguration.noticeBoardTitle);
        const addNewSection = ref(rpmConfiguration.addNewSection);
        const useExistSection = ref(rpmConfiguration.useExistSection);
        const sectionTitle = ref(rpmConfiguration.sectionTitle);
        const sectionId = ref(rpmConfiguration.sectionId);
        const contentPattern = ref(rpmConfiguration.contentPattern);
        const apiPostSummary = ref(rpmConfiguration.apiPostSummary);
        const textModificationDirection = ref(rpmConfiguration.textModificationDirection);
        const moduleEnabled = ref(rpmConfiguration.moduleEnabled);
        const textModificationDirectionRadios = [
            {
                label: mw.message('adiutor-prepend-text-on-the-page').text(),
                description: mw.message('adiutor-prepend-text-on-the-page-description').text(),
                value: 'prependtext',
            }, {
                label: mw.message('adiutor-append-text-on-the-page').text(),
                description: mw.message('adiutor-append-text-on-the-page-description').text(),
                value: 'appendtext',
            }
        ];

        return {
            noticeBoardTitle,
            addNewSection,
            useExistSection,
            sectionTitle,
            sectionId,
            contentPattern,
            textModificationDirection,
            apiPostSummary,
            textModificationDirectionRadios,
            moduleEnabled
        };
    },
    data() {
        return {
            // Add properties for controlling button appearance
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
                title: 'MediaWiki:AdiutorRequestPageMove.json',
                content: {
                    "noticeBoardTitle": this.noticeBoardTitle,
                    "addNewSection": this.addNewSection,
                    "sectionTitle": this.sectionTitle,
                    "useExistSection": this.useExistSection,
                    "sectionId": this.sectionId,
                    "textModificationDirection": this.textModificationDirection,
                    "contentPattern": this.contentPattern,
                    "apiPostSummary": this.apiPostSummary,
                    "moduleEnabled": this.moduleEnabled
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

.cdx-toggle-switch {
    justify-content: space-between;
    display: flex;
}

.cdx-field {
    margin-top: 10px;
    display: block;
}

.top-message {
    margin-top: 10px;
}

.save-button {
    float: right;
}
</style>