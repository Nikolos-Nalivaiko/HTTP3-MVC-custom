function overlayClose() {
    $('.overlay__close').on('click', function (event) {
        $('.overlay').fadeOut()
    })
}

function overlayRedirect(url)
{
    $('.overlay__close').on('click', function (event) {
        window.location.href = url;
    })
}

function UploadImage() {
    var selectedFiles = [];
    $('.file').on('change', function (event) {
        var files = event.target.files;

        const processFiles = async (files) => {
            for (const file of files) {
                if (file && file.type.startsWith('image')) {
                    var reader = new FileReader();

                    file.preview = 'No';
                    selectedFiles.push(file);

                    reader.onloadstart = function () {
                        var load = `<div class="loader"></div>`;
                        $('.input__images').append(load);
                    };

                    const imageLoaded = new Promise(resolve => {
                        reader.onload = function (e) {
                            resolve(e.target.result);
                            $('.input__images').find('.loader').remove();
                        };
                    });

                    reader.readAsDataURL(file);

                    const imageUrl = await imageLoaded;

                    var image = `<div class="input__image-wrapper">
                    <p class="input__image-icon __icon-close"></p>
                    <img src="${imageUrl}" class="input__image">
                    </div>`;

                    $('.input__images').append(image);


                }
            }
        };

        $('.input__images').on('click', '.input__image-icon', function () {
            var clickedElement = $(this);
            var parentElements = clickedElement.closest('.input__image-wrapper');
            var index = $('.input__images .input__image-wrapper').index(parentElements);

            selectedFiles.splice(index, 1);
            parentElements.fadeOut('slow', function () {
                $(this).remove();
            });
        })

        $('.input__images').on('click', '.input__image-wrapper', function () {
            var clicked = $(this);
            var index = $('.input__images .input__image-wrapper').index(clicked);
            selectedFiles[index].preview = 'Yes';
        })

        var fileInput = $('.file')[0];
        var files = fileInput.files;
        processFiles(files);
    })
    
}

function Slider(track, container, prevBtn, nextBtn, items, SlideToShow, SlideToScroll, margin, adaptives, swipeArea) {

    let itemCount = items.length;
    let position = 0;
    let counterItems = itemCount;
    let counter = SlideToShow

    adaptives.forEach(item => {
        if(window.innerWidth <= item.width) {
            SlideToShow = item.count
            counter = SlideToShow;
        } 
    });

    updateCounterDisplay();

    swipe(); 

    let ItemWidth = Math.round((container.width() / SlideToShow) - (margin * (SlideToShow - 1)) / SlideToShow);

    items.each((index, item) => {
        $(item).css({
            minWidth: ItemWidth,
            marginRight: margin,
        });
    });

    nextBtn.click(moveRight);
    prevBtn.click(moveLeft);

    function moveRight() {
        ItemsLeft = itemCount - Math.round((Math.abs(position) + (SlideToShow * ItemWidth) + (SlideToScroll * margin)) / ItemWidth);

        let movePosition = (SlideToScroll * ItemWidth) + (SlideToScroll * margin); 
            
        position -= ItemsLeft > SlideToScroll ? movePosition : (ItemsLeft * ItemWidth) + (ItemsLeft * margin);
    
        counter++;

        if(ItemsLeft == 0) {
            position = 0;
            counter = SlideToShow;
        }
    
        track.css({
            transform:`translateX(${position}px)`
        })
        updateCounterDisplay();
    }

    function moveLeft() {
        ItemsLeft = Math.round(Math.abs(position) / ItemWidth);
        
        let movePosition = (SlideToScroll * ItemWidth) + (SlideToScroll * margin);
        
        position += ItemsLeft > SlideToScroll ? movePosition : (ItemsLeft * ItemWidth) + (ItemsLeft * margin);
    
        if(ItemsLeft == 1) {
            counter = SlideToShow;
        } 

        if(ItemsLeft > 1) {
            counter--;
        }
    
        track.css({
            transform:`translateX(${position}px)`
        })  
        updateCounterDisplay();    
    }

    function swipe() {
        swipeArea.on('touchstart', (event) => {
            touchStartX = event.originalEvent.touches[0].pageX;
        });

        swipeArea.on('touchend', (event) => {
            touchEndX = event.originalEvent.changedTouches[0].pageX;
            touchSum = touchStartX - touchEndX;

            let absTouckSum = Math.abs(touchSum);
    
            if (touchSum > 0 && absTouckSum > 50) {
                moveRight();
            } else if (touchSum < 0 && absTouckSum > 50) {
                moveLeft();
            }
            updateCounterDisplay();
        });
    }
    
    function updateCounterDisplay() {
        $('.car__control-text').html(`<span class="car-info__slider-count--span">${counter}</span> / ${counterItems}`);
    }
}

function loading() {
    $(document).ready(function() {
        $('.load-page').fadeOut();
    });
}

function openFilter() {
    $('.filter__btn-setting').on('click', function (event) {
        if ($(window).width() <= 768) {
            $('.filter__form').fadeToggle().css("display", "block");
        } else {
            $('.filter__extra-inputs').fadeToggle().css("display", "grid");
        }
    })
}

function openMenu() {
    
    $('.navbar__menu-start').on('click', function(){
        $(this).toggleClass("__icon-close");
        $('.menu--mobile').fadeToggle();
    })

    $('.menu--mobile__block').on('click', '.menu--mobile__item', function() {
        var subitemWrap = $(this).siblings('.menu--mobile__subitem-wrap');
        $(this).find('.menu--mobile__icon').toggleClass('menu--mobile__icon--active')
        $(this).toggleClass('menu--mobile__item--active');
        subitemWrap.fadeToggle();
    });
}

function tabsControl() {
    $("#cargosContent").show();
    $(".user__tab").on("click", function () {
        var tabId = $(this).attr("id");
        var contentId = tabId.replace("Tab", "Content");

        $(".user__content").hide();
        $("#" + contentId).fadeIn();

        Slider(
            $('.reviews__track'),
            $('.reviews__slider'),
            $('.__prev'),
            $('.__next'),
            $('.reviews__block'),
            2,
            1,
            30,
            [{
                width: '768',
                count: '1'
            }, ],
            $('.reviews__track')
        );

        Slider(
            $('.user__setting-track'),
            $('.user__setting-slider'),
            $('.__prevSetting'),
            $('.__nextSetting'),
            $('.user__setting-nav-block'),
            3,
            1,
            30,
            [{
                    width: '992',
                    count: 2
                },
                {
                    width: '768',
                    count: 1
                }
            ],
            $('.user__setting-slider')
        );

    })
}

function phoneMask() {
    $('#phone').mask("+38 (999) 999-99-99")
}

function visiblePass() {
    let icons = $(".__icon-visible_pass");

    icons.each(function(index, icon) {
        $(this).click(function() {
            var pass = $(this).closest('.input__wrapper').find('.input--password');
    
            if(pass.prop("type") === 'password') {
                pass.prop("type", "text");
            } else {
                pass.prop("type", "password");
            }
        });
    }); 
}

// Files Viewer \\

function fileView(formSelector)
{
    var fileInput = $(formSelector).find('input[type="file"]');
    
    fileInput.change(function(e) {
        var files = Array.from(e.target.files);
        $('.input__images').empty();
        loadFiles(files, fileInput);
    });
}

function loadFiles(files, fileInput) {
    function loadFile(index) {
        if (index >= files.length) return;

        var file = files[index];
        var reader = new FileReader();

        reader.onload = function(e) {
            var imgWrapper = createImage(e.target.result, file.name);
            $('.input__images').append(imgWrapper);

            imgWrapper.find('.__icon-close').click(function() {
                imgWrapper.css('display', 'none');
                files = files.filter(f => f.name !== file.name);
                updateFileInput(files, fileInput);
            });

            loadFile(index + 1);
        };

        reader.readAsDataURL(file);
    }

    loadFile(0);
}

function createImage(imageSrc, fileName) {
    return $(`
        <div class="input__image-wrapper">
            <p class="input__image-icon __icon-close"></p>
            <img src="${imageSrc}" class="input__image" data-file-name="${fileName}">
        </div>
    `);
}

function updateFileInput(files, fileInput)
{
    var dataTransfer = new DataTransfer();
    files.forEach(function(file) {
        dataTransfer.items.add(file);
    });
    fileInput[0].files = dataTransfer.files;
}

// Regions work \\

function RegionChange(regionSelector, citySelector, url)
{
    $(regionSelector).on('change', function() {
        var selectedOption = $(this).find(":selected");
        var selectedValue = selectedOption.val();

        const data = {
            region: selectedValue
        };

        fetchCities(data, citySelector, url);
    });
}

function fetchCities(data, citySelector, url) {
    $.ajax({
        url: url,
        type: 'POST',
        contentType: 'application/json',
        dataType: 'json',
        data: JSON.stringify(data),
        success: function(response) {
            updateCityOptions(response, citySelector);
        },
        error: function(xhr, status, error) {
            handleAjaxError(xhr);
        }
    });
}

function updateCityOptions(cities, citySelector) {
    var $citySelect = $(citySelector);
    $citySelect.empty();
    $citySelect.append('<option disabled selected hidden class="input__option" value=""> </option>');

    $.each(cities, function(index, city) {
        $citySelect.append('<option class="input__option" value="' + city + '">' + city + '</option>');
    });
}

function handleAjaxError(xhr) {
    console.log(xhr.responseText);
}

// Validation 

function validateField(fieldName, fieldValue, rules) {
    var fieldRules = rules[fieldName];

    if (fieldRules != null) {
        for (var rule in fieldRules) {
            switch (rule) {
                case 'min_length':
                    var minLength = fieldRules[rule];
                    if (fieldValue.length < minLength)
                    {
                        return false;
                    }
                    break;
                case 'max_length':
                    var maxLength = fieldRules[rule];
                    if (fieldValue.length > maxLength)
                    {
                        return false;
                    }
                    break;    
                case 'required':
                    if (fieldValue.trim() === '')
                    {
                        return false;
                    }
                    break;
                case 'same':
                    var sameField = fieldRules[rule];
                    if (fieldValue !== $('#' + sameField).val()) 
                    {
                        return false;
                    }
                    break;
                case 'strongRegex':
                    var specialChars = /[ !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
                    if (specialChars.test(fieldValue)) {
                        return false;
                    }
                    break; 
                case 'lightRegex':
                    var specialChars = /[ !@#$%^&*()_+\-=\[\]{};':\\|,<.>\/]/;
                    if (specialChars.test(fieldValue)) {
                        return false;
                    }
                    break;
                    
                    case 'email':
                        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailPattern.test(fieldValue)) {
                            return false;
                        }
                        break;                    
            }
        }
    }
    return true; 
}

function transformField(fieldName, status) {
    var $field = $('#' + fieldName);
    var $wrapper = $field.closest('.input__wrapper');
    var color = status ? '#5BB318' : 'red';
    var focusOutColor = status ? '#5F5F5F' : 'red';
    var focusOutLabelColor = status ? '#C8C8C8' : 'red';
    
    $field.css('border-color', status ? '' : color);
    $wrapper.find('.input__icon').css('color', color);
    $wrapper.find('.input__label').css('color', color);
    
    $field.off('focusin focusout').on('focusin', function() {
        $field.css('border-color', status ? '' : color);
        $wrapper.find('.input__icon').css('color', color);
        $wrapper.find('.input__label').css('color', color);
    }).on('focusout', function() {
        $field.css('border-color', status ? '' : color);
        $wrapper.find('.input__icon').css('color', focusOutColor);
        $wrapper.find('.input__label').css('color', focusOutLabelColor);
    });
}

function validateInputsForm(formSelector, rules) {
    $(formSelector).find('input').on('input', function() {
        var fieldName = $(this).attr('id');
        let isValid = validateField(fieldName, $(this).val(), rules);
        transformField(fieldName, isValid);
    });
}

function validateForm(form, rules) {
    var formIsValid = true;

    $(form).find('input').each(function() {
        var fieldName = $(this).attr('id');
        var fieldValue = $(this).val();
        
        if (!validateField(fieldName, fieldValue, rules)) {
            formIsValid = false;
        } 
    });

    if (formIsValid) {
        return true; 
    } else {
        return false; 
    }
}

// ------------------------------------------- \\

function userSignUpValidateForm(formSelector, url)
{
    var rules = {
        'password': {'min_length': 2, 'required': true, 'max_length': 10, 'strongRegex': true},
        'confirm': { 'min_length': 2, 'required': true, 'max_length': 10, 'strongRegex': true, 'same':'password'},
        'login': { 'min_length': 2, 'required': true, 'max_length': 10, 'strongRegex': true},
        'user_name': { 'min_length': 2, 'required': true, 'lightRegex': true},
        'middle_name': { 'min_length': 2, 'required': true, 'lightRegex': true},
        'last_name': { 'min_length': 2, 'required': true, 'lightRegex': true},
        'email': { 'email': true, 'required': true},
    };

    validateInputsForm(formSelector, rules);
    $(formSelector).submit(function(event) {
        if(validateForm(this, rules)) {
            var $form = $(formSelector);
            var FormData = getFormData($form);
            var jsonData = JSON.stringify(FormData);
            sendFormData(jsonData, formSelector, url);
        }
    })  
}

function logInValidate(formSelector, url)
{
    var rules = {
        'password': {'min_length': 2, 'required': true, 'max_length': 10, 'strongRegex': true},
        'login': { 'min_length': 2, 'required': true, 'max_length': 10, 'strongRegex': true},
    };

    validateInputsForm(formSelector, rules);
    $(formSelector).submit(function(event) {
        if(validateForm(this, rules)) {
            var $form = $(formSelector);
            var FormData = getFormData($form);
            var jsonData = JSON.stringify(FormData);
            sendFormSignIn(jsonData, url);
        }
    })
}

// Send form \\

function getFormData($form) {
    var formData = {};
    $form.serializeArray().forEach(function(item) {
        formData[item.name] = item.value;
    });
    return formData;
}

function sendFormData(jsonData, formSelector, url) {
    $.ajax({
        url: url,
        type: 'POST',
        contentType: 'application/json',
        dataType: 'json',
        data: jsonData,
        success: function(response) {
            handleSignUpSuccess(response, formSelector);
        },
        error: function(xhr, status, error) {
            handleAjaxError(xhr);
        }
    });
}

function sendFormSignIn(jsonData, url) {
    $.ajax({
        url: url,
        type: 'POST',
        contentType: 'application/json',
        dataType: 'json',
        data: jsonData,
        success: function(response) {
            console.log(response);
            if(response == true)
            {
                $('.overlay--success').fadeIn();
                overlayRedirect('/');
            } else 
            {
                $('.overlay--error').fadeIn();
                overlayClose();
            }
        },
        error: function(xhr, status, error) {
            handleAjaxError(xhr);
        }
    });
}

function handleSignUpSuccess(response, formSelector) {
    if (response.userId) {
        var userId = response.userId;
        var formData = collectFilesData(userId, formSelector);
        
        if (!formData.entries().next().done) {
            sendFilesData(formData);
        } 
        
        $('.overlay--success').fadeIn();
        overlayRedirect('/');
    } else {
        $('.overlay--error').fadeIn();
        overlayRedirect('/');
    }
}

function collectFilesData(userId, formSelector) {
    var formData = new FormData();
    $(formSelector).find('input[type="file"]').each(function() {
        var files = this.files;
        for (var i = 0; i < files.length; i++) {
            formData.append(this.name, files[i]);
        }
    });
    formData.append('userId', userId);
    return formData;
}

function sendFilesData(formData) {
    $.ajax({
        url: '/sign-up/user',
        type: 'POST',
        processData: false,
        contentType: false,
        data: formData,
        success: function() {},
        error: function(xhr, status, error) {
            handleAjaxError(xhr);
        }
    });
}