import * as flsFunctions from "./modules/functions.js";
// import * as swipers from "./modules/swipers.js";
import * as sendForms from "./modules/sendForms.js";
import * as images from "./modules/images.js";
import * as geo from "./modules/geo.js";

// swipers.reviewsSwiper();
// $('#phone').mask("+38 (999) 999-99-99")

var rules = {
    'password': {'min_length': 4, 'required': true, 'max_length': 15, 'strongRegex': true},
    'confirm': {'min_length': 4, 'required': true, 'max_length': 15, 'strongRegex': true, 'same':'password'},
    'login' : {'min_length': 4, 'required': true, 'max_length': 15, 'lightRegex': true},
    'username' : {'min_length': 4, 'required': true, 'max_length': 15, 'lightRegex': true},
    'middlename' : {'min_length': 4, 'required': true, 'max_length': 15, 'lightRegex': true},
    'lastname' : {'min_length': 4, 'required': true, 'max_length': 15, 'lightRegex': true},
};
sendForms.initForm('#createUser', rules);
images.fileViewSingle('#createUser');
geo.RegionChange('#region', '#city', '/sign-up/user');

var rules = {
    'password': {'min_length': 4, 'required': true, 'max_length': 15, 'strongRegex': true},
    'login' : {'min_length': 4, 'required': true, 'max_length': 15, 'lightRegex': true},
};
sendForms.initForm('#signIn', rules);

rules = {
    'name' : {'min_length': 4, 'required': true, 'max_length': 15, 'lightRegex': true},
    'description' : {'required': true, 'lightRegex': true},
}
sendForms.initForm('#createCargo', rules);

rules = {
    'description' : {'lightRegex': true},
}
sendForms.initForm('#createCar', rules);
images.fileViewArray('#createCar');
