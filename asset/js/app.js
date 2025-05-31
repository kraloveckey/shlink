function copyText() {
    var input = document.getElementById("shorturl");
    input.select(); // Selected text
    document.execCommand("copy"); // Execute the browser copy command

    input.setSelectionRange(0, 0); // Deselects the text by setting selection to start of input
    input.blur(); // Optionally, remove focus from the input field
}

var APP = (function(){

    var fn = {

        // Generate short URL
        setUrl: function(self) {
            var urlEl = document.getElementById('url'),
                tips = 'https://',
                request = {"url": urlEl.value};

            // Basic client-side validation
            if (urlEl.value.trim() === "") {
                showNotification('warning', 'Please enter a URL to shorten ⚠️', 'Fill the first field and click ➡️ Submit.');
                urlEl.value = ''; // Clear the input
                urlEl.setAttribute('placeholder', tips); // Reset placeholder
                return; // Stop execution
            }

            fn.getJson('api/set.php', true, JSON.stringify(request), function(res) {
                if(res && res.success == 'true') {
                    $res = document.getElementById('shorturl')
                    $res.className = 'focus';
                    $res.value = res.content.url;
                    showNotification('success', 'Link successfully shortened 🥷', 'You can copy it now 💾'); // Success notification
                } else if (res && res.content) {
                    urlEl.className = '';
                    urlEl.value = '';
                    urlEl.setAttribute('placeholder', res.content);
                    showNotification('error', res.content); // Error notification from server
                    setTimeout(function() {
                        urlEl.setAttribute('placeholder', tips);
                    }, 2000);
                } else {
                    // Generic error if no specific content is returned or JSON parsing fails
                    showNotification('error', 'An unknown error occurred ⚠️', 'Please try again 🔄');
                    urlEl.className = '';
                    urlEl.value = '';
                    urlEl.setAttribute('placeholder', tips); // Reset placeholder
                }
            });
        },
        // Getting JSON data
        getJson: function(url, post, data, callback) {
            var xhr = new XMLHttpRequest(),
                type = (post) ? 'POST' : 'GET';
            xhr.onreadystatechange = function() {
                if(xhr.readyState == 4 && xhr.status == 200) {
                    try {
                        var json = JSON.parse(xhr.responseText);
                        callback(json);
                    } catch (e) {
                        console.error("Error parsing JSON response:", e);
                        callback(false); // Indicate failure due to parsing error
                    }
                } else if(xhr.readyState == 4) {
                    console.error("XHR failed with status:", xhr.status);
                    callback(false); // Indicate failure
                }
            }
            xhr.open(type, url, true);
            // Set Content-Type header for POST requests with JSON data
            if (post && data) {
                xhr.setRequestHeader('Content-Type', 'application/json');
            }
            xhr.send(data);
        }
    },
    init = function() {
        setTimeout(function() {
            var el = document.getElementsByTagName('html')[0];
            el.className = 'on';
        }, 10);
    };
    return {fn: fn, init: init}
})();

document.addEventListener('DOMContentLoaded', function() {APP.init();})
