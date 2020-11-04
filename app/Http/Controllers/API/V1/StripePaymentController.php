<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\BaseController as BaseController;
use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;
use Stripe\Error\Card;
use Validator;

class StripePaymentController extends BaseController
{
    public function postStripePayment(Request $request){
        $validator = Validator::make($request->all(), [
            'stripeToken' => 'required',
            'amount' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $stripe = Stripe::make(env('STRIPE_SECRET'));
        try{
            $charge = $stripe->charges()->create([
                'amount' => $request->amount,
                'currency' => env('CURRENCY_CODE'),
                'source' => $request->stripeToken,
                'description' => 'Une description',
            ]);
            if($charge['status'] == 'succeeded') {
                return $this->sendResponse($charge, 'Payment Success !');
            } else {
                return $this->sendError('Money not add in wallet !');
            }
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
            return $this->sendError($e->getMessage());
        } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
            return $this->sendError($e->getMessage());
        }
    }
}
