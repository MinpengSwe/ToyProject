//this is front end code!!!!!!!!!!!!!!!!
//You can get some code reference from https://stripe.com/docs/stripe.js
//in order to identify with the stripe server, send the credit card data, then stripe server send back a token which takes
//the publishable key into account and encripted, later u can use this token in your php code to make a charge, there u will
//connect with your secret key, with this combination of token based public key and your secret key, so stripe can be sure
//there is nothing fishy going on, e.g the user validate the credit card is also the one making the purchase
Stripe.setPublishableKey('pk_test_16Cl4b2Zn7avIxcmirvfjwOO');

//grab the form, #checkout-form, which is the form name in checkout.blade.php
var $form = $('#checkout-form');

//this is a jQuery method, validate form(credit card infor)
$form.submit(function(event){
    //charge-error is the div id in checkout.js
    //if there is no error, nothing for error to show
    $('#charge-error').addClass('hidden');
    //this is Jquery code and disable user to click it more than once to submit credit card data to stripe
    //ensure the time for stripe to answer
    $form.find('button').prop('disable', true);
    Stripe.card.createToken({
        //# means it is a attribute id
        number: $('#card-number').val(),
        cvc: $('#card-cvc').val(),
        exp_month: $('#card-expiry-month').val(),
        exp_year: $('#card-expiry-year').val(),
        name: $('#card-name').val()
    }, stripeResponseHandler);
    //means that all code submit above, send request to stripe and wait for response of form (credit card) validation,
    // don't continue the form submission
    return false;
});

function stripeResponseHandler(status, response) {
    if(response.error){
        //select error div in checkout.js, if there is an error, show it
        $('#charge-error').removeClass('hidden');
        //show the error message
        $('#charge-error').text(response.error.message);
        //enable the button again
        $form.find('button').prop('disable', false);
    }else{
        //Token was created
        //get the token ID
        var token=response.id;

        //insert the token into the form so it gets submitted to the server
        $form.append($('<input type="hidden" name="stripeToken" />').val(token));

        //submit the form
        $form.get(0).submit();
    }
}

