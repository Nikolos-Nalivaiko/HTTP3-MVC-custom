export function validateField(field, value, rules)
{
    if(!rules || !rules[field])
    {
        return true;
    }

    var isValid = true;
    var fieldRules = rules[field];
    var errorMessage = '';

    $.each(fieldRules, function(rule, ruleValue){
        switch (rule) {
            case 'min_length':
                if (value.length < ruleValue) {
                    isValid = false;
                    errorMessage = `Мінімальна довжина ${ruleValue} символів`;
                }
                break;
            case 'max_length':
                if (value.length > ruleValue) {
                    isValid = false;
                    errorMessage = `Максимальна довжина ${ruleValue} символів`;
                }
                break;
            case 'required':
                if (ruleValue && $.trim(value) === '') {
                    isValid = false;
                    errorMessage = `Це поле є обов\'язковим`;
                }
                break;
            case 'strongRegex':
                var strongRegex = /^[a-zA-Zа-яА-ЯіІїЇєЄґҐ0-9]*$/;
                if (!strongRegex.test(value))
                {
                    isValid = false;
                    errorMessage = `Поле має невірний формат`;
                }
                break;
            case 'lightRegex':
                var lightRegex = /^[a-zA-Zа-яА-ЯіІїЇєЄґҐ0-9,."':;]*$/;
                if(!lightRegex.test(value))
                {
                    isValid = false;
                    errorMessage = `Поле має невірний формат`;
                }
                break;
            case 'same':
                var otherField = ruleValue;
                var otherValue = $('[name="' + otherField + '"]').val();
                if (value !== otherValue) {
                    isValid = false;
                    errorMessage = `Поле не відповідає попередньому`;
                }
                break;
            case 'email':
                // Перевірка на коректність електронної пошти
                // isValid = isValidEmailAddress(value);
                break;
        }

        $('input').on('focus', function() {
            applyFocusStyles($(this));
        });
        
        $('input').on('blur', function() {
            applyBlurStyles($(this));
        });

        if(!isValid)
        {
            setFieldError(field, errorMessage);
            return false;
        } else
        {
            clearFieldError(field);
        }
        
    });

    return isValid;
}

export function validateForm(form, rules)
{
    var isValid = true;

    $.each(rules, function(field, fieldRules) {
        var value = $('[name="' + field + '"]', form).val();
        var fieldValid = validateField(field, value, rules);
        
        $('[name="' + field + '"]', form).data('valid', fieldValid);
        
        if (!fieldValid) {
            isValid = false;
        }

    });

    return isValid;    
}

function applyFocusStyles(input) {
    var wrapper = input.closest('.input');
    if (!input.hasClass('error')) {
        wrapper.find('.input__wrapper').css('border-color', '#5BB318'); // Колір при фокусі
        wrapper.find('.input__icon').css('color', '#5BB318');
        wrapper.find('.input__label').css('color', '#5BB318');
    }
}

function applyBlurStyles(input) {
    var wrapper = input.closest('.input');
    if (!input.hasClass('error')) {
        wrapper.find('.input__wrapper').css('border-color', '#DBDBDB'); // Повернення до початкового кольору при втраті фокусу, якщо немає помилки
        wrapper.find('.input__icon').css('color', '#5F5F5F');
        wrapper.find('.input__label').css('color', '#5F5F5F');
    }
}

function setFieldError(field, errorMessage)
{
    var fieldElement = $('[name="' + field + '"]');
    var wrapper = fieldElement.closest('.input');
    var errorElement = wrapper.find('.error-message');

    fieldElement.addClass('error');
    errorElement.text(errorMessage);

    wrapper.find('.input__wrapper').css('border-color', '#D21312');
    wrapper.find('.input__icon').css('color', '#D21312');
    wrapper.find('.input__label').css('color', '#D21312');
}

function clearFieldError(field)
{
    var fieldElement = $('[name="' + field + '"]');
    var wrapper = fieldElement.closest('.input');
    var errorElement = wrapper.find('.error-message');

    fieldElement.removeClass('error');
    errorElement.text('');
    
    if (fieldElement.is(':focus')) {
        applyFocusStyles(fieldElement);
    } else {
        applyBlurStyles(fieldElement);
    }    
}