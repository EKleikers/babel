function showServer() {
    if ($("input:radio[name='need_hosting']:checked").val() == 1) {
        $('.hosting_section').show();
        $('.a').hide();
    } else {
        $('.hosting_section').hide();
        $('.a').show();
    }
}

function showDomain() {
    if ($("input:radio[name='has_domain']:checked").val() == 1) {
        $('.domain_check').show();
        $('.app_url').hide();
        if ($('.domain_offer_section').is('visible')) {
            $('.domain_offer_section').show();
        }
    } else {
        $('.domain_check').hide();
        $('.app_url').show();
        $('.domain_price').val("");
        $('.domain_offer_section').hide();
    }
}

function disableSubmit(b_parameter) {
    $('.tt-submit').prop('disabled', b_parameter);
}

function showSubmit(b_parameter) {
    $('.tt-submit').css('display', b_parameter);
}
//disableSubmit(true);
showSubmit('none');

$('#appurl').click(function() {
    showUrlSection();
});
$('input:radio[name="need_hosting"]').change(function() {
    showServer();
    showSubmit('block');
});
$('input:radio[name="has_domain"]').change(function() {
    showDomain();
});

showDomain();
showServer();
$('.app_url').hide();


function myFunction() { document.getElementById("myDropdown").classList.toggle("show"); }

function filterFunction() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    div = document.getElementById("myDropdown");
    a = div.getElementsByTagName("a");
    for (i = 0; i < a.length; i++) {
        if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
            a[i].style.display = "";
        } else {
            a[i].style.display = "none";
        }
    }
}

var ocean = "<option value='ams2'>Amsterdam 2</option>" +
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

var aws = '<option value="us-west-1">California</option>' +
    '<option value="eu-west-1">Ireland</option>' +
    '<option value="eu-central-1">Frankfurt</option>' +
    '<option value="ap-south-1">Mumbai</option>' +
    '<option value="us-west-2">Oregon</option>' +
    '<option value="sa-east-1">Sao Paulo</option>' +
    '<option value="ap-northeast-2">Seoul</option>' +
    '<option value="ap-southeast-1">Singapore</option>' +
    '<option value="ap-south-1">Mumbai</option>' +
    '<option value="ap-southeast-2">Sydney</option>' +
    '<option value="ap-northeast-1">Tokyo</option>' +
    '<option value="us-east-1">Virginia</option>';

var linode = '<option value="4">Atlanta</option>' +
    '<option value="2">Dallas</option>' +
    '<option value="1">Frankfurt</option>' +
    '<option value="3">Fremont</option>' +
    '<option value="7">London</option>' +
    '<option value="6">Newark</option>' +
    '<option value="9">Singapore</option>' +
    '<option value="11">Tokyo</option>';

var rackspace = '<option value="ORD">Chicago</option>' +
    '<option value="DFW">Dallas</option>' +
    '<option value="HKG">Hong Kong</option>' +
    '<option value="LON">London</option>' +
    '<option value="IAD">Virginia</option>' +
    '<option value="SYD">Sydney</option>';

var ocean_size = '<option value="512MB">512MB RAM - 1 CPU Core - 20GB SSD</option>' +
    '<option value="1GB">1GB RAM - 1 CPU Core - 30GB SSD</option>' +
    '<option value="2GB">2GB RAM - 2 CPU Cores - 40GB SSD</option>' +
    '<option value="4GB">4GB RAM - 2 CPU Cores - 60GB SSD</option>' +
    '<option value="8GB">8GB RAM - 4 CPU Cores - 80GB SSD</option>' +
    '<option value="16GB">16GB RAM - 8 CPU Cores - 160GB SSD</option>' +
    '<option value="m-16GB">16GB RAM (High Memory) - 2 CPU Cores - 30GB SSD</option>' +
    '<option value="32GB">32GB RAM - 12 CPU Cores - 320GB SSD</option>' +
    '<option value="m-32GB">32GB RAM (High Memory) - 4 CPU Cores - 90GB SSD</option>' +
    '<option value="64GB">64GB RAM - 20 CPU Cores - 640GB SSD</option>' +
    '<option value="m-64GB">64GB RAM (High Memory) - 8 CPU Cores - 200GB SSD</option>' +
    '<option value="c-2VCPU">3GB RAM - 2 Dedicated vCPU - 20GB SSD - $0.06 / Hour - $40 / Month</option>' +
    '<option value="c-4VCPU">6GB RAM - 4 Dedicated vCPU - 20GB SSD - $0.119 / Hour - $80 / Month</option>' +
    '<option value="c-8VCPU">12GB RAM - 8 Dedicated vCPU - 20GB SSD - $0.238 / Hour - $160 / Month</option>' +
    '<option value="c-16VCPU">24GB RAM - 16 Dedicated vCPU - 20GB SSD - $0.476 / Hour - $320 / Month</option>' +
    '<option value="c-32VCPU">48GB RAM - 32 Dedicated vCPU - 20GB SSD - $0.952 / Hour - $640 / Month</option>';

var aws_size = '<option value="512MB">0.5 GiB RAM - 1 vCPU</option>' +
    '<option value="1GB">1 GiB RAM - 1 vCPU</option>' +
    '<option value="2GB">2 GiB RAM - 1 vCPU</option>' +
    '<option value="4GB">4 GiB RAM - 2 vCPUs</option>' +
    '<option value="8GB">8 GiB RAM - 2 vCPUs</option>' +
    '<option value="16GB">16 GiB RAM - 4 vCPUs</option>' +
    '<option value="32GB">32 GiB RAM - 8 vCPUs</option>' +
    '<option value="64GB">64 GiB RAM - 16 vCPUs</option>';

var linode_size = '<option value="1GB">1GB RAM - 1 CPU Cores - 20GB SSD</option>' +
    '<option value="2GB">2GB RAM - 1 CPU Cores - 30GB SSD</option>' +
    '<option value="4GB">4GB RAM - 2 CPU Cores - 48GB SSD</option>' +
    '<option value="8GB">8GB RAM - 4 CPU Cores - 96GB SSD</option>' +
    '<option value="12GB">12GB RAM - 6 CPU Cores - 192GB SSD</option>' +
    '<option value="24GB">24GB RAM - 8 CPU Cores - 384GB SSD</option>' +
    '<option value="48GB">48GB RAM - 12 CPU Cores - 768GB SSD</option>' +
    '<option value="64GB">64GB RAM - 16 CPU Cores - 1152GB SSD</option>' +
    '<option value="80GB">80GB RAM - 20 CPU Cores - 1536GB SSD</option>';

var empty_val = '<option value=" ">Please select Credentials first!</option>';

$('#region').html(linode);
$('#server_size').html(linode_size);

function frmValidate() {
    var val = $('.new_domain').val();
    if (/^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9](?:\.[a-zA-Z]{2,})+$/.test(val)) {
        return true;
    } else {
        $('.domain_check p').css('color', 'red');
        $('.domain_check p b').html(' *').fadeIn(1600);
        setTimeout(function() {
            $('.domain_check p').css('color', 'black');
            $('.domain_check p b').html(' ').fadeOut(1600);
        }, 4500);
        val.name.focus();
        return false;
    }
}
$('.new_domain').on('keyup', function() {
    $('.domains_response').html('');
});
$('.checkDomain').on('click', function() {
    var data = $('.new_domain').val();
    frmValidate();
    $.ajax({
        url: '/myOrders/checkdomain/' + data,
        method: 'GET',
        beforeSend: function() { $('.loading_domain').show(200); },
        success: function(data) {
            $('.loading_domain').hide(200);
            console.log(data.free.result, data.paid.result);
            var section = $('.domain_offer_section');
            var i = 0;
            var output = "";
            if (data.free.result == 'DOMAIN NOT AVAILABLE' && data.paid.result == 'DOMAIN NOT AVAILABLE') {
                $('.domains_response').html('<input type="hidden" name="domain_type" value="not_a"/>' +
                    '<h3>Domain not available</h3>');
                section.fadeIn(500);
                setTimeout(function() { section.fadeOut(500); }, 4500);

            } else if (data.free.result == 'DOMAIN AVAILABLE' && data.paid.result == 'DOMAIN NOT AVAILABLE') {
                $('.domains_response').html('<input type="hidden" name="domain_type" value="free"/>' +
                    '<h3>Domain free available</h3>');
                while (data.free.domain[i]) {
                    output += data.free.domain[i];
                    i++;
                }
                console.log(output);
                section.fadeIn(500);
                disableSubmit(false);

            } else if (data.free.result == 'DOMAIN NOT AVAILABLE' && data.paid.result == 'DOMAIN AVAILABLE') {
                $('.domains_response').html('<input type="hidden" name="domain_type" value="paid"/>' +
                    '<h3>Paid domain available</h3>');
                //$('.domain_offers').show();
                section.fadeIn(500);
                disableSubmit(false);
                console.log(data.paid);
            } else if (data.free.result == 'DOMAIN AVAILABLE' && data.paid.result == 'DOMAIN AVAILABLE') {
                $('.domains_response').html('<input type="hidden" name="domain_type" value="free"/>' +
                    '<h3>Domain free available</h3>');
                console.log(data.free);
                section.fadeIn(500);
                disableSubmit(false);
            }
        }
    });
});