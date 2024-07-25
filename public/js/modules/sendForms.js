import { validateForm, validateField } from './validation.js';
import { openPopupClose, openPopupRedirect } from './popup.js';

function handleFormSend(event, rules) {
    event.preventDefault();

    const form = event.target;

    var isValid = validateForm(form, rules);

    if (!isValid) {
        openPopupClose('.popup__overlay--error');
        return;
    }

    const formData = new FormData(form);
    const jsonObject = {};
    let hasFile = false;
    let mainPhotoName = null;

    formData.forEach((value, key) => {
        if (value instanceof File && value.size > 0) {
            hasFile = true;
        } else {
            jsonObject[key] = value;
        }
    });

    if ($('.create__image.main-photo').length > 0) {
        mainPhotoName = $('.create__image.main-photo').data('file-name');
    }

    if (mainPhotoName) {
        jsonObject['mainPhoto'] = mainPhotoName;
    }

    let url = form.action;

    if(url.includes('create'))
    {
        url = form.action.replace('create', 'uploadImage');
    } else
    {
        url = form.action.replace('update', 'uploadImage');
    }

    $.ajax({
        url: form.action,
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(jsonObject),
        success: function (data) {
            if(data.status) {
                const userId = data.userId;
                if(hasFile) {
                    const fileData = new FormData();
                    formData.forEach((value, key) => {
                        if (value instanceof File && value.size > 0) {
                            fileData.append(key, value);
                        }
                    });

                    fileData.append('userId', userId);

                    return sendFilesData(url, fileData);
                } else
                {
                    openPopupRedirect('.popup__overlay--success');
                    $('.popup__description').text(data.message); 
                }
            } else {
                openPopupClose('.popup__overlay--error');
                $('.popup__description').text(data.message);                
            }
        },
        error: function (error) {
            openPopupClose('.popup__overlay--error');
            $('.popup__description').text('Такий логін існує');
        }
    });
}

function sendFilesData(url, formData) {
    return $.ajax({
        url: url,
        type: "POST",
        processData: false,
        contentType: false,
        data: formData,
        success: function (data)
        {
            console.log(data);
            if(data.status == true)
            {
                openPopupRedirect('.popup__overlay--success');
                $('.popup__description').text(data.message);
            } else
            {
                openPopupClose('.popup__overlay--error');
                $('.popup__description').text(data.message); 
            }
        }
    });
}

export function initForm(formSelector, rules) {
    const form = $(formSelector);
    if (form.length) {
        form.find('input, textarea, select').on('input', function () {
            var field = $(this).attr('name');
            var value = $(this).val();
            validateField(field, value, rules);
        });

        form.on('submit', function (event) {
            handleFormSend(event, rules);
        });
    }
}