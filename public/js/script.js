function getEthPrice() {
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: 'https://api.coinmarketcap.com/v1/ticker/ethereum/?convert=BRL',
        success: function (data) {
            ethValueUSD = data[0].price_usd;
            ethValueBr = data[0].price_brl;
            var ganhoDiaUsd = resulGanho * parseFloat(ethValueUSD);
            $('#ganho_Dia_usd').text(ganhoDiaUsd.toFixed(2));
            var ganhosemanaUsd = resulGanho * 7 * parseFloat(ethValueUSD);
            $('#semana_ganho_usd').text(ganhosemanaUsd.toFixed(2));
            var ganhoMesUsd = resulGanho * 30 * parseFloat(ethValueUSD);
            $('#mes_ganho_usd').text(ganhoMesUsd.toFixed(2));
            var ganhoAnoUsd = resulGanho * 365 * parseFloat(ethValueUSD);
            $('#ano_ganho_usd').text(ganhoAnoUsd.toFixed(2));
            var ganhoAnoUsd = resulGanho * 730 * parseFloat(ethValueUSD);
            $('#twoYear_ganho_usd').text(ganhoAnoUsd.toFixed(2));
            /*BR*/
            var ganhoDiaBr = resulGanho * parseFloat(ethValueBr);
            $('#ganho_Dia_br').text('R$: ' + ganhoDiaBr.toFixed(2));
            var ganhoSemanaBr = resulGanho * 7 * parseFloat(ethValueBr);
            $('#semana_ganho_br').text('R$: ' + ganhoSemanaBr.toFixed(2));
            var ganhoMesBr = resulGanho * 30 * parseFloat(ethValueBr);
            $('#mes_ganho_br').text('R$: ' + ganhoMesBr.toFixed(2));
            var ganhoAnoBr = resulGanho * 365 * parseFloat(ethValueBr);
            $('#ano_ganho_br').text('R$: ' + ganhoAnoBr.toFixed(2));
            var ganhoTwoBr = resulGanho * 730 * parseFloat(ethValueBr);
            $('#twoYear_ganho_br').text('R$: ' + ganhoTwoBr.toFixed(2));

        }
    });
}

function getZcashPrice() {
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: 'https://api.coinmarketcap.com/v1/ticker/zcash/?convert=BRL',
        success: function (data) {
            zcashValueUSD = data[0].price_usd;
            zcashValueBr = data[0].price_brl;
            var ganhoDiaUsd = resulGanho * parseFloat(zcashValueUSD);
            $('#ganho_Dia_usd').text(ganhoDiaUsd.toFixed(2));
            var ganhosemanaUsd = resulGanho * 7 * parseFloat(zcashValueUSD);
            $('#semana_ganho_usd').text(ganhosemanaUsd.toFixed(2));
            var ganhoMesUsd = resulGanho * 30 * parseFloat(zcashValueUSD);
            $('#mes_ganho_usd').text(ganhoMesUsd.toFixed(2));
            var ganhoAnoUsd = resulGanho * 365 * parseFloat(zcashValueUSD);
            $('#ano_ganho_usd').text(ganhoAnoUsd.toFixed(2));
            var ganhoAnoUsd = resulGanho * 730 * parseFloat(zcashValueUSD);
            $('#twoYear_ganho_usd').text(ganhoAnoUsd.toFixed(2));
            /*BR*/
            var ganhoDiaBr = resulGanho * parseFloat(zcashValueBr);
            $('#ganho_Dia_br').text('R$: ' + ganhoDiaBr.toFixed(2));
            var ganhoSemanaBr = resulGanho * 7 * parseFloat(zcashValueBr);
            $('#semana_ganho_br').text('R$: ' + ganhoSemanaBr.toFixed(2));
            var ganhoMesBr = resulGanho * 30 * parseFloat(zcashValueBr);
            $('#mes_ganho_br').text('R$: ' + ganhoMesBr.toFixed(2));
            var ganhoAnoBr = resulGanho * 365 * parseFloat(zcashValueBr);
            $('#ano_ganho_br').text('R$: ' + ganhoAnoBr.toFixed(2));
            var ganhoTwoBr = resulGanho * 730 * parseFloat(zcashValueBr);
            $('#twoYear_ganho_br').text('R$: ' + ganhoTwoBr.toFixed(2));

        }
    });
}