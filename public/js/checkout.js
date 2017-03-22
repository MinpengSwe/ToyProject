
//in order to identify with the stripe server, send the credit card data, then stripe server send back a token which takes
//the publishable key into account and encripted, later u can use this token in your php code to make a charge, there u will
//connect with your secret key, with this combination of token based public key and your secret key, so stripe can be sure
//there is nothing fishy going on, e.g the user validate the credit card is also the one making the purchase 
Stripe.setPublishableKey('pk_test_16Cl4b2Zn7avIxcmirvfjwOO');