$('#loginbtn').click(function () {
    alert();
    var loginUser = $('#logintxt').val();
    var passwordUser = $('#pastxt').val();
    alert(loginUser);

    $.ajax({
        url: 'http://www.corsproxy.com/ec2-54-229-159-242.eu-west-1.compute.amazonaws.com/checkusers.php',
        data: {log:loginUser, pas:passwordUser},
        success: function(data) { $('#testText').text(data.text);},
        error: function() { alert("Error"); },
        dataType: "jsonp",
        //type:"get"
    });
});