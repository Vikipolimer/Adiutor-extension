var api = new mw.Api();
var adiutorUserOptions = JSON.parse(mw.user.options.get('userjs-adiutor-extension'));
if(!adiutorUserOptions.hasOwnProperty('myCustomSummaries')) {
	adiutorUserOptions.myCustomSummaries = [];
}

function adiutorOptionsDialog(config) {
	adiutorOptionsDialog.super.call(this, config);
}
OO.inheritClass(adiutorOptionsDialog, OO.ui.ProcessDialog);
adiutorOptionsDialog.static.name = 'adiutorOptionsDialog';
adiutorOptionsDialog.static.title = new OO.ui.deferMsg('opt-module-title');
adiutorOptionsDialog.static.actions = [{
	action: 'save',
	label: new OO.ui.deferMsg('update'),
	flags: ['primary', 'progressive']
}, {
	label: new OO.ui.deferMsg('cancel'),
	flags: 'safe'
}];
adiutorOptionsDialog.prototype.initialize = function() {
	adiutorOptionsDialog.super.prototype.initialize.apply(this, arguments);
	this.content = new OO.ui.PanelLayout({
		padded: true,
		expanded: false
	});
	adiutorSettings = new OO.ui.FieldsetLayout({
		label: new OO.ui.deferMsg('options')
	});
	adiutorSettings.addItems([
		csdSendMessageToCreator = new OO.ui.FieldLayout(new OO.ui.CheckboxInputWidget({
			selected: adiutorUserOptions.speedyDeletion.csdSendMessageToCreator
		}), {
			align: 'inline',
			label: new OO.ui.deferMsg('csd-send-message-to-creator'),
			help: new OO.ui.deferMsg('description')
		}),
		afdSendMessageToCreator = new OO.ui.FieldLayout(new OO.ui.CheckboxInputWidget({
			selected: adiutorUserOptions.articlesForDeletion.afdSendMessageToCreator
		}), {
			align: 'inline',
			label: new OO.ui.deferMsg('afd-send-message-to-creator'),
			help: new OO.ui.deferMsg('description')
		}),
		prdSendMessageToCreator = new OO.ui.FieldLayout(new OO.ui.CheckboxInputWidget({
			selected: adiutorUserOptions.proposedDeletion.prdSendMessageToCreator
		}), {
			align: 'inline',
			label: new OO.ui.deferMsg('prd-send-message-to-creator'),
			help: new OO.ui.deferMsg('description')
		}),
		csdLogNominatedPages = new OO.ui.FieldLayout(new OO.ui.CheckboxInputWidget({
			selected: adiutorUserOptions.speedyDeletion.csdLogNominatedPages
		}), {
			align: 'inline',
			label: new OO.ui.deferMsg('csd-log-nominated-pages'),
			help: new OO.ui.deferMsg('description')
		}),
		csdLogPageName = new OO.ui.FieldLayout(new OO.ui.TextInputWidget({
			value: adiutorUserOptions.speedyDeletion.csdLogPageName
		}), {
			label: new OO.ui.deferMsg('csd-log-page-name'),
			help: new OO.ui.deferMsg('description')
		}),
		afdLogNominatedPages = new OO.ui.FieldLayout(new OO.ui.CheckboxInputWidget({
			selected: adiutorUserOptions.articlesForDeletion.afdLogNominatedPages
		}), {
			align: 'inline',
			label: new OO.ui.deferMsg('afd-log-nominated-pages'),
			help: new OO.ui.deferMsg('description')
		}),
		afdLogPageName = new OO.ui.FieldLayout(new OO.ui.TextInputWidget({
			value: adiutorUserOptions.articlesForDeletion.afdLogPageName
		}), {
			label: new OO.ui.deferMsg('afd-log-page-name'),
			help: new OO.ui.deferMsg('description')
		}),
		prdLogNominatedPages = new OO.ui.FieldLayout(new OO.ui.CheckboxInputWidget({
			selected: adiutorUserOptions.proposedDeletion.prdLogNominatedPages
		}), {
			align: 'inline',
			label: new OO.ui.deferMsg('prd-log-nominated-pages'),
			help: new OO.ui.deferMsg('description')
		}),
		prdLogPageName = new OO.ui.FieldLayout(new OO.ui.TextInputWidget({
			value: adiutorUserOptions.proposedDeletion.prdLogPageName
		}), {
			label: new OO.ui.deferMsg('prd-log-page-name'),
			help: new OO.ui.deferMsg('description')
		}),
		afdNominateOpinionsLog = new OO.ui.FieldLayout(new OO.ui.CheckboxInputWidget({
			selected: adiutorUserOptions.articlesForDeletion.afdNominateOpinionsLog
		}), {
			align: 'inline',
			label: new OO.ui.deferMsg('afd-nominate-opinions-log'),
			help: new OO.ui.deferMsg('description')
		}),
		afdOpinionLogPageName = new OO.ui.FieldLayout(new OO.ui.TextInputWidget({
			value: adiutorUserOptions.articlesForDeletion.afdOpinionLogPageName
		}), {
			label: new OO.ui.deferMsg('afd-opinion-log-page-name'),
			help: new OO.ui.deferMsg('description')
		}),
		showMyStatus = new OO.ui.FieldLayout(new OO.ui.CheckboxInputWidget({
			selected: adiutorUserOptions.status.showMyStatus
		}), {
			align: 'inline',
			label: new OO.ui.deferMsg('show-my-status'),
			help: new OO.ui.deferMsg('show-status-description')
		}),
		inlinePageInfo = new OO.ui.FieldLayout(new OO.ui.CheckboxInputWidget({
			selected: adiutorUserOptions.inlinePageInfo
		}), {
			align: 'inline',
			label: new OO.ui.deferMsg('show-inline-page-info'),
			help: new OO.ui.deferMsg('show-inline-page-info-description')
		}),
		showEditSummaries = new OO.ui.FieldLayout(new OO.ui.CheckboxInputWidget({
			selected: adiutorUserOptions.showEditSummaries
		}), {
			align: 'inline',
			label: new OO.ui.deferMsg('use-pre-defined-edit-summaries'),
			help: new OO.ui.deferMsg('use-pre-defined-edit-summaries-help'),
		}),
		myCustomSummaries = new OO.ui.FieldLayout(new OO.ui.MultilineTextInputWidget({
			value: adiutorUserOptions.myCustomSummaries.join('\n'),
			rows: 5, // Set the number of rows as needed
			placeholder: new OO.ui.deferMsg('frequently-used-edit-summaries-placeholder'),
		}), {
			align: 'inline',
			label: new OO.ui.deferMsg('frequently-used-edit-summaries'),
			help: new OO.ui.deferMsg('frequently-used-edit-summaries-help'),
		}),
	]);
	this.content.$element.append(adiutorSettings.$element);
	this.$body.append(this.content.$element);
};
adiutorOptionsDialog.prototype.getActionProcess = function(action) {
	var dialog = this;
	if(action) {
		return new OO.ui.Process(function() {
			UpdatedOptions = {
				"myWorks": adiutorUserOptions.myWorks,
				"myCustomSummaries": myCustomSummaries.fieldWidget.getValue().split('\n'),
				"speedyDeletion": {
					"csdSendMessageToCreator": csdSendMessageToCreator.fieldWidget.selected,
					"csdLogNominatedPages": csdLogNominatedPages.fieldWidget.selected,
					"csdLogPageName": csdLogPageName.fieldWidget.value
				},
				"articlesForDeletion": {
					"afdSendMessageToCreator": afdSendMessageToCreator.fieldWidget.selected,
					"afdLogNominatedPages": afdLogNominatedPages.fieldWidget.selected,
					"afdLogPageName": afdLogPageName.fieldWidget.value,
					"afdNominateOpinionsLog": afdNominateOpinionsLog.fieldWidget.selected,
					"afdOpinionLogPageName": afdOpinionLogPageName.fieldWidget.value
				},
				"proposedDeletion": {
					"prdSendMessageToCreator": prdSendMessageToCreator.fieldWidget.selected,
					"prdLogNominatedPages": prdLogNominatedPages.fieldWidget.selected,
					"prdLogPageName": prdLogPageName.fieldWidget.value
				},
				"status": {
					"showMyStatus": showMyStatus.fieldWidget.selected,
					"myStatus": "active"
				},
				"stats": {
					"csdRequests": adiutorUserOptions.stats.csdRequests,
					"afdRequests": adiutorUserOptions.stats.afdRequests,
					"prodRequests": adiutorUserOptions.stats.prodRequests,
					"blockRequests": adiutorUserOptions.stats.blockRequests,
					"userWarnings": adiutorUserOptions.stats.userWarnings,
					"pageTags": adiutorUserOptions.stats.pageTags,
				},
				"inlinePageInfo": inlinePageInfo.fieldWidget.selected,
				"showEditSummaries": showEditSummaries.fieldWidget.selected,
				"adiutorVersion": adiutorUserOptions.adiutorVersion,
			};
			updateOptions(UpdatedOptions);
			console.log(UpdatedOptions);
			dialog.close({
				action: action
			});
		});
	}
	return adiutorOptionsDialog.super.prototype.getActionProcess.call(this, action);
};
var windowManager = new OO.ui.WindowManager();
$(document.body).append(windowManager.$element);
var dialog = new adiutorOptionsDialog();
windowManager.addWindows([dialog]);
windowManager.openWindow(dialog);
// Define functions below as needed
function updateOptions(updatedOptions) {
	api.postWithEditToken({
		action: 'globalpreferences',
		format: 'json',
		optionname: 'userjs-adiutor-extension',
		optionvalue: JSON.stringify(updatedOptions),
		formatversion: 2,
	}).done(function() {
		mw.notify(mw.msg('settings-has-been-updated'), {
			title: mw.msg('operation-completed'),
			type: 'success'
		});
	});
}