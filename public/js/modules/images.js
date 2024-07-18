export function fileViewSingle(formSelector)
{
    var fileInput = $(formSelector).find('input[type="file"]');
    
    fileInput.change(function(e) {
        var files = Array.from(e.target.files);
        $('.create__images').empty();
        $('.create__images').append(`
        <div class="create__loader-wrapper">
        <div class="loader create__loader" id="loader"></div>
        </div>
        `);
        loadFiles(files, fileInput);
    });
}

export function fileViewArray(formSelector) {
    var fileInput = $(formSelector).find('input[type="file"]');
    
    fileInput.change(function(e) {
        var newFiles = Array.from(e.target.files);
        $('.create__loader-wrapper').show();
        loadFiles(newFiles, fileInput);
        console.log('Current files in input after change:', fileInput[0].files);
    });
}

function loadFiles(newFiles, fileInput) {
    function loadFile(index) {
        if (index >= newFiles.length) {
            $('.create__loader-wrapper').hide();
            checkAndSetMainPhoto(); // Перевірка та встановлення головного фото після додавання всіх нових файлів
            return;
        }

        var file = newFiles[index];
        var reader = new FileReader();

        reader.onload = function(e) {
            var imgWrapper = createImage(e.target.result, file.name);
            $('.create__images').append(imgWrapper);

            imgWrapper.find('.create__image-close').click(function() {
                imgWrapper.remove();
                updateFileInput(fileInput);
                checkAndSetMainPhoto();
                console.log('File removed. Current files in input after removal:', fileInput[0].files);
            });

            imgWrapper.find('.create__image').click(function() {
                setMainPhoto(file.name);
            });

            loadFile(index + 1);
        };

        reader.readAsDataURL(file);
    }

    loadFile(0);
}

function createImage(imageSrc, fileName) {
    return $(`
    <div class="create__image-wrapper">
        <p class="create__image-close __icon-error"></p>
        <img src="${imageSrc}" class="create__image" data-file-name="${fileName}">
    </div>
    `);
}

function updateFileInput(fileInput) {
    var remainingFiles = [];
    $('.create__image').each(function() {
        var fileName = $(this).data('file-name');
        var file = Array.from(fileInput[0].files).find(f => f.name === fileName);
        if (file) {
            remainingFiles.push(file);
        }
    });

    var dataTransfer = new DataTransfer();
    remainingFiles.forEach(function(file) {
        dataTransfer.items.add(file);
    });
    fileInput[0].files = dataTransfer.files;
    console.log('Updated files in input:', fileInput[0].files);
}

function setMainPhoto(fileName) {
    $('.create__image').removeClass('main-photo');
    $('.create__image[data-file-name="' + fileName + '"]').addClass('main-photo');
}

function checkAndSetMainPhoto() {
    if ($('.create__image.main-photo').length === 0 && $('.create__image').length > 0) {
        var firstImage = $('.create__image').first();
        firstImage.addClass('main-photo');
    }
}