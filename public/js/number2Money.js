/*
	Da formato de moneda a String
*/
function numberToMoney(value) {
	const formatterDolar = new Intl.NumberFormat('en-US', {
    	style: 'currency',
    	currency: 'USD'
    });
	if (isNaN(value)) {
		value = 0;
	}

	return formatterDolar.format(value);
}



/*
	Convierte String con formato de moneda a numero flotante
*/
function moneyToNumber(value) {
	valueWithoutSignDollar	= value.split("$");
	valueWhitoutComas		= valueWithoutSignDollar[1].replace(/,/g, "");
	if (valueWhitoutComas == '') {
		value = 0;
	} else {
	    value = parseFloat(valueWhitoutComas);
	}

	return value;
}