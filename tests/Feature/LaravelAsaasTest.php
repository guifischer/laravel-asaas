<?php

namespace guivic\LaravelAsaas\Tests\Feature;

use guivic\LaravelAsaas\LaravelAsaasService;
use guivic\LaravelAsaas\Tests\TestCase;

class LaravelAsaasTest extends TestCase
{
    /**
     * @test
     */ 
    public function it_will_create_subscription_payment() {

        // sub_dLfEBEmXfwmM

        $arr["customer"] = "cus_000002274795";
        $arr["billingType"] = "CREDIT_CARD";
        $arr["nextDueDate"] = "2020-05-15";
        $arr["value"] = 399.9;
        $arr["cycle"] = "MONTHLY";
        $arr["description"] = "Assinatura Plano Pró";
        $arr["discount"]["value"] = 10;
        $arr["discount"]["dueDateLimitDays"] = 0;
        $arr["fine"]["value"] = 1;
        $arr["interest"]["value"] = 2;

        $arr["creditCard"]["holderName"] = "marcelo h almeida";
        $arr["creditCard"]["number"] = "5162306219378829";
        $arr["creditCard"]["expiryMonth"] = "05";
        $arr["creditCard"]["expiryYear"] = "2021";
        $arr["creditCard"]["ccv"] = "318";
        
        $arr["creditCardHolderInfo"]["name"] = "Marcelo Henrique Almeida";
        $arr["creditCardHolderInfo"]["email"] = "marcelo.almeida@gmail.com";
        $arr["creditCardHolderInfo"]["cpfCnpj"] = "24971563792";
        $arr["creditCardHolderInfo"]["postalCode"] = "89223-005";
        $arr["creditCardHolderInfo"]["addressNumber"] = "277";
        $arr["creditCardHolderInfo"]["addressComplement"] = null;
        $arr["creditCardHolderInfo"]["phone"] = "4738010919";
        $arr["creditCardHolderInfo"]["mobilePhone"] = "47998781877";
        
        
        $a = resolve(LaravelAsaasService::class);
        $response = $a->addSubscription($arr);
        
        dd($response);
    }

    /**
     * @test
     */ 
    public function it_will_create_client() {

        $faker = \Faker\Factory::create();

        $arr = [];
        $arr["name"] = $faker->firstname()." ".$faker->lastname();
        $arr["email"] = $faker->email();
        $arr["phone"] = "4738010919";
        $arr["mobilePhone"] = "4799376637";
        $arr["cpfCnpj"] = "24971563792";
        $arr["postalCode"] = "01310-000";
        $arr["address"] = "Av. Paulista";
        $arr["addressNumber"] = "150";
        $arr["complement"] = "Sala 201";
        $arr["province"] = "Centro";
        $arr["externalReference"] = "12987382";
        $arr["notificationDisabled"] = false;
        $arr["additionalEmails"] = "marcelo.almeida2@gmail.com,marcelo.almeida3@gmail.com";
        $arr["municipalInscription"] = "46683695908";
        $arr["stateInscription"] = "646681195275";
        $arr["observations"] = "ótimo pagador, nenhum problema até o momento";

        $a = resolve(LaravelAsaasService::class);
        $response = $a->addClient($arr);

        dd($response);
    }
}
