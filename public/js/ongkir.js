function getOngkir() {
    let subdistrict_id = $('#subdistrict').val();
    let berat = $('#berat').val();
    let courier = $('#select_ekspedisi').val();
    $('.courier_option').remove();
    $.get(APP_URL + 'order/ongkir?select=cost&param=' + subdistrict_id + '&berat=' + berat + '&courier=jne').done(function (data) {
        // console.log(data);
        data = JSON.parse(data);
        data = data.rajaongkir.results;
        let courier;
        let costs;
        for (let i = 0; i < data.length; i++) {
            courier = data[i];
            for (let x = 0; x < courier.costs.length; x++) {
                costs = courier.costs[x];
                $('#select_service').append('<option class="courier_option" value="' + costs.service + '_' + costs.cost[0].value + '">'
                    + costs.service + ' ' + thousand(costs.cost[0].value) + '</option>')
            }
        }
    });
}
$('#select_service').on('change', function () {
    let val = this.value,
    harga = val.split("_");
    let grand_total = parseInt($('#subtotal_input').val()) + 20000;
    $("#harga_ongkir").text('Rp. ' + 20000);
    $("#grandtotal").text('Rp. ' + thousand(grand_total));
});