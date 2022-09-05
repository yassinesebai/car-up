$(document).ready(function () { 

    // $('.bookButton').click(function () { 
    //     var id = $(this).attr('id');
    //     var action = 'data';
    //     $.ajax({
    //         url: 'checkout.php',
    //         type: 'POST',
    //         data: {action:action,id: id},
    //         success:function(result){
    //             alert(id);
    //         }
    //     })
    //  })

    function filter() { 
        var action = 'data';
        var brand = get_filter('brand');
        var fuel = get_filter('fuel');
        var gearbox = get_filter('gearbox');
        var price = get_filter('price');
        var search = get_filter('search');
        var order = $('#order').val();

        $.ajax({
            url: 'filter.php',
            method: 'POST',
            data:{action:action,brand:brand,fuel:fuel,gearbox:gearbox,price:price,search:search,order:order},
            success:function(result){
                $('#result').html(result);
            }
        })
     }
    // FILTERING CARS 
    $('.item').click(function() {
        filter();
    })

    $('#order').change(function () { 
        filter();
    })

    function get_filter(filter_class) {
        var checked_values = [];
        if (filter_class == 'price') {
            checked_values.push($('#min').val());
            checked_values.push($('#max').val());
        } else if (filter_class == 'search') {
            checked_values.push($('#search').val());
        } 
        else {
            $('.'+filter_class+':checked').each(function() {
                checked_values.push($(this).val());
            })
        }
        return checked_values;
    }



    // $('.go').click(function() {
    //     var keyword = $('#search').val();

    //     $.ajax({
            
    //     })
    // })
 })