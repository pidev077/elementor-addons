elementor.addControlView('file-select', elementor.modules.controls.BaseData.extend({

	onReady: function () {

		var that = this,
			$el = this.$el,
			wpMediaOptions = {
    title: 'Pick a PDF',
    library: {
        type: 'application/pdf'
    },
    multiple: false,

    // Is there a similar option to this that works?
    uploader: {
        type: 'application/pdf'
    }
},
			inputHidden = $el.find('.tnc-selected-fle-url');

		if (!!this.model.attributes.library_type) {
			wpMediaOptions.library = {
				orderby: "date",
				query: true,
				post_mime_type: [ this.model.attributes.library_type ]
			};
		}

		$el.find('.tnc-select-file').click(function (e) {
			var tnc_file_uploader = wp.media(wpMediaOptions)
				.on('select', function () {
					var attachment = tnc_file_uploader.state().get('selection').first().toJSON();
					inputHidden.val(attachment.url).trigger('input');
					that.render();
				})
				.open();
		});

		$el.find('.tnc-remove-file').click(function (e) {
			e.preventDefault();
			inputHidden.removeAttr('value').trigger('input');
			that.render();
		});
	}

}));
