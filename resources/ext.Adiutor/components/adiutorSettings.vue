<template>
    <cdx-tabs v-model:active="currentTab" :framed="framed">
        <cdx-tab v-for="(tab, index) in tabsData" :key="index" :name="tab.name" :label="tab.label">
            <component :is="tab.component"></component>
        </cdx-tab>
    </cdx-tabs>
</template>
<script>
const { defineComponent } = require('vue');
const { CdxTabs, CdxTab } = require('@wikimedia/codex');
const createSpeedyDeletionOptions = require('./createSpeedyDeletionOptions.vue');
const requestPageProtectionOptions = require('./requestPageProtectionOptions.vue');
const requestPageMoveOptions = require('./requestPageMoveOptions.vue');
const deletionProposeOptions = require('./deletionProposeOptions.vue');
const articleTaggingOptions = require('./articleTaggingOptions.vue');
module.exports = defineComponent({
    name: 'adiutorSettings',
    components: {
        CdxTabs,
        CdxTab,
        createSpeedyDeletionOptions,
        requestPageProtectionOptions
    },
    props: {
        framed: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            tabsData: [{
                name: 'csd',
                label: mw.msg('adiutor-create-speedy-deletion'),
                component: createSpeedyDeletionOptions
            }, {
                name: 'rpp',
                label: mw.msg('adiutor-request-page-protection'),
                component: requestPageProtectionOptions
            }, {
                name: 'rpm',
                label: mw.msg('adiutor-request-page-move'),
                component: requestPageMoveOptions
            }, {
                name: 'dpr',
                label: mw.msg('adiutor-proposed-deletion'),
                component: deletionProposeOptions
            }, {
                name: 'tag',
                label: mw.msg('adiutor-article-tagging'),
                component: articleTaggingOptions
            }],
            currentTab: 'csd'
        };
    }
});
</script>