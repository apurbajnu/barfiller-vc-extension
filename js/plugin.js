(function ($) {
    $(document).ready(function(){

        var barfill = $(".barfill-container");
        if(barfill.length>0){
            barfill.each(function(){
                options = $(this).data('options');
                console.log(options);

                $(this).barfiller(options);
            })
        }

    });
})(jQuery)

