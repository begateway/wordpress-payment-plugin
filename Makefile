all:
	if [[ -e begateway-payment.zip ]]; then rm begateway-payment.zip; fi
	zip -r begateway-payment.zip begateway-payment -x "*/test/*" -x "*/.git/*" -x "*/examples/*"
