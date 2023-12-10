(function ($) {
	'use strict';

	var dashboard = {};

	dashboard.mkdfOnDocumentReady = mkdfOnDocumentReady;

	$(document).ready(mkdfOnDocumentReady);

	/**
	 *  All functions to be called on $(document).ready() should be in mkdfImport function
	 **/
	function mkdfOnDocumentReady() {
		mkdfThemeRegistration.init();
		mkdfImport.init();
		mkdfThemeSelectDemo();
		mkdfInitSwitch();
	}

	var mkdfImport = {
		importDemo: '',
		importImages: 0,
		counterStep: 0,
		contentCounter: 0,
		totalPercent: 0,
		contentFlag: false,
		allFlag: false,
		contentFinished: false,
		allFinished: false,
		repeatFiles: [],

		init: function () {
			mkdfImport.holder = $('.mkdf-cd-import-form');

			if (mkdfImport.holder.length) {
				mkdfImport.holder.each(function () {
					var mkdfImportBtn = $('#mkdf-import-demo-data'),
						importAction = $('.mkdf-cd-import-option'),
						importDemoElement = $('.mkdf-import-demo'),
						confirmMessage = mkdfImport.holder.data('confirm-message');

					importAction.on('change', function (e) {
						mkdfImport.populateSinglePage(importAction.val(), $('.mkdf-import-demo').val(), false);
					});
					importDemoElement.on('change', function (e) {
						mkdfImport.populateSinglePage(importAction.val(), $('.mkdf-import-demo').val(), true);
					});
					mkdfImportBtn.on('click', function (e) {
						e.preventDefault();
						mkdfImport.reset();
						mkdfImport.importImages = $('.mkdf-cd-import-attachments').is(':checked') ? 1 : 0;
						mkdfImport.importDemo = importDemoElement.val();

						if (confirm(confirmMessage)) {
							$('.mkdf-cd-box-form-section-progress').show();
							$(this).addClass('mkdf-import-demo-data-disabled');
							$(this).attr("disabled", true);
							mkdfImport.initImportType(importAction.val());
						}
					});
				});
			}
		},

		initImportType: function (action) {
			switch (action) {
				case 'widgets':
					mkdfImport.importWidgets();
					break;
				case 'options':
					mkdfImport.importOptions();
					break;
				case 'content':
					mkdfImport.contentFlag = true;
					mkdfImport.importContent();
					break;
				case 'complete':
					mkdfImport.allFlag = true;
					mkdfImport.importAll();
					break;
				case 'single-page':
					mkdfImport.importSinglePage();
					break;
			}
		},

		importWidgets: function () {
			var data = {
				action: 'widgets',
				demo: mkdfImport.importDemo
			};
			mkdfImport.importAjax(data);
		},

		importOptions: function () {
			var data = {
				action: 'options',
				demo: mkdfImport.importDemo
			};
			mkdfImport.importAjax(data);
		},

		importSettingsPages: function () {
			var data = {
				action: 'settings-page',
				demo: mkdfImport.importDemo
			};
			mkdfImport.importAjax(data);
		},

		importMenuSettings: function () {
			var data = {
				action: 'menu-settings',
				demo: mkdfImport.importDemo
			};
			mkdfImport.importAjax(data);
		},

		importRevSlider: function () {
			var data = {
				action: 'rev-slider',
				demo: mkdfImport.importDemo
			};
			mkdfImport.importAjax(data);
		},

		importContent: function () {
			if (mkdfImport.contentCounter == 0) {
				mkdfImport.importTerms();
			}
			if (mkdfImport.contentCounter == 1) {
				mkdfImport.importAttachments();
			}
			if ((mkdfImport.contentCounter > 1 && mkdfImport.contentCounter < 20) && mkdfImport.repeatFiles.length) {
				mkdfImport.importAttachments(true);
			}
			if (mkdfImport.contentCounter == 20) {
				mkdfImport.importPosts();
			}
		},

		importAll: function () {

			if (mkdfImport.contentCounter < 21) {
				mkdfImport.importContent();
			} else {
				mkdfImport.contentFinished = true;
			}

			if (mkdfImport.contentFinished && !mkdfImport.allFinished) {
				mkdfImport.importWidgets();
				mkdfImport.importOptions();
				mkdfImport.importSettingsPages();
				mkdfImport.importMenuSettings();
				mkdfImport.importRevSlider();
				mkdfImport.allFinished = true;
			}

		},
		importTerms: function () {
			var data = {
				action: 'content',
				xml: 'curly_content_0.xml',
				contentStart: true
			};
			mkdfImport.importAjax(data);
		},
		importPosts: function () {
			var data = {
				action: 'content',
				xml: 'curly_content_20.xml',
				updateURL: true
			};
			mkdfImport.importAjax(data);
		},

		importSinglePage: function () {
			var postId = $('#import_single_page').val();
			var data = {
				action: 'content',
				xml: 'curly_content_20.xml',
				post_id: postId
			};
			mkdfImport.importAjax(data);
		},

		importAttachments: function (repeat) {
			if (mkdfImport.repeatFiles.length && repeat) {
				mkdfImport.repeatFiles.forEach(function (index) {
					var data = {
						action: 'content',
						xml: index,
						images: mkdfImport.importImages
					};
					mkdfImport.importAjax(data);
				});
				mkdfImport.repeatFiles = [];

			}

			if (!repeat) {
				for (var i = 1; i < 20; i++) {
					var xml = i < 20 ? 'curly_content_' + i + '.xml' : 'curly_content_' + i + '.xml';
					var data = {
						action: 'content',
						xml: xml,
						images: mkdfImport.importImages
					};
					mkdfImport.importAjax(data);
				}
			}
		},

		importAjax: function (options) {
			var defaults = {
				demo: mkdfImport.importDemo,
				nonce: $('#mkdf_cd_import_nonce').val()
			};
			$.extend(defaults, options);
			$.ajax({
				type: 'POST',
				url: ajaxurl,
				data: {
					action: 'import_action',
					options: defaults
				},
				success: function (data) {
					var response = JSON.parse(data);
					mkdfImport.ajaxSuccess(response);
				},
				error: function (data) {
					var response = JSON.parse(data);
					mkdfImport.ajaxError(response, options);
				}
			});
		},

		importProgress: function () {
			if (!mkdfImport.contentFlag && !mkdfImport.allFlag) {
				mkdfImport.totalPercent = 100;
			} else if (mkdfImport.contentFlag) {
				if (mkdfImport.contentCounter < 21) {
					mkdfImport.totalPercent += 4.5;
				} else if (mkdfImport.contentCounter == 21) {
					mkdfImport.totalPercent += 10;
				}
			} else if (mkdfImport.allFlag) {
				if (mkdfImport.contentCounter < 21) {
					mkdfImport.totalPercent += 4;
				} else if (mkdfImport.contentCounter == 21) {
					mkdfImport.totalPercent += 10;
				} else {
					mkdfImport.totalPercent += 2;
				}
			}

			$('#mkdf-progress-bar').val(mkdfImport.totalPercent);
			$('.mkdf-cd-progress-percent').html(Math.round(mkdfImport.totalPercent) + '%');

			if (mkdfImport.totalPercent == 100) {
				$('#mkdf-import-demo-data').remove('.mkdf-import-demo-data-disabled');
				$('.mkdf-cd-import-is-completed').show();

			}
		},

		ajaxSuccess: function (response) {
			if (typeof response.status !== 'undefined' && response.status == 'success') {
				if (mkdfImport.contentFlag) {
					mkdfImport.contentCounter++;
					mkdfImport.importContent();
				}
				if (mkdfImport.allFlag) {
					mkdfImport.contentCounter++;
					mkdfImport.importAll();
				}
				mkdfImport.importProgress();
			} else {
				if (typeof response.data.type !== 'undefined' && response.data.type == 'content') {
					mkdfImport.repeatFiles.push(response.data['xml'])
				} else if (typeof response.data.type !== 'undefined' && response.data.type == 'options') {
					$('#mkdf-import-demo-data').remove('.mkdf-import-demo-data-disabled');
					$('.mkdf-cd-import-went-wrong').show();

				}
			}
		},

		ajaxError: function (response, options) {
			if ("xml" in options) {
				if (mkdfImport.contentFlag) {
					mkdfImport.importContent();
				}
				if (mkdfImport.allFlag) {
					mkdfImport.importAll();
				}
				mkdfImport.repeatFiles.push(options.xml);

			}
		},

		reset: function () {
			mkdfImport.totalPercent = 0;
			$('#mkdf-progress-bar').val(0);
		},

		populateSinglePage: function (value, demo, demoChange) {
			var holder = $('.mkdf-cd-box-form-section-dependency'),
				options = {
					demo: demo,
					nonce: $('#mkdf_cd_import_nonce').val()
				};

			if (value == 'single-page') {
				if (holder.children().length == 0 || demoChange) {

					$.ajax({
						type: 'POST',
						url: ajaxurl,
						data: {
							action: 'populate_single_pages',
							options: options
						},
						success: function (data) {
							var response = $.parseJSON(data);
							if (response.status == 'success') {
								$('.mkdf-cd-box-form-section-dependency').html(response.data);
								var singlePageList = $('select.mkdf-cd-import-single-page');
								holder.show();
								singlePageList.select2({
									dropdownCssClass: "mkdf-cd-single-page-selection"
								});
							} else {
								holder.html(response.message);
								holder.show();
							}
						}
					});
				} else {
					holder.show();
				}

			} else {
				holder.hide();
			}
		},
	};

	var mkdfThemeRegistration = {
		init: function () {
			mkdfThemeRegistration.holder = $('#mkdf-register-purchase-form');

			if (mkdfThemeRegistration.holder.length) {
				mkdfThemeRegistration.holder.each(function () {

					var form = $(this);

					var mkdfRegistrationBtn = $(this).find('#mkdf-register-purchase-key'),
						mkdfdeRegistrationBtn = $(this).find('#mkdf-deregister-purchase-key');

					mkdfRegistrationBtn.on('click', function (e) {
						e.preventDefault();
						$(this).addClass('mkdf-cd-button-disabled');
						$(this).attr("disabled", true);
						$(this).siblings('.mkdf-cd-button-wait').show();
						if (mkdfThemeRegistration.validateFields(form)) {
							var post = form.serialize();
							mkdfThemeRegistration.registration(post);
						} else {
							$(this).removeClass('mkdf-cd-button-disabled');
							$(this).attr("disabled", false);
							$(this).siblings('.mkdf-cd-button-wait').hide();
						}

					});

					mkdfdeRegistrationBtn.on('click', function (e) {
						$(this).addClass('mkdf-cd-button-disabled');
						$(this).attr("disabled", true);
						$(this).siblings('.mkdf-cd-button-wait').show();
						e.preventDefault();
						mkdfThemeRegistration.deregistration();
					});
				});
			}
		},

		registration: function (post) {
			var data = {
				action: 'register',
				post: post
			};
			mkdfThemeRegistration.registrationAjax(data);
		},

		deregistration: function () {
			var data = {
				action: 'deregister',
			};
			mkdfThemeRegistration.registrationAjax(data);
		},

		validateFields: function (form) {
			if (mkdfThemeRegistration.validatePurchaseCode(form) && mkdfThemeRegistration.validateEmail(form)) {
				return true
			}
		},

		validateEmail: function (form) {
			var email = form.find("[name='email']");
			var emailVal = email.val();
			var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

			if (emailVal !== '' && regex.test(emailVal)) {
				email.removeClass('mkdf-cd-error-field');
				email.parent().find('.mkdf-cd-error-message').remove();
				return true
			} else if (emailVal == '') {
				email.addClass('mkdf-cd-error-field');
				mkdfThemeRegistration.errorMessage(email.parent().data("empty-field"), email.parent());
			} else if (!regex.test(emailVal)) {
				email.addClass('mkdf-cd-error-field');
				mkdfThemeRegistration.errorMessage(email.parent().data("invalid-field"), email.parent());
			}
		},

		validatePurchaseCode: function (form) {
			var purchaseCode = form.find("[name='purchase_code']");
			var purchaseCodeVal = purchaseCode.val();

			if (purchaseCodeVal !== '') {
				purchaseCode.removeClass('mkdf-cd-error-field');
				purchaseCode.parent().find('.mkdf-cd-error-message').remove();
				return true
			} else {
				mkdfThemeRegistration.errorMessage(purchaseCode.parent().data("empty-field"), purchaseCode.parent());
				purchaseCode.addClass('mkdf-cd-error-field');
			}
		},

		errorMessage: function (message, target) {
			target.find('.mkdf-cd-error-message').remove();
			$('<span class="mkdf-cd-error-message"></span>').text(message).appendTo(target);
		},

		registrationAjax: function (options) {
			$.ajax({
				type: 'POST',
				url: mkdfCoreDashboardGlobalVars.vars.restUrl + mkdfCoreDashboardGlobalVars.vars.registrationThemeRoute,
				data: {
					options: options
				},
				beforeSend: function ( request ) {
					request.setRequestHeader( 'X-WP-Nonce', mkdfCoreDashboardGlobalVars.vars.restNonce );
				},
				success: function (response) {
					if (response.status == 'success') {
						location.reload();
					} else if (response.status == 'error' && ((typeof response.data['purchase_code'] !== 'undefined' && response.data['purchase_code'] === false) || (typeof response.data['already_used'] !== 'undefined' && response.data['already_used'] === true))) {
						mkdfThemeRegistration.errorMessage(response.message, $("[name='purchase_code']").parent());
						$('#mkdf-register-purchase-key').removeClass('mkdf-cd-button-disabled');
						$('#mkdf-register-purchase-key').attr("disabled", false);
						$('#mkdf-register-purchase-key').siblings('.mkdf-cd-button-wait').hide();
					} else if (response.status == 'error') {
						alert(response.message);
					}

				},
				error: function (response) {
					console.log(response);
				}
			});
		}
	};


	function mkdfThemeSelectStyles(selection) {
		if (!selection.id) {
			return selection.text;
		}

		var thumb = $(selection.element).data('thumb');
		if (!thumb) {
			return selection.text;
		} else {
			var $selection = $(
				'<img src="' + thumb + '" alt="Demo Thumbnail"><span class="img-changer-text">' + $(selection.element).text() + '</span>'
			);
			return $selection;
		}
	}

	function mkdfThemeSelectDemo() {
		var themeList = $('select.mkdf-import-demo');

		themeList.select2({
			templateResult: mkdfThemeSelectStyles,
			minimumResultsForSearch: -1,
			dropdownCssClass: "mkdf-cd-selection"
		});

		var optionList = $('select.mkdf-cd-import-option');
		optionList.select2({
			minimumResultsForSearch: -1,
			dropdownCssClass: "mkdf-cd-action-selection"
		});
	}

	function mkdfInitSwitch() {
		$(".mkdf-cd-cb-enable").on('click', function () {
			var parent = $(this).parents('.mkdf-cd-switch');
			$('.mkdf-cd-cb-disable', parent).removeClass('selected');
			$(this).addClass('selected');
			$('.mkdf-cd-import-attachments', parent).attr('checked', true);
		});

		$(".mkdf-cd-cb-disable").on('click', function () {
			var parent = $(this).parents('.mkdf-cd-switch');
			$('.mkdf-cd-cb-enable', parent).removeClass('selected');
			$(this).addClass('selected');
			$('.mkdf-cd-import-attachments', parent).attr('checked', false);
		});
	}

})(jQuery);