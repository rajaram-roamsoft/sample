<html>
<head>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>
<body>
Search Restaurant : <input type="text" id="search" onkeyup="return searchRestaurant();">
<span id="searchResult"></span>
<script>
    function searchRestaurant() {
        var searchKey = $.trim($('#search').val());
        $.ajax({
            url: 'https://developers.zomato.com/api/v2.1/search?q='+searchKey,
            headers: {
                'user-key' : '07182880aad4543ddafb9df27ebcf8a5'
            },
            method: 'GET',
            success: function(response){
                if (response.restaurants !== '') {
                    html = '';
                    var i = (response.restaurants).length;
                    $.each (response.restaurants, function (key, value) {
                        html += '<br><a href="restaurants.php?id='+value.restaurant.id+'">'+value.restaurant.name+'' +
                            '[<label>'+value.restaurant.location.address+'</label>]' +
                            '</a>';
                        i--;
                    });
                    if (i === 0)
                        $('#searchResult').html(html);
                    return false;
                }
            }
        });
    }
</script>
</body>
</html>
