// FIND INDIAN Cities
function find_cities() {

    jQuery('#UserCityId').empty();
    $.ajax({
        url: '/ajax/findCitiesByState?state_id=' + $('#UserStateId').val(),
        dataType: "json",
        success: function(msg) {
            var app = "<option value>Select City</option>";
            jQuery('#UserCityId').append(app);
            $.each(msg, function(i, text) {
                jQuery('#UserCityId').append(jQuery('<option></option>').val(i).html(text));
            });
        }
    });
}

function find_listing_cities() { 

    jQuery('#ListingCityId').empty();
    $.ajax({
        url: '/ajax/findCitiesByState?state_id=' + $('#ListingStateId').val(),
        dataType: "json",
        success: function(msg) {
            var app = "<option value>Select City</option>";
            jQuery('#ListingCityId').append(app);
            $.each(msg, function(i, text) {
                jQuery('#ListingCityId').append(jQuery('<option></option>').val(i).html(text));
            }); 
        }
    });
}



function findSubCategory() {
    $('#ListingSubCategoryId').empty();
    $.ajax({ 
        url: '/ajax/findSubCategoryByCategory?cat_id=' + $('#ListingCategoryId').val(),
        dataType: "json",
        success: function(msg) {
            var app = "<option value>Select Sub-Category</option>";
            jQuery('#ListingSubCategoryId').append(app);
            $.each(msg, function(i, text) {
                jQuery('#ListingSubCategoryId').append(jQuery('<option></option>').val(i).html(text));
            });
        } 
    });
}

 