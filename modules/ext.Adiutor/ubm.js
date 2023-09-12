var api = new mw.Api();
var adiutorUserOptions = JSON.parse(mw.user.options.get('userjs-adiutor-extension'));
var mwConfig = mw.config.get(["wgPageName", "wgUserName"]);
var duration;
var reason;
var blockReason;
var additionalReason = '';
var preventAccountCreationValue;
var preventEmailSendingValue;
var preventEditOwnTalkPageValue;

function fetchApiData(callback) {
	api.get({
		action: "query",
		prop: "revisions",
		titles: "MediaWiki:Adiutor-UBM.json",
		rvprop: "content",
		formatversion: 2
	}).done(function(data) {
		var content = data.query.pages[0].revisions[0].content;
		try {
			var jsonData = JSON.parse(content);
			callback(jsonData);
		} catch(error) {
			// Handle JSON parsing error
			mw.notify('Failed to parse JSON data from API.', {
				title: mw.msg('operation-failed'),
				type: 'error'
			});
		}
	}).fail(function() {
		// Handle API request failure
		mw.notify('Failed to fetch data from the API.', {
			title: mw.msg('operation-failed'),
			type: 'error'
		});
		// You may choose to stop code execution here
	});
}
fetchApiData(function(jsonData) {
	if(!jsonData) {
		// Handle a case where jsonData is empty or undefined
		mw.notify('MediaWiki:Adiutor-UBM.json data is empty or undefined.', {
			title: mw.msg('operation-failed'),
			type: 'error'
		});
		// You may choose to stop code execution here
		return;
	}
	var blockDurations = jsonData.blockDurations;
	var blockReasons = jsonData.blockReasons;
	var userPagePrefix = jsonData.userPagePrefix;
	var userTalkPagePrefix = jsonData.userTalkPagePrefix;
	var specialContibutions = jsonData.specialContibutions;
	var noticeBoardTitle = jsonData.noticeBoardTitle;
	var apiPostSummary = jsonData.apiPostSummary;
	var userToBlock = window.adiutorUserToBlock;
	var headlineElement = window.headlineElement;
	var sectionId = window.sectionId;
	if(!userToBlock) {
		userToBlock = getFormattedPageName();
	}

	function userBlockDialog(config) {
		userBlockDialog.super.call(this, config);
	}
	OO.inheritClass(userBlockDialog, OO.ui.ProcessDialog);
	userBlockDialog.static.title = mw.msg('user-blocking') + ' ' + '(' + userToBlock + ')',
		userBlockDialog.static.name = 'userBlockDialog';
	userBlockDialog.static.actions = [{
		action: 'continue',
		modes: 'edit',
		label: new OO.ui.deferMsg('block'),
		flags: ['primary', 'destructive']
	}, {
		action: 'about',
		modes: 'edit',
		label: 'Adiutor',
	}, {
		modes: 'edit',
		label: new OO.ui.deferMsg('cancel'),
		flags: 'safe'
	}, {
		action: 'back',
		modes: 'help',
		label: new OO.ui.deferMsg('back'),
		flags: 'safe'
	}];
	userBlockDialog.prototype.initialize = function() {
		userBlockDialog.super.prototype.initialize.apply(this, arguments);
		this.userBlockPanel = new OO.ui.PanelLayout({
			padded: true,
			expanded: false
		});
		var durationDropdown = new OO.ui.DropdownWidget({
			menu: {
				items: blockDurations.map(function(duration) {
					return new OO.ui.MenuOptionWidget({
						data: duration.data,
						label: duration.label
					});
				})
			},
			label: mw.message('choose-duration').text(),
		});
		durationDropdown.on('change', function(value) {
			console.log('Dropdown changed:', value);
			duration = value;
		});
		// Create an input field for the block reason
		var reasonInput = new OO.ui.MultilineTextInputWidget({
			placeholder: mw.message('please-choose-block-rationale').text()
		});
		var reasonDropdown = new OO.ui.DropdownWidget({
			menu: {
				items: blockReasons.map(function(reason) {
					return new OO.ui.MenuOptionWidget({
						data: reason.data,
						label: reason.label
					});
				})
			},
			label: mw.message('choose-reason').text()
		});
		durationDropdown.getMenu().on('choose', function(menuOption) {
			duration = menuOption.data;
		});
		reasonDropdown.getMenu().on('choose', function(menuOption) {
			blockReason = menuOption.data;
		});
		reasonInput.on('change', function() {
			additionalReason = ' | ' + mw.msg('additional-rationale') + ': ' + reasonInput.value;
		});
		// Create a fieldset to group the widgets
		var fieldset = new OO.ui.FieldsetLayout({});
		// Create checkboxes for additional block options
		var preventAccountCreationCheckbox = new OO.ui.CheckboxInputWidget({
				selected: true
			}),
			preventEmailSendingCheckbox = new OO.ui.CheckboxInputWidget({
				selected: false
			}),
			preventEditOwnTalkPageCheckbox = new OO.ui.CheckboxInputWidget({
				selected: false
			}),
			// Create a fieldset layout with fields for each checkbox.
			additionalOptionsFieldset = new OO.ui.FieldsetLayout({
				label: mw.message('additional-options').text(),
				padded: true // Add padding
			});
		additionalOptionsFieldset.$element.addClass('additional-options-fieldset'); // Add a CSS class
		additionalOptionsFieldset.$element.css({
			"margin-top": "20px",
		});
		additionalOptionsFieldset.addItems([
			new OO.ui.FieldLayout(preventAccountCreationCheckbox, {
				label: mw.message('prevent-account-creation').text(),
				align: 'inline'
			}),
			new OO.ui.FieldLayout(preventEmailSendingCheckbox, {
				label: mw.message('prevent-sending-email').text(),
				align: 'inline'
			}),
			new OO.ui.FieldLayout(preventEditOwnTalkPageCheckbox, {
				label: mw.message('prevent-editing-own-talk-page').text(),
				align: 'inline'
			}),
		]);
		preventAccountCreationCheckbox.on('change', function(selected) {
			preventAccountCreationValue = selected;
		});
		preventEmailSendingCheckbox.on('change', function(selected) {
			preventEmailSendingValue = selected;
		});
		preventEditOwnTalkPageCheckbox.on('change', function(selected) {
			preventEditOwnTalkPageValue = selected;
		});
		// Add additional options fieldset to the main fieldset
		fieldset.addItems([
			new OO.ui.FieldLayout(durationDropdown, {
				label: mw.message('block-duration').text(),
			}),
			new OO.ui.FieldLayout(reasonDropdown, {
				label: mw.message('block-reason').text(),
			}),
			new OO.ui.FieldLayout(reasonInput, {
				label: mw.message('other-reason').text(),
				align: 'inline'
			}),
			additionalOptionsFieldset
		]);
		// Append fieldset to the document body
		this.userBlockPanel.$element.append(fieldset.$element);
		this.userBlockStackLayout = new OO.ui.StackLayout({
			items: [this.userBlockPanel]
		});
		preventAccountCreationValue = preventAccountCreationCheckbox.isSelected();
		preventEmailSendingValue = preventEmailSendingCheckbox.isSelected();
		preventEditOwnTalkPageValue = preventEditOwnTalkPageCheckbox.isSelected();
		this.$body.append(this.userBlockStackLayout.$element);
	};
	userBlockDialog.prototype.getSetupProcess = function(data) {
		return userBlockDialog.super.prototype.getSetupProcess.call(this, data).next(function() {
			this.actions.setMode('edit');
		}, this);
	};
	userBlockDialog.prototype.getActionProcess = function(action) {
		if(action === 'about') {
			window.open('https://meta.wikimedia.org/wiki/Adiutor', '_blank');
		} else if(action === 'continue') {
			var blockingDialog = this;
			return new OO.ui.Process(function() {
				function checkDurationAndRationaleMessageDialog(config) {
					checkDurationAndRationaleMessageDialog.super.call(this, config);
				}
				if(userToBlock.includes(mwConfig.wgUserName)) {
					mw.notify(mw.message('you-can-not-block-yourself').text(), {
						title: mw.msg('operation-completed'),
						type: 'error'
					});
					blockingDialog.close();
				} else {
					if(!duration || !blockReason) {
						mw.notify(mw.msg('please-select-block-duration-reason'), {
							title: mw.msg('operation-failed'),
							type: 'error'
						});
						return;
					} else {
						var allowusertalkValue = !preventEditOwnTalkPageValue;
						// API request parameters
						var params = {
							action: 'block',
							user: userToBlock,
							expiry: duration,
							reason: blockReason + additionalReason,
							nocreate: preventAccountCreationValue,
							allowusertalk: allowusertalkValue,
							noemail: preventEmailSendingValue,
							tags: 'Adiutor'
						};
						// Send API request
						api.postWithToken('csrf', params).done(function(result) {
							mw.notify(mw.msg('user-blocked'), {
								title: mw.msg('operation-completed'),
								type: 'success'
							});
							if(sectionId) {
								api.postWithToken('csrf', {
									action: 'edit',
									title: noticeBoardTitle,
									section: sectionId,
									text: '',
									summary: apiPostSummary,
									tags: 'Adiutor',
									format: 'json'
								}).done(function() {
									if(headlineElement) {
										headlineElement.css('text-decoration', 'line-through');
									}
								});
							}
						}).fail(function(error) {
							mw.notify(error, {
								title: mw.msg('operation-failed'),
								type: 'error'
							});
						});
						console.log(userToBlock);
						blockingDialog.close();
					}
				}
			});
		}
		return userBlockDialog.super.prototype.getActionProcess.call(this, action);
	};
	userBlockDialog.prototype.getBodyHeight = function() {
		return this.userBlockPanel.$element.outerHeight(true);
	};
	var windowManager = new OO.ui.WindowManager();
	$(document.body).append(windowManager.$element);
	var blockingDialog = new userBlockDialog({
		size: 'medium'
	});
	windowManager.addWindows([blockingDialog]);
	windowManager.openWindow(blockingDialog);

	function getFormattedPageName() {
		var cleanedPageName = mwConfig.wgPageName.replace(/_/g, " ").replace(userPagePrefix, '').replace(specialContibutions, '').replace(userTalkPagePrefix, '');
		return cleanedPageName;
	}
});