<html>

<head>

</head>

<body>
    <h1>KIT502 Tutorial 11</h1>


    <table>
        <tr>
            <td>
                <label for="">Country</label>
            </td>
            <td>
                <select id="country" name="" id="">
                    <option value="AU">Australia</option>
                    <option value="UK">United States</option>
                    <option value="US">United Kindom</option>
                </select>

            </td>
        </tr>
        <tr>
            <td>
                <label id="labelcities">Cities</label>

            </td>
            <td>
                <select id="cities" name="cities"> </select>
            </td>
        </tr>
        <tr>
            <td>
                <label id="labelpopu">Population</label>
            </td>
            <td>
                <label id="population" for=""></label>
            </td>
        </tr>
    </table>

    <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
    $(function() {
        $("#labelcities").hide();
        $("#cities").hide();
        $("#labelpopu").hide();
        $("#country").change(function() {
            $.get("check.php", {
                    country: this.value,
                })
                .done(function(data) {
                    $("#labelcities").show();
                    $("#cities").show();
                    $("#cities").html(data);
                });
        });
        $("#cities").change(function() {
            $.get("check.php", {
                    cities: this.value,
                })
                .done(function(data) {
                    $("#labelpopu").show();
                    $("#population").html(data);
                });
        });
    });
    </script>

</body>

</html>