<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use TPay\API\API\AppB2C;
use TPay\API\API\AppBalances;
use TPay\API\API\AppC2BSTKPush;
use TPay\API\API\ExpressPayment;

class APIController extends Controller
{
    /**
     * ---------------------------------
     *  Requesting app balance [ GET Request  ]
     * ---------------------------------
     * @throws Exception
     */
    public function appBalance()
    {
        try {
            //Set request options as shown here
            $options = [
                'secretCode' => config('tpay.app_secret_code'),//This has to be your app T_PAY_APP_SECRET_CODE
            ];

            //make request here
            $response = AppBalances::appBalances($options);

            dd($response);

            //continue with what you what to do with the $response here
        } catch (Exception $exception) {
            //TODO If an exception occurs
        }
    }


    /**
     * ------------------
     * Express Payment [ POST Request ]
     * -----------------
     * This is used to directly get payment from
     * a client account to your application
     * @throws Exception
     */
    public function expressPayment()
    {
        try {
            $options = [
                'referenceCode' => '',//Unique referenceCode i.e TPXXXXX
                'redirectURL' => '',//This is the URL that the user will be redirect after payment
                'resultURL' => '',//This is the url that will receive the response data after successful payment. Note that this has to be a post callback so remember to use post in your callback.
                'amount' => 1,//amount to be paid
            ];

            //make the request here
            $response = ExpressPayment::expressPayment($options);

            //proceed with the response

        } catch (Exception $exception) {
            //TODO If an exception occurs
        }
    }


    /**
     * ------------------------------------
     * Making app stk push request for c2b  [ POST Request ]
     * ------------------------------------
     */
    public function appC2BSTKPush()
    {
        try {
            //Set request options as shown here
            $options = [
                'secretCode' => config('tpay.app_secret_code'),//This has to be your app T_PAY_APP_SECRET_CODE
                'phoneNumber' => 254713255791,//The phone number has to be 2547xxxxxxx
                'referenceCode' => 'TP' . Str::random(10),//The secret code should be unique in every request you send and must start with TPXXXX
                'amount' => 1,//Amount has to be an integer and less than or equal to KES 70000
                'resultURL' => route('app.response'),//This has to be your callback i.e https://mydomain/callback or http://mydomain/callback. Also note that this has to be a post callback so remember to use post in your callback.
            ];

            //make the c2b stk push here
            $response = AppC2BSTKPush::appC2BSTKPush($options);

            dd($response);

            //continue with what you what to do with the $response here
        } catch (Exception $exception) {
            //TODO If an exception occurs
        }
    }

    /**
     * ------------------------------------
     * Making app withdraw request for b2c  [ POST Request ]
     * ------------------------------------
     */
    public function appB2C()
    {
        try {
            //Set request options as shown here
            $options = [
                'secretCode' => '',//This has to be your app T_PAY_APP_SECRET_CODE
                'phoneNumber' => '',//The phone number has to be 2547xxxxxxx
                'referenceCode' => '',//The secret code should be unique in every request you send and must start with TPXXXX
                'amount' => 1,//Amount has to be an integer and has to be greater than KES 10
                'resultURL' => '',//This has to be your callback i.e https://mydomain/callback or http://mydomain/callback. Also note that this has to be a post callback so remember to use post in your callback.
            ];

            //make the b2c withdraw here
            $response = AppB2C::appB2C($options);

            //continue with what you what to do with the $response here
        } catch (Exception $exception) {
            //TODO If an exception occurs
        }
    }
}
