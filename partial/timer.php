<script>
    window.setInterval(function(){
        $(".timer").each(function(){
            $endTime = new Date($(this).data('auctionend'));
            //some have a diffrent timezone, thus lasting 1 hour longer/shorter
            $currentTime = new Date($.now());
            $timeDiffrence = $endTime - $currentTime;

            if ($timeDiffrence <= 0) {
                $(this).text("Verlopen");
                $(this).removeClass( "timer" )
            }
            else {
                $sec = Math.floor($timeDiffrence / 1000);
                $min = Math.floor($sec / 60);
                $hour = Math.floor($min / 60);
                $days = Math.floor($hour / 24);

                $hour %= 24;
                $min %= 60;
                $sec %= 60;

                $hour = ("0" + $hour).slice(-2);
                $min = ("0" + $min).slice(-2);
                $sec = ("0" + $sec).slice(-2);

                if($days >= 2){
                    $(this).text($days + " dagen");
                }else {
                    $(this).text(($days * 24 + $hour).slice(-2) + ":" + $min + ":" + $sec);
                    if($days <= 0 && $hour <= 0 && $min < 2){
                        if(!$(this).hasClass("error-message")){
                            $(this).addClass("error-message");
                        }
                    }
                }
            }
        });
    }, 1000);
</script>