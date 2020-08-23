const shorten_btn = '#shorten-btn';
const link_field = '#link-field';
const user_links_table = '#user-links-table';

// https://stackoverflow.com/questions/5717093/check-if-a-javascript-string-is-a-url
function validURL(str) {
  var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
    '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
    '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
    '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
    '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
    '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
  return !!pattern.test(str);
}

$(document).on('click', shorten_btn, function() {
    let method = 'POST';
    let url = 'shorten';
    let main_url = baseUrl + '/' + url;
    let link_data = $(link_field).val();
    if(validURL(link_data)) {
        data = {
            'link-url': link_data
        };
        
        $(shorten_btn).prop('disabled', true);

        eventsMethod(method, main_url, data);
    } else {
        alertError("Link Provided is not valid! Please enter a valid Link");
    }
});

let eventsMethod = (method, url, data) => {
    axios({ method, url, data })
    .then(function (result) {
        if(result.data.status == 'success') {
            alertSuccess(result.data.message);
            resetForm();
            loadLinkList();
        } else{
            alertError(result.data.message);
        }
    })
    .catch(function (error) {
      alertError(error.response.data.status.message);
    })
    .then(function () {
      // always executed
    });
}

let resetForm = () => {
    $(link_field).val("");
    $(shorten_btn).prop('disabled', false);
}

let loadLinkList = () => {
    let method = 'GET';
    let url = 'get-user-links';
    let main_url = baseUrl + '/' + url;
        
    axios({ method, url })
    .then(function (result) {
        if(result.data.status == 'success') {
            $(user_links_table + '>tbody').html(result.data.data.links);
        } else{
            alertError(result.data.message);
        }
    })
    .catch(function (error) {
      alertError(error.response.data.status.message);
    })
    .then(function () {
      // always executed
    });
}

$(document).ready(function() {
    loadLinkList();
})