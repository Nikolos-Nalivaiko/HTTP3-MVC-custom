export function RegionChange(selectorRegion, selectorCity, url)
{
    $(selectorRegion).on('change', function() {
        var selectedOption = $(this).find(":selected");
        var selectedValue = selectedOption.val();

        const data = {
            region: selectedValue
        };

        fetchCities(data, selectorCity, url);
    });
}

function fetchCities(data, selectorCity, url) {
    $.ajax({
        url: url,
        type: 'POST',
        contentType: 'application/json',
        dataType: 'json',
        data: JSON.stringify(data),
        success: function(response) {
            updateCityOptions(response, selectorCity);
        },
    });
}

function updateCityOptions(cities, selectorCity) {
    var $citySelect = $(selectorCity);
    $citySelect.empty();
    $citySelect.append('<option disabled selected hidden class="input__option" value=""> </option>');

    $.each(cities, function(index, city) {
        $citySelect.append('<option value="' + city + '"" class="create__option">' + city + '</option>');
    });
}