<script>
    function GetBlogs(id) {
        var tokenzzz = $('#token').val();
        $.ajax({
            url: "http://127.0.0.1:8000/api/blogs",
            type: 'GET',
            dataType: 'json',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': ' Bearer ' + tokenzzz,
            },
            success: function(response) {
                console.log(response);
                if (response.status == 'success') {
                    if (response.data != "") {
                        $('#table').show();
                        var result = response.data;
                        var html = "";
                        for (let i = 0; i < result.length; i++) {
                            html +="<tr><td>" + result[i].id + "</td><td>" + result[i].title +
                                "</td><td>" + result[i].content + "</td></tr>"
                        }
                        $('#show-record').html(html);
                    } else {
                        swal('No Data Found');
                    }


                } else if (response.status == 'error') {
                    $('#table').hide();
                    swal(response.message);

                }
            },
            error: function(xhr, status, error) {
                $('#table').hide();
                swal(xhr.statusText, xhr.responseJSON.message);
            }
        });


    }
</script>
