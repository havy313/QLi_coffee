(function ($) {
    "use strict";
    var mainApp = {

        main_fun: function () {
            /*====================================
            METIS MENU 
            ======================================*/
            $('#main-menu').metisMenu();

            /*====================================
              LOAD APPROPRIATE MENU BAR
           ======================================*/
            $(window).bind("load resize", function () {
                if ($(this).width() < 768) {
                    $('div.sidebar-collapse').addClass('collapse')
                } else {
                    $('div.sidebar-collapse').removeClass('collapse')
                }
            });
        // let buttons=document.quẻ
        
        },

        initialization: function () {
            mainApp.main_fun();

        }

    }
    // Initializing ///

    $(document).ready(function () {
        mainApp.main_fun();
    });

    // acti ve nav item

    // $(".nav-item").click(function() {
    //     console.log($(".nav-item").length())
    //     for(let i = 0; i < $(".nav-item").length(); i++){
    //         $(".nav-item").removeClass(".nav-item--active")
    //     }
    //     $(this).addClass(".nav-item--active")
    // });
   

}(jQuery));


