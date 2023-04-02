$(document).ready(function () {
    $news_ids = [];
    $('.itm__index').on('click', function () {
        $news_ids.push(this.value);
    });
    $('#approve_news').on('click', function () {
        let url = $(this).data('url');
        $('.loading-spinner').show();
        $.post(url, {
            ids: $news_ids
        }, function (response) {

            $('.loading-spinner').hide();
            if (response.success == 'true') {
                window.location.reload();
                return;
            }
            alert('Error updating!');
        });

    });
    $('#classify_news').on('click', function () {
        let url = $(this).data('url');
        $('.loading-spinner').show();
        $.post(url, {
            ids: $news_ids
        }, function (response) {
            $('.loading-spinner').hide();
            if (response.success == 'true') {
                window.location.reload();
                return;
            }

            alert('Error updating!');
        });

    });

    $(document).on('change','#chartType',function(){
        const val = $(this).val();
        if(val == 0){
            console.log('chart');
            $('.chart-selector').removeClass('hidden');
            $('.image-selector').addClass('hidden');
        }else if(val== 1){
            $('.chart-selector').addClass('hidden');
            $('.image-selector').removeClass('hidden');
        }else{
            $(".chart-selector").addClass("hidden");
            $(".image-selector").addClass("hidden");
        }
    });
    $('#chartType').trigger('change');

});
