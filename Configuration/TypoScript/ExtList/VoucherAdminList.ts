####################################################
# This template configures a demolist for use
# with pt_extlist
#
# @author Michael Knoll <knoll@punkt.de>, Daniel Lienert <lienert@punkt.de>
# @package Typo3
# @subpackage pt_extlist
####################################################

plugin.tx_ptextlist.settings.listConfig {

	voucherAdmin {

		backendConfig < plugin.tx_ptextlist.prototype.backend.typo3
		backendConfig {

			tables (
				tx_dlvoucher_domain_model_order orders
			)

			#baseFromClause ()

			#baseWhereClause ()
		}

		fields {
			uid {
				table = orders
				field = uid
			}

			code {
				table = orders
				field = code
			}

			date {
				special = FROM_UNIXTIME(crdate, '%d.%m.%Y %H:%i')
			}

			firstName {
				table = orders
				field = first_name
			}

			lastName {
				table = orders
				field = last_name
			}

			email {
				table = orders
				field = email
			}

			street {
				table = orders
				field = street
			}

			zip {
				table = orders
				field = zip
			}

			city {
				table = orders
				field = city
			}

			city {
				table = orders
				field = city
			}

			paymentReceived {
				table = orders
				field = payment_received
			}

			paidDate {
				special = FROM_UNIXTIME(payment_date, '%d.%m.%Y %H:%i')
			}

			amount {
				table = orders
				field = amount
			}

			uuid {
				table = orders
				field = uuid
			}
		}

		columns {
			5 {
				columnIdentifier = date
				fieldIdentifier = date
				label = Datum
			}

			10 {
				columnIdentifier = code
				fieldIdentifier = code
				label = Gutschein


				# renderObj = COA
				# renderObj {
				# }
			}

			20 {
				columnIdentifier = name
				fieldIdentifier = lastName, firstName, street, zip, city, email
				label = Kunde

				renderObj = COA
				renderObj {
					10 = TEXT
					10.dataWrap (
						{field:lastName}, {field:firstName} <br />
						{field:street}, {field:zip} {field:city}<br />
						<a href="mailto:{field:email}">{field:email}</a>
					)
				}
			}


			40 {
				columnIdentifier = amount
				fieldIdentifier = amount
				label = Betrag

				renderObj = COA
				renderObj {
					10 = TEXT
					10.dataWrap = {field:amount} €
				}
			}

			50 {
				columnIdentifier = links
				fieldIdentifier = uuid
				label = Links

				renderObj = COA
				renderObj {
					10 = TEXT
					10.dataWrap (
						<a href="fileadmin/dl_voucher_documents/{field:uuid}/Foto-Lienert-Rechnung.pdf">Rechnung</a><br />
						<a href="fileadmin/dl_voucher_documents/{field:uuid}/Foto-Lienert-Gutschein.pdf">Gutschein</a><br />
					)
				}
			}

			60 {
				columnIdentifier = paymentButton
				fieldIdentifier = uid, paymentReceived, paidDate
				label =

				renderTemplate = EXT:dl_voucher/Resources/Private/Templates/OrderAdmin/RenderTemplates/Payment.html
			}

		}

		filters {
			filterbox1 {

				showSubmit = 0
				showReset = 0

				filterConfigs {
					10 < plugin.tx_ptextlist.prototype.filter.string
					10 {
						filterIdentifier = search
						label = Suchen
						fieldIdentifier = *

						partialPath = typo3conf/ext/extlist_bootstrap/Resources/Private/Partials/Filter/String/StringFilter.html
					}
				}
			}
		}
	}
}