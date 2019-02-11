import validateEmail from '../validator/emailValidator';
import formValidator from '../validator/formValidator';
import AutocompletedAddressForm from '../services/address/AutocompletedAddressForm';
import AddressObject from '../services/address/AddressObject';

export default (formType) => {
    const form = dom('form[name="adherent_registration"]') || dom('form[name="become_adherent"]');
    const emailField = dom('#adherent_registration_emailAddress_first');
    const confirmEmailField = dom('#adherent_registration_emailAddress_second');
    const genderField = dom('#adherent_registration_gender');
    const customGenderField = dom('#adherent_registration_customGender');
    let zipCodeField = dom('#adherent_registration_address_postalCode');
    const captchaBlock = dom('div.g-recaptcha');

    if (!zipCodeField) {
        zipCodeField = dom('#become_adherent_address_postalCode');
    }

    const regionField = dom('#adherent_registration_address_region');
    const countryField = dom('#adherent_registration_address_country');
    const cityNameField = dom('#adherent_registration_address_cityName');

    hide(regionField);

    const address = new AddressObject(
        dom('#adherent_registration_address_address'),
        dom('#adherent_registration_address_postalCode'),
        cityNameField,
        regionField,
        countryField
    );

    const autocompleteAddressForm = new AutocompletedAddressForm(
        dom('.address-autocomplete'),
        dom('.address-block'),
        address
    );

    autocompleteAddressForm.once('changed', () => {
        countryField.dispatchEvent(new CustomEvent('change', {
            target: countryField,
            detail: {
                zipCode: zipCodeField.value,
                cityName: cityNameField.value,
            },
        }));
    });

    autocompleteAddressForm.buildWidget();

    /**
     * Display/hide the second email field according the value of first email field
     *
     * @param event
     */
    const checkEmail = (event) => {
        if (validateEmail(event.target.value)) {
            removeClass(confirmEmailField.parentElement, 'visually-hidden');
        } else {
            addClass(confirmEmailField.parentElement, 'visually-hidden');
        }
    };

    /**
     * Display/hide the custom gender field according if the gender field value is "other"
     *
     * @param event
     */
    const checkGender = (event) => {
        if ('other' === genderField.value) {
            removeClass(customGenderField.parentElement, 'visually-hidden');
        } else {
            addClass(customGenderField.parentElement, 'visually-hidden');
            customGenderField.value = '';
        }
    };

    /**
     * Display captcha block when the ZipCode is filled and remove the listener from ZipCode field
     *
     * @param event
     */
    const displayCaptcha = (event) => {
        if (captchaBlock
            && event.target.value
            && -1 !== captchaBlock.parentElement.className.indexOf('visually-hidden')
        ) {
            removeClass(captchaBlock.parentElement, 'visually-hidden');
            off(zipCodeField, 'input', displayCaptcha);
        }
    };

    if (emailField) {
        on(emailField, 'input', checkEmail);
        emailField.dispatchEvent(new Event('input'));
    }

    if (genderField) {
        on(genderField, 'change', checkGender);
    }

    on(zipCodeField, 'input', displayCaptcha);
    zipCodeField.dispatchEvent(new Event('input'));

    formValidator(formType, form);
};
