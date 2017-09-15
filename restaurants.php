<?php
$restaurantId = $_GET['id'];
?>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>
<body>
<div id="data"></div>
<script>
    var scrap = require('scrap');
    $(document).ready(function () {
        var restaurantId = <?= $restaurantId?>;
        alert(restaurantId);
        if (restaurantId !== '') {
            $.ajax({
                url: 'https://developers.zomato.com/api/v2.1/restaurant?res_id='+restaurantId,
                headers: {
                    'user-key' : '07182880aad4543ddafb9df27ebcf8a5'
                },
                method: 'GET',
                success: function (response) {

                    if (response !== '') {
                        var html = '';
                        html += '<label>Name: '+response.name+'</label><br>';
                        html += '<label>Address: '+response.location.address+'</label><br>';
                        html += '<label>Cuisines: '+response.cuisines+'</label><br>';
                        html += '<label>Rating: '+response.user_rating.aggregate_rating+'</label><br>';
                        html += '<iframe src="'+response.photos_url+'"></iframe>'
                        $('#data').html(html);
                        $.ajax({
                            url: response.photos_url,
                            headers: {
                                'Access-Control-Allow-Origin': '*'
                            },
                            method: 'GET',
                            success: function (output) {

                            }
                        });
                        return false;
                    }
                }
            });
            return false;
        }
    });
</script>
</body>
</html>
