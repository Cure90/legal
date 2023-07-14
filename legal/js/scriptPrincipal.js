let flag = false;
        $(document).ready(function() {
            $(".btn-menu").click(function(e){
                e.preventDefault();
                width = $(window).width();
                console.log(width);
                if(width <= 600){
                    flag = false;
                    $("#menu-mobil-background").css("display","none");
                    $("#menu-mobil").css("display","none");
                    $("#close").html("&#8212 &#8212 &#8212");
                }
                $(location).prop("href", $(this).attr('href'));
            });
            $(".mobil-hamburguer").click(function(e){
                e.preventDefault();
                if (!flag) {
                    $("#menu-mobil-background").css("display","block");
                    $("#menu-mobil").css("display","block");
                    $("#close").html("&nbsp&nbspX");
                    flag = true;
                }else{
                    $("#menu-mobil-background").css("display","none");
                    $("#menu-mobil").css("display","none");
                    $("#close").html("&#8212 &#8212 &#8212");
                    flag = false;
                }
            });

            $("#btn-ubicación").click(function(e){
                e.preventDefault();
                $(".header").css("display","none");
                $("#inicio").css("display","none");
                $("#practica").css("display","none");
                $("#vision").css("display","none");
                // $(".section-abogados").css("display","none");
                $("#contacto").css("display","none");
                $(".arriba").css("display","none");
                $(".ubicacion").css("display","block");
                
            });
            $("#close-map").click(function(e){
                e.preventDefault();
                if(width <= 600)
                    $(".header").css("display","contents");
                else
                    $(".header").css("display","block");
                $("#inicio").css("display","block");
                $("#practica").css("display","block");
                $("#vision").css("display","block");
                // $(".section-abogados").css("display","block");
                $("#contacto").css("display","block");
                $(".arriba").css("display","block");
                $(".ubicacion").css("display","none");
                
            });
        });