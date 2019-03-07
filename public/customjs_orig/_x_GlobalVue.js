Vue.filter("formatCurrency", function (value) {
	return numeral(value).format("$0,0.00"); // displaying other groupings/separators is possible, look at the docs
});