const submit_payment = document.getElementById('submit_payment');

var firstname = document.getElementById('firstName');
var lastname = document.getElementById('lastName');
var phone = document.getElementById('phone');
var address = document.getElementById('address');
var city = document.getElementById('city');
var zip = document.getElementById('zip');
var cc_number = document.getElementById('cc_number');
var cc_exp = document.getElementById('cc_exp');
var cc_cvc = document.getElementById('cc_cvc');



function testvalidity(input) {
    if (!input || input.value == "") {
        input.classList.add('is-invalid');
        input.addEventListener('input', function () {
            this.classList.remove('is-invalid');
        });
    }
}
// returns true or false
function validateCreditCardNumber(cardNumber) {
    cardNumber = cardNumber.split(' ').join("");
    if (parseInt(cardNumber) <= 0 || (!/\d{15,16}(~\W[a-zA-Z])*$/.test(cardNumber)) || cardNumber.length > 16) {
        return false;
    }
    var carray = new Array();
    for (var i = 0; i < cardNumber.length; i++) {
        carray[carray.length] = cardNumber.charCodeAt(i) - 48;
    }
    carray.reverse();
    var sum = 0;
    for (var i = 0; i < carray.length; i++) {
        var tmp = carray[i];
        if ((i % 2) != 0) {
            tmp *= 2;
            if (tmp > 9) {
                tmp -= 9;
            }
        }
        sum += tmp;
    }
    return ((sum % 10) == 0);
}

cc_number.addEventListener('change', function () {
    const valid_number = document.getElementById('valid_number');
    if (validateCreditCardNumber(this.value)) {
        valid_number.innerHTML = "Valid Card";
    } else {
        valid_number.classList.add('text-danger');
        valid_number.innerHTML = "Invalid Card";
        this.classList.add('is-invalid');

    }
})

submit_payment.addEventListener('click', (e) => {
    e.preventDefault();
    testvalidity(firstname);
    testvalidity(lastname);
    testvalidity(phone);
    testvalidity(address);
    testvalidity(city);
    testvalidity(zip);
    testvalidity(cc_number);
    testvalidity(cc_exp);
    testvalidity(cc_cvc);

});