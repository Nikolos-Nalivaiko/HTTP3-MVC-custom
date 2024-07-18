export function openPopupClose(popup)
{
    $(popup).fadeIn();
    closePopup(popup);
}

export function openPopupRedirect(popup)
{
    $(popup).fadeIn();
    redirectPopup(popup);
}

function closePopup(popup)
{
    $('.popup__btn').on('click', function (event) {
        $(popup).fadeOut()
    })
}

function redirectPopup(popup)
{
    $('.popup__btn').on('click', function (event) {
        window.location.href = 'index.html';
    })
}