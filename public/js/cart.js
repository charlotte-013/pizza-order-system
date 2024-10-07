$(document).ready(function() {
    // for plus button
    $('.btn-plus').click(function() {
        $parentNode = $(this).parents('tr');
        $price = Number($parentNode.find('#price').text().replace('kyats', ''));
        $qty = Number($parentNode.find('#qty').val());

        $total = $price * $qty;
        $parentNode.find('#total').html(`${$total} kyats`);

        summaryCalculation();
    })

    // for minus button
    $('.btn-minus').click(function() {
        $parentNode = $(this).parents('tr');
        $price = Number($parentNode.find('#price').text().replace('kyats', ''));
        $qty = Number($parentNode.find('#qty').val());

        $total = $price * $qty;
        $parentNode.find('#total').html(`${$total} kyats`);

        summaryCalculation();
    })

    // for cart summary
    function summaryCalculation() {
        $totalPrice = 0;

        $('#dataTable tbody tr').each(function(index, row) {
            $totalPrice += Number($(row).find('#total').text().replace('kyats', ''));
        });

        $('#subTotalPrice').html(`${$totalPrice} kyats`);
        $('#finalPrice').html(`${$totalPrice + 2500} kyats`);
    }
})
