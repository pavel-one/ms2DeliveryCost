if (typeof(ms2DeliveryCost) != 'object') {
	var ms2DeliveryCost = {};
}
ms2DeliveryCost.block = '#deliveries';

jQuery(document).ready(function($) {
	ms2DeliveryCost.required = ms2DeliveryCost.required.split(',');
	ms2DeliveryCost.requiredField = '';

	ms2DeliveryCost.required.forEach(function(item, i) {
		ms2DeliveryCost.requiredField += '[name='+item+'],';
	})
	ms2DeliveryCost.requiredField = ms2DeliveryCost.requiredField.slice(0, -1);

	ms2DeliveryCost.checkRequired = function () {
	    var checkRequiredResult = true;
		this.required.forEach(function(item) {
			var val = $('[name='+item+']').val();
			console.log(val);
			if (val.trim() == '') {
				checkRequiredResult = false;
				return ;
			}
		});
		return checkRequiredResult;
	}
	ms2DeliveryCost.reload = function() {
		this.loadEffect();
		var self = this;
		setTimeout(function() {
			$.get(window.location.href, {deliveryGetCost: 'get'}, function(data) {
				var content = $(data).find(self.block).html();
				$(self.block).html(content);
				console.log('updated');
				self.loadEffect(1);
			}, 'html');
		}, 2000);
	}
	ms2DeliveryCost.loadEffect = function(show) {
		if (!show) {
			$(this.block).css('opacity', '0.5');
		} else {
			$(this.block).css('opacity', '1');
		}
		
	}
	ms2DeliveryCost.init = function() {
		if (this.checkRequired()) {
			this.reload();
		}
	}
	$(ms2DeliveryCost.requiredField).change(function(event) {
		ms2DeliveryCost.init();
	});
	ms2DeliveryCost.init();
});