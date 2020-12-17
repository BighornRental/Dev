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

    public function __construct() {

	}

	public function getPDF($contract) {

		$contract = Contracts::findOrFail($contract,);

		$signDocumentUrl = $this->doPDF($contract,'embed', '890f33bc-9874-4b01-b326-16c9d98547ac');

		return view('DigiSigner.show', ['url' => $signDocumentUrl]);

	}

	public function mailPDF($contract) {

		$contract = Contracts::findOrFail($contract,);

		$signDocumentUrl = $this->doPDF($contract,'mail', '890f33bc-9874-4b01-b326-16c9d98547ac');

		return view('DigiSigner.mailed', ['contract' => $contract]);

	}
	
	public function doPDF($contract,$request_type,$template) {

		$customer = Customers::findOrFail($contract->customers_id);
		$client = new DigiSignerClient('51c67a13-d31a-45ef-a5a8-569047a5616f'); 
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

		$condition = ($contract->product_condition == "new") ? array(true,false) : array(false, true);

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
		$cra->setContent( number_format($contract->cra, 2, '.',','));
		$signer->addExistingField($cra);

		$response = $client->sendSignatureRequest($request);

		foreach($response->getDocuments() as $document) {
			foreach($document->getSigners() as $signer) {
				$signDocumentUrl = $signer->getSignDocumentUrl();
			}
		}
		return $signDocumentUrl;
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