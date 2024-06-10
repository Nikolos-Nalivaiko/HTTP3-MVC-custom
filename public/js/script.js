function overlay() {
    $('.overlay__close').on('click', function (event) {
        $('.overlay').fadeOut()
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
