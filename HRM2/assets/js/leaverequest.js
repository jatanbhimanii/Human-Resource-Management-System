        $('.btn1').click(function() {
            $('.btn1').toggleClass("click");
            $('.sidebar').toggleClass("show");
        });
        $('.leave-btn').click(function() {
            $('nav ul .leave-show').toggleClass("show");
            $('nav ul .first').toggleClass("rotate");
        });
        $('.sal-btn').click(function() {
            $('nav ul .sal-show').toggleClass("show");
            $('nav ul .second').toggleClass("rotate");
        });