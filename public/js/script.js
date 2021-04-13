$(function () {
    var countrySelect = $('#country');
    var citySelect = $('#city');
    countrySelect.change(function () {
        var countryId =$(this).val();
        var html = "<option value=''>Выберите город</option>";
        if (countryId > 0) {
            $.post("/ajax", {
                "country_id" : countryId,
                "_token" : $('meta[name="csrf-token"]').attr('content')
            }).done(function (data) {
                if (data) {
                    $.each(data, function (k, obCity) {
                        html += '<option value="' + obCity.id + '">' + obCity.title + '</option>'
                    });
                    citySelect.html(html)
                }
            }).fail(function () {
                alert("Невозможно подключиться к серверу, повторите попытку позже.");
            });
        } else {
            citySelect.html(html);
        }
    });
});



