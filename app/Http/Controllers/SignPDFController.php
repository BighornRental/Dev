<?php

namespace App\Http\Controllers;

use App\DigiSigner\DigiSignerClient;
use App\DigiSigner\libs\SignatureRequest;
use App\DigiSigner\libs\Signer; 
use App\DigiSigner\libs\Document; 
use App\DigiSigner\libs\ExistingField;
use App\Models\Contracts;
use App\Models\Customers;

use Illuminate\Http\Request;

//require_once(base_path('vendor/digisigner/ClassLoader.php'));



class SignPDFController extends Controller
 {

	private $client;

    public function __construct() {

			$this->client = new DigiSignerClient('51c67a13-d31a-45ef-a5a8-569047a5616f'); 

	}

	public function getPDF($contract) {

		$contract = Contracts::findOrFail($contract);

		$contract_number = ($contract->pdf_contract_number == null) ? '890f33bc-9874-4b01-b326-16c9d98547ac' : $contract->pdf_contract_number; 

		$signDocument = $this->doPDF($contract,'embed', $contract_number);

		$contract->update(['pdf_contract_number' => $signDocument['id']]);

		return view('DigiSigner.show', ['url' => $signDocument['url'] ]);

	}

	public function mailPDF($contract) {

		$contract = Contracts::findOrFail($contract);

		$contract_number = ($contract->pdf_contract_number == null) ? '890f33bc-9874-4b01-b326-16c9d98547ac' : $contract->pdf_contract_number;

		$signDocument = $this->doPDF($contract,'mail', $contract_number);

		$contract->update(['pdf_contract_number' => $signDocument['id']]);

		return view('DigiSigner.show', ['url' => $signDocument['url'] ]);

	}

	public function signedPDF() {

		DD('signed');
		
	}
	
	public function doPDF($contract,$request_type,$template) {

		$customer = Customers::findOrFail($contract->customers_id);
		//$client = new DigiSignerClient('51c67a13-d31a-45ef-a5a8-569047a5616f'); 
		$request = new SignatureRequest;
		
		$setTo = ($request_type == 'embed') ? array(true,false) : array(false,true);

		$request->setEmbedded($setTo[0]);
		$request->setSendEmails($setTo[1]);
		
		$template = Document::withID($template);
		$template->setTitle($contract->dealer.'for'.$contract->customer_name); 
		$request->addDocument($template); 

		$signer = new Signer($contract->email);
		$signer->setRole('Signer 1');    
		$template->addSigner($signer);

		$contract_number = new ExistingField('d969ccc4-5371-4a45-abdc-7536465f0081');
		$contract_number->setContent($contract->contract_number);
		$signer->addExistingField($contract_number);

		$contract_date = new ExistingField('0d3585e2-aa7f-45be-bf13-0106adfa9c23');
		$cdate = date( 'F jS, Y');
		$contract_date->setContent($cdate);
		$signer->addExistingField($contract_date);

		$customer_name = new ExistingField('2956746c-9f31-4369-b261-f9a077cb8c6b');
		$customer_name->setContent($contract->customer_name);
		$signer->addExistingField($customer_name);

		$customer_mailiig_address = new ExistingField('2ea39eaa-429c-41c0-aa4b-015e150e369a');
		$customer_mailiig_address->setContent($customer->address);
		$signer->addExistingField($customer_mailiig_address);

		$customer_mailiig_city = new ExistingField('7c22d5ab-4eb8-4348-bab2-401f52722f2a');
		$customer_mailiig_city->setContent($customer->city);
		$signer->addExistingField($customer_mailiig_city);

		$customer_mailiig_state = new ExistingField('debc4238-fc00-4b93-8112-26768fc01e04');
		$customer_mailiig_state->setContent($customer->state);
		$signer->addExistingField($customer_mailiig_state);

		$customer_mailiig_postal = new ExistingField('07172e4e-c682-4ecb-b940-71c92a75fba6');
		$customer_mailiig_postal->setContent($customer->postal_code);
		$signer->addExistingField($customer_mailiig_postal);

		$customer_phone = new ExistingField('76eb3d9a-92ef-4da8-a813-e1e5bba2f058');
		$customer_phone->setContent($contract->phone);
		$signer->addExistingField($customer_phone);

		$customer_secondary_phone = new ExistingField('cfe94879-fad8-49d1-a605-9b7b5a19e241');
		$customer_secondary_phone->setContent($contract->secondary_phone);
		$signer->addExistingField($customer_secondary_phone);

		$customer_email = new ExistingField('c152b4f1-b570-4230-a395-7767a77ac2e8');
		$customer_email->setContent($contract->email);
		$signer->addExistingField($customer_email);

		$customer_county = new ExistingField('dd82073f-1ae7-47a2-8049-d7816241ad98');
		$customer_county->setContent($contract->shipping_county);
		$signer->addExistingField($customer_county);

		$customer_shipping_address = new ExistingField('dafd6aef-17e9-41d3-803b-48ecc73c16e3');
		$customer_shipping_address->setContent($contract->shipping_address.', '.$contract->shipping_city);
		$signer->addExistingField($customer_shipping_address);

		$customer_shipping_state = new ExistingField('cbbb88e6-40a6-464a-a79b-20d382ea30a1');
		$customer_shipping_state->setContent($contract->shipping_state);
		$signer->addExistingField($customer_shipping_state);

		$customer_shipping_zip = new ExistingField('2b7ab09b-89c9-45a7-8769-f90457b0b50c');
		$customer_shipping_zip->setContent($contract->shipping_postal_code);
		$signer->addExistingField($customer_shipping_zip);

		$product_tax_rate = new ExistingField('4a7f73fa-eb2d-4aeb-a924-1cc2a443acfd');
		$product_tax_rate->setContent($contract->product_sales_tax);
		$signer->addExistingField($product_tax_rate);

		$reference_name = new ExistingField('f78eca66-4954-4534-848b-54b03638a321');
		$reference_name->setContent($contract->reference_name);
		$signer->addExistingField($reference_name);

		$reference_phone = new ExistingField('9b3364eb-c6ef-4713-8501-93bd0bcaf780');
		$reference_phone->setContent($contract->reference_phone);
		$signer->addExistingField($reference_phone);

		$product_size = new ExistingField('6360f48e-33f7-408e-aac3-3448509cf611');
		$product_size->setContent($contract->product_size);
		$signer->addExistingField($product_size);

		$product_style = new ExistingField('372d96da-c6a9-435a-a62e-b2e1f62f2f1e');
		$product_style->setContent($contract->product_style);
		$signer->addExistingField($product_style);

		$product_material = new ExistingField('1bdfb020-8e30-4db9-a279-3c29fe19f973');
		$product_material->setContent($contract->product_material);
		$signer->addExistingField($product_material);

		$product_side_color = new ExistingField('e0965057-9705-42a4-8b57-75cdcf9fe67a');
		$product_side_color->setContent($contract->product_side_color);
		$signer->addExistingField($product_side_color);

		$product_trim_color = new ExistingField('d15a3540-359d-4137-94bd-e988376d476d');
		$product_trim_color->setContent($contract->product_trim_color);
		$signer->addExistingField($product_trim_color);

		$product_roof_color = new ExistingField('ff9ee2d9-d346-4ead-becc-45710ea59ae0');
		$product_roof_color->setContent($contract->product_roof_color);
		$signer->addExistingField($product_roof_color);

		$product_roof_material = new ExistingField('3b1583b0-aca7-4f14-9074-a5bec19cfed9');
		$product_roof_material->setContent($contract->product_roof_material);
		$signer->addExistingField($product_roof_material);

		$product_serial_number = new ExistingField('ebc17521-dbe3-442a-a621-baf38a8a7ea6');
		$product_serial_number->setContent($contract->product_serial_number);
		$signer->addExistingField($product_serial_number);

		$product_cash_price = new ExistingField('29547b63-3fe9-4298-a994-3d4fc67f3f37');
		$product_cash_price->setContent( number_format($contract->product_cash_price,'2','.',',') );
		$signer->addExistingField($product_cash_price);

		$condition = ($contract->product_condition == "new") ? array('Y','N') : array('N', 'Y');

		$product_condition_new = new ExistingField('febaba45-4641-4e2c-8f1d-b3a0d1e657fc');
		$product_condition_new->setContent( $condition[0] );
		$signer->addExistingField($product_condition_new);

		$product_condition_used = new ExistingField('ee863926-3dc0-421f-b189-d456fccaf86e');
		$product_condition_used->setContent( $condition[1] );
		$signer->addExistingField($product_condition_used);

		$product_condition_description = new ExistingField('9fac6c02-c054-46de-b5a2-e2c65a33b5db');
		$product_condition_description->setContent( $contract->product_condition_description );
		$signer->addExistingField($product_condition_description);

		$rto_terms = new ExistingField('420178a0-2ce8-442e-84ca-cae3f170fd20');
		$rto_terms->setContent( $contract->rto_terms );
		$signer->addExistingField($rto_terms);

		$cra = new ExistingField('c0434e21-6a53-46db-a4fe-27d2d9f256d2');
		$cra->setContent( number_format($contract->Initial_down_payment, 2, '.',','));
		$signer->addExistingField($cra);

		$no_cra_payment = new ExistingField('445cbea0-bd24-43ef-9116-cbe539ea8ee4');
		$no_cra_payment->setContent( number_format($contract->no_cra_payment, 2, '.',','));
		$signer->addExistingField($no_cra_payment);

		$no_cra_tax = new ExistingField('e4d7ce53-78e2-444b-ac7b-b6380e9649df');
		$no_cra_tax->setContent( number_format($contract->no_cra_tax, 2, '.',','));
		$signer->addExistingField($no_cra_tax);

		$ldw_monthly = new ExistingField('dcbcb14a-492c-4386-ad12-85fae752af53');
		$ldw_monthly->setContent( number_format($contract->ldw_monthly, 2, '.',','));
		$signer->addExistingField($ldw_monthly);

		$no_cra_total = new ExistingField('fed65d3a-0920-4804-9ba5-f94f4c292fc9');
		$no_cra_total->setContent( number_format($contract->no_cra_total, 2, '.',','));
		$signer->addExistingField($no_cra_total);

		$cra_payment = new ExistingField('c8ddc3e3-4c80-46b3-939a-bc8f33189d1e');
		$cra_payment->setContent( number_format($contract->cra_payment, 2, '.',','));
		$signer->addExistingField($cra_payment);

		$cra_tax = new ExistingField('6e510bb2-648c-405d-8808-45211699d8fc');
		$cra_tax->setContent( number_format($contract->cra_tax, 2, '.',','));
		$signer->addExistingField($cra_tax);

		$ldw_monthly = new ExistingField('9ba202f6-692d-4753-858e-37f538cbaa30');
		$ldw_monthly->setContent( number_format($contract->ldw_monthly, 2, '.',','));
		$signer->addExistingField($ldw_monthly);

		$cra_total = new ExistingField('d083be21-a2bd-4b81-a1c7-d972cd615eba');
		$cra_total->setContent( number_format($contract->cra_total, 2, '.',','));
		$signer->addExistingField($cra_total);

		$ldw = ($contract->ldw == 1) ? 'Accept' : "Decline";

		$ldw_agreement = new ExistingField('228d1003-c5ae-44f2-bfb3-4692053bffa5');
		$ldw_agreement->setContent( $ldw );
		$signer->addExistingField($ldw_agreement);

		$ldw_monthly = new ExistingField('147c19a4-6ddd-43b2-a84e-11285672109b');
		$ldw_monthly->setContent( number_format($contract->ldw_monthly, 2, '.',','));
		$signer->addExistingField($ldw_monthly);

		$initial_rental_payment = new ExistingField('d5cfcd6c-527a-4acf-91ae-68f5f1e0f777');
		$initial_rental_payment->setContent( number_format($contract->cra_total * 2, 2, '.',','));
		$signer->addExistingField($initial_rental_payment);

		$initial_sales_tax = new ExistingField('5dd7bf85-b3d6-4da9-b846-25561fc1ced6');
		$initial_sales_tax->setContent( number_format($contract->cra_tax * 2, 2, '.',','));
		$signer->addExistingField($initial_sales_tax);

		$initial_ldw = new ExistingField('42b1d15d-4faa-4716-8c29-14b8f4b7ada7');
		$initial_ldw->setContent( number_format($contract->ldw * 2, 2, '.',','));
		$signer->addExistingField($initial_ldw);

		$cra = new ExistingField('db2514fd-6d8f-4110-9c8d-fc56d195d356');
		$cra->setContent( number_format($contract->cra, 2, '.',','));
		$signer->addExistingField($cra);

		$product_delivery_charge = new ExistingField('4f01878b-c82b-4677-8b9e-148e14f92fb5');
		$product_delivery_charge->setContent( number_format($contract->product_delivery_charge, 2, '.',','));
		$signer->addExistingField($product_delivery_charge);

		$initial_payment = new ExistingField('26b7b4b0-cbca-4a58-a405-7136b7a8741b');
		$initial_payment->setContent( number_format($contract->initial_payment, 2, '.',','));
		$signer->addExistingField($initial_payment);

		$rto_terms_2 = new ExistingField('491e8f01-4eac-40a1-8d3a-1e921b18e637');
		$rto_terms_2->setContent( $contract->rto_terms );
		$signer->addExistingField($rto_terms_2);

		$paid_total = new ExistingField('6d1c8350-e02e-4ea5-8603-512f1173afb7');
		$paid_total->setContent( number_format( $contract->cra_total * $contract->rto_terms,'2','.',',') );
		$signer->addExistingField($paid_total);

		$payoff_percentage = array('24'=>'70','36'=>'60','48'=>'50');

		$percent_payoff = new ExistingField('c1eefb0c-1f45-4d24-a5cd-3eba8e408129');
		$percent_payoff->setContent( $payoff_percentage[$contract->rto_terms] );
		$signer->addExistingField($percent_payoff);

		$dealer = new ExistingField('9e9f1d88-e3d1-44f6-87fc-ca7a8238808a');
		$dealer->setContent( $contract->dealer );
		$signer->addExistingField($dealer);

		$delivery_date = new ExistingField('b3d94eb5-0f55-4a84-964e-7cf591d3261f');
		$delivery_date->setContent( $contract->delivery_date );
		$signer->addExistingField($delivery_date);

		$IP_tip = new ExistingField('9f97cfe1-e5f2-48e0-92d6-5d5ee0970d35');
		$IP_tip->setContent( number_format($contract->initial_payment, 2, '.',',') );
		$signer->addExistingField($IP_tip);

		$IP_at = new ExistingField('82a85fce-f480-4dfb-bc26-f58f6226b0c4');
		$IP_at->setContent( strtoupper($contract->initial_payment_type) );
		$signer->addExistingField($IP_at);

		$RP_boolean = ($contract->recurring_payment == 1) ? true : false;

		$RP_name_var = ($RP_boolean) ? $contract->customer_name : 'N/A';
		$RP_name = new ExistingField('ba2bc2ce-a527-4696-a2c6-0ab81835cc7f');
		$RP_name->setContent( $RP_name_var );
		$signer->addExistingField($RP_name);

		$RP_total_var = ($RP_boolean) ? $contract->no_cra_total : 'N/A';
		$RP_total_var = ( $contract->original_initial_payment != null ) ? $contract->cra_total : $RP_total_var;
		$RP_total = new ExistingField('0b4f2cc7-c0c7-413f-a66d-b155b453cde1');
		$RP_total->setContent( $RP_total_var );
		$signer->addExistingField($RP_total);

		$recurring_payment_date_var = ($RP_boolean) ? $contract->recurring_payment_date : 'N/A' ;
		$recurring_payment_date = new ExistingField('8a84a21d-829a-4679-b2be-3ef63a07a939');
		$recurring_payment_date->setContent( $recurring_payment_date_var );
		$signer->addExistingField($recurring_payment_date);

		$recurring_payment_address_var = ($RP_boolean) ? $customer->address : 'N/A' ;
		$recurring_payment = new ExistingField('f13634e5-511e-4a60-b217-184d9560f45d');
		$recurring_payment->setContent( $recurring_payment_address_var );
		$signer->addExistingField($recurring_payment);

		$recurring_payment_city_var = ($RP_boolean) ? $customer->city.', '.$customer->state.' '.$customer->postal_code : 'N/A' ;
		$ecurring_payment_city = new ExistingField('83a8ced6-6bca-4d5d-8c2c-34538699c224');
		$ecurring_payment_city->setContent( $recurring_payment_city_var );
		$signer->addExistingField($ecurring_payment_city);

		$recurring_payment_phone_var = ($RP_boolean) ? $customer->phone : 'N/A' ;
		$recurring_payment_phone = new ExistingField('3feea1c2-e02a-4b33-8054-22df814f1f76');
		$recurring_payment_phone->setContent( $recurring_payment_phone_var );
		$signer->addExistingField($recurring_payment_phone);

		$recurring_payment_email_var = ($RP_boolean) ? $customer->email : 'N/A' ;
		$recurring_payment_email = new ExistingField('f720b366-de94-4961-877a-90d6f2f19c76');
		$recurring_payment_email->setContent( $recurring_payment_email_var );
		$signer->addExistingField($recurring_payment_email);

		$paperless_billing_var = ($contract->papperless_billing == 1) ? 'Y' : 'N' ;
		$paperless_billing = new ExistingField('482f773a-2d3e-4274-b5b3-7f5f502c58ba');
		$paperless_billing->setContent( $paperless_billing_var );
		$signer->addExistingField($paperless_billing);

		$response = $this->client->sendSignatureRequest($request);

		foreach($response->getDocuments() as $document) {
			$document_id = $document->getID();
			foreach($document->getSigners() as $signer) {
				$signDocumentUrl = $signer->getSignDocumentUrl();
			}
		}

		return array('url'=>$signDocumentUrl,'id' => $document_id);
	}

	public function signerInitials( $name ) {
		$initials = '';
		$name = explode(' ',$name);
		foreach($name AS $key=>$name) {
			$initials .= substr($name,0,1);
		}
		return $initials;
	}
	
 }