var response = '<div class="col-sm-2">' +
    '<p>Custom Type</p>' +
    '</div>' +
    '<div class="col-sm-10">' +
    '<p><input type="text" name="type" class="form-control product-type type_text_" onkeyup="showType.call(this)" placeholder="Domain, Hosting, Book..."/></p>' +
    '</div>';
$('.product-type').on('change', function() {
    //var selected_val_sel1 = $( ".product-type option:selected" ).prop('value');
    if ($(this).val() == 'others') {
        $('.custom-options').html(response);
    } else if ($(this).val() == 'hosting') {
        $('.server_region_product').show();
    } else {
        $('.server_region_product').hide();
        $('.custom-options').html('');
    }
});
if ($('.product-type').val() == 'hosting') {
    $('.server_region_product').show();
}

$(function() {
    var $form = $('.delete_form');
    $form.submit(function(event) {
        // Disable the submit button to prevent repeated clicks:
        $form.find('.submit').prop('disabled', true);

        var r = confirm("Are you sure?");
        if (r == true) {
            $form.get(0).submit();
            return true;
        } else {
            return false;
        }
    });
});

function showType() {
    console.log($(this).val());

    if ($(this).val() == 'hosting') {
        $('.server_region_product').show();
    } else {
        $('.server_region_product').hide();
    }
}
var domainProvidersPaid = ['com', 'net', 'org', 'info', 'eu'];
var domainProviderFree = ['tk', 'ml', 'ga', 'cf', 'gq'];
// Call all nedded functions

function ajaxCall(domainName, domainProviders) {
    console.log('in ajax call');
    var data = {
        DomainName: domainName,
        DomainProviders: domainProviders,
        '_token': $('.checkDomainsSection input[name]').val()
    };
    $.ajax({
        type: "POST",
        url: '/mystore/domainCheck',
        data: data,
        async: false,
        cache: true,
        success: function(response) {
            data = response;
        },
        ajaxError: function(response) {
            data = response;
        },
        error: function(response) {
            data = response;
        }
    });
    return data;
}

Array.prototype.remove = function() {
    var what, a = arguments,
        L = a.length,
        ax;
    while (L && this.length) {
        what = a[--L];
        while ((ax = this.indexOf(what)) !== -1) {
            this.splice(ax, 1);
        }
    }
    return this;
};

function fireOnAct(query) {

}

var elements = [];

function selectDomain(query) {
    console.log('inselectdomain');
    if (query.checked) {
        if (!elements.includes(query.value)) {
            elements.push(query.value);
        }
    } else {
        elements.remove(query.value);
    }
    $('#urls').val(JSON.stringify(elements));
    if (elements.length == 0)
        $('#urls').val("");
    //          console.log('mujo1');
    //$('body').on('click', '.md-checkbox > label, .md-radio > label', function() {
    //              console.log('suljo');
    var the = $(this);
    //console.log('mujo2');
    // find the first span which is our circle/bubble
    var el = $(this).children('span:first-child');
    //console.log('mujo3');

    // add the bubble class (we do this so it doesnt show on page load)
    el.addClass('inc');
    //              /console.log('mujo4');

    // clone it
    var newone = el.clone(true);
    //                console.log('mujo5');
    // add the cloned version before our original
    el.before(newone);
    //                console.log('mujo6');
    // remove the original so that it is ready to run on next click
    $("." + el.attr("class") + ":last", the).remove();
    //              console.log('mujo7');
    //}); 
}

function returnDomains(input_val) {

    var output = "";
    setTimeout(function() {
        / Define a empty variables for loops /
        var s = 0,
            m = 0,
            r = 0,
            i = 0;
        var freeDomains = [],
            data = [],
            elements = [];
        var paidDomains = "",
            price = "",
            status = "",
            checkbox = "";

        var domainsProviders = ['com', 'net', 'org', 'info', 'eu', 'nl', 'co.uk']; // only paid domain provides
        input_val = input_val.val().split(".");

        if (input_val[1]) {
            // get only paid domain providers , and add provider from input
            if (!domainsProviders.includes(input_val[1])) {
                domainsProviders.push(input_val[1]);
            }
            input_val[0] = input_val[0];
        }
        var ReturnDomainValue = ajaxCall(input_val[0], domainsProviders);
        while (ReturnDomainValue[m]) { // loop domains and show them
            var urll = ReturnDomainValue[m].domain;
            var currency = ReturnDomainValue[m].currency;

            if (ReturnDomainValue[m].available == true) {
                price = (Math.round(ReturnDomainValue[m].price / 10000 * 1.3 * 1.2) / 100).toFixed(2);
                status = "<span class='badge' style='background: forestgreen;'>" + $transavailable + "</span>";
                checkbox = "<input class='md-check' onchange='selectDomain(this)' type='checkbox' id=\"" + urll + "\" value=\"" + [currency, price, urll] + "\" />";
            } else {
                price = '0.00';
                status = '<span class="badge label-danger">' + $transunav + '</span>';
                checkbox = "";
            }
            output += '<tr>';
            output += "<td class='domain'>" + ReturnDomainValue[m].domain + "</td>";
            output += '<td>' + $usercurrency + " " + price + '</td>';
            output += "<td>" + status + "</td>";
            output += "<td align='right' class='action_buttons_'>";
            output += '<div class="md-checkbox-inline"><div class="md-checkbox">';
            output += checkbox;
            output += '<label for="' + urll + '"><span></span><span class="check"></span><span class="box"></span></label></div></div>';
            output += '</td>';
            output += '</tr>';
            m++;
        }

        $('.table tbody').html(output);
        setTimeout(function() {
            $('.loading_domain').hide(200);
        }, 500);
    }, 100);

}


// Freenom response is complicated , so functionality is little bit longer.
// Search domains function which resolve all important functions.
function searchDomainValidation() {
    console.log('in validation call');
    $('.loading_domain').show(100);
    var input_val = $('.search_domains_input');
    if (/^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9]$/.test(input_val.val())) {
        returnDomains(input_val);
    } else if (/^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9](?:\.[a-zA-Z]{2,})+$/.test(input_val.val())) {
        returnDomains(input_val);
    } else {
        $('.loadinsg_domain').hide();
        input_val.css('border', '1px solid red');
        setTimeout(function() {
            input_val.css('border', '1px solid #c2cad8');
        }, 4500);
        //return false;
    }

}



$('.search_domains_button').on('click', searchDomainValidation);


// Regions
var ocean =
    "<option value='ams2'>Amsterdam 2</option>" +
    "<option value='ams3'>Amsterdam 3</option>" +
    "<option value='blr1'>Bangalore</option>" +
    "<option value='lon1'>London</option>" +
    "<option value='fra1'>Frankfurt</option>" +
    "<option value='nyc1'>New York 1</option>" +
    "<option value='nyc2'>New York 2</option>" +
    "<option value='nyc3'>New York 3</option>" +
    "<option value='sfo1'>San Francisco 1</option>" +
    "<option value='sfo2'>San Francisco 2</option>" +
    "<option value='sgp1'>Singapore</option>" +
    "<option value='tor1'>Toronto</option>";

var linode =
    '<option value="4">Atlanta</option>' +
    '<option value="2">Dallas</option>' +
    '<option value="1">Frankfurt</option>' +
    '<option value="3">Fremont</option>' +
    '<option value="7">London</option>' +
    '<option value="6">Newark</option>' +
    '<option value="9">Singapore</option>' +
    '<option value="11">Tokyo</option>';
$('.select_support').click(function(){
    var inputValue = $(this).val();
   
    $('.slectSize').val(inputValue).trigger('change');
    setRegion(inputValue);
    $("html, body").animate({ scrollTop: $(document).height() }, "slow");
    return false;
});

$('.slectSize').on('change', function() {
    var inputValue = $(this).val();
    setRegion(inputValue);
});

function setRegion(brend) {
    var brand = brend.split('-');
    if (brand[1] == 26) {
        $('.selectRegion').html(linode);
    } else {
        $('.selectRegion').html(ocean);
    }
}


$('.setup_button').click(function() {
    var id = $(this).data('id');
    $.ajax({
        type: "GET",
        url: '/tests/createSite/' + id,
        success: function(response) {
            location.reload();
        },
        ajaxError: function(response) {
            console.log(response);
        },
        error: function(response) {
            console.log(response);
        }
    });

});

$('.button_server_refresh').click(function() {
    var id = $(this).data('id');
    $.ajax({
        type: "POST",
        url: '/manage/server',
        data: {
            '_token': $(this).find('input').val(),
            'id': id
        },
        success: function(response) {
            console.log(response);
        },
        ajaxError: function() {

        },
        error: function() {

        }
    });
});

// Format date
function formatDate(date) {
    var monthNames = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];
    var day = date.getDate();
    var monthIndex = date.getMonth();
    var year = date.getFullYear();

    return day + '-' + monthNames[monthIndex] + '-' + year;
}

function addMessage(data) {
    if ($(".hosting-server-design tbody #" + data.message.id).length > 0) {
        $(".hosting-server-design tbody #" + data.message.id).html("<td><span>" + data.message.server_name + "</span></td>" +
            "<td><span>" + data.message.appsforce_friendly_name + "</span></td>" +
            "<td><span>" + formatDate(new Date(data.message.expiry_date)) + "</span></td>" +
            "<td><span>" + data.message.server_status + "</span></td>" +
            "<td class='usersAction'>" + (data.message.appsforce_friendly_name == 'Not installed' ?
                "<button data-id='" + data.message.id + "' class='btn btn-sm primary button_server_refresh'>Install AppsForce</button>" : "") +
            "<a href='../../manage/server' class='btn btn-sm primary'>Manage</a>" +
            "<button data-id='" + data.message.id + "' class='btn btn-sm primary button_server_refresh'>Test Status</buttons>");

        $('#' + data).find('application_status').html('Application running');
        $('#' + data).find('usersAction').html(
            '<div class="actions"><a class="btn btn-sm default" data-toggle="modal" href="#adddept{{$x}}">URN</a>' +
            '</div><div id="adddept{{$x}}" class="modal fade" tabindex="-1" aria-hidden="true"><div class="modal-dialog">' +
            '<div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>' +
            '<h4 class="modal-title">AppsForce Unique Reference Number</h4></div><div class="modal-body"><div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">' +
            '<div class="row"><div class="col-md-12"><h4>URN</h4><p>{{ urn}}</p></div></div></div></div><div class="modal-footer">' +
            '<button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button></div></div></div></div>');
    } else {
        servers_table_html = $(".hosting-server-design tbody").html();
        $(".hosting-server-design tbody").html(servers_table_html + "<tr id='" + data.message.id + "'> <td><span>" + data.message.server_name + "</span></td>" +
            "<td><span>" + data.message.appsforce_friendly_name + "</span></td>" +
            "<td><span>" + formatDate(new Date(data.message.expiry_date)) + "</span></td>" +
            "<td><span>" + data.message.server_status + "</span></td>" +
            "<td class='usersAction'>" + (data.message.appsforce_friendly_name == 'Not installed' ?
                "<button data-id='" + data.message.id + "' class='btn btn-sm primary button_server_refresh'>Install AppsForce</button>" : "") +
            "<a href='../../manage/server' class='btn btn-sm primary'>Manage</a>" +
            "<button data-id='" + data.message.id + "' class='btn btn-sm primary button_server_refresh'>Test Status</buttons>");
    }
}

// function testNOtifi(data){
//     console.log(data);
// }