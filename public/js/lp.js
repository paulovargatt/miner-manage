var urlEthMiner = '/json-miner';

function getEth(power) {
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: urlEthMiner,
        success: function (data) {
            var netHash = data.nethash;
            var dificult = data.difficulty;
            var dificult24 = data.difficulty24;
            netHash = (netHash / dificult) * dificult24;
            var hashPower = (power * 1e6) / netHash;
            var blockTime = data.block_time;
            var blockReward = data.block_reward24;
            var blocksPerMin = 60 / blockTime;
            var coinPermine = blocksPerMin * blockReward;
            var ganho = hashPower * coinPermine;
            var ganhoDia = ganho * 60 * 24;
            resulGanho = ganhoDia.toFixed(6);
            var  dia = ganhoDia ;
            $('#ganho_Dia').text(dia.toFixed(6));
            var  mesGanho = ganhoDia * 30;
            $('#mes_ganho').text(mesGanho.toFixed(6));
            var  anoGanho = ganhoDia * 365;
            $('#ano_ganho').text(anoGanho.toFixed(6));
            var  twoYear = ganhoDia * 730;
            $('#twoYear_ganho').text(twoYear.toFixed(6));
            getEthPriceBR(resulGanho)
        }
    });
}



function getEthCinco(power) {
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: urlEthMiner,
        success: function (data) {
            var netHash = data.nethash;
            var dificult = data.difficulty;
            var dificult24 = data.difficulty24;
            netHash = (netHash / dificult) * dificult24;
            var hashPower = (power * 1e6) / netHash;
            var blockTime = data.block_time;
            var blockReward = data.block_reward24;
            var blocksPerMin = 60 / blockTime;
            var coinPermine = blocksPerMin * blockReward;
            var ganho = hashPower * coinPermine;
            var ganhoDia = ganho * 60 * 24;
            resulGanho = ganhoDia.toFixed(6);
            var  dia = ganhoDia ;
            $('#ganho_DiaCinco').text(dia.toFixed(6));
            var  mesGanho = ganhoDia * 30;
            $('#mes_ganhoCinco').text(mesGanho.toFixed(6));
            var  anoGanho = ganhoDia * 365;
            $('#ano_ganhoCinco').text(anoGanho.toFixed(6));
            var  twoYear = ganhoDia * 730;
            $('#twoYear_ganhoCinco').text(twoYear.toFixed(6));
            getEthPriceBRCinco(resulGanho)
        }
    });
}

var urlCoinMarket = 'https://api.coinmarketcap.com/v1/ticker/ethereum/?convert=BRL';

function getEthPriceBR(resulGanho) {
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: urlCoinMarket,
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
            $('#twoYear_ganho_br_span').text('R$: ' + ganhoTwoBr.toFixed(2));

        }
    });
}

function getEthPriceBRCinco(resulGanho) {
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: urlCoinMarket,
        success: function (data) {
            ethValueUSD = data[0].price_usd;
            ethValueBr = data[0].price_brl;
            var ganhoDiaUsd = resulGanho * parseFloat(ethValueUSD);
            $('#ganho_Dia_usdCinco').text(ganhoDiaUsd.toFixed(2));
            var ganhosemanaUsd = resulGanho * 7 * parseFloat(ethValueUSD);
            $('#semana_ganho_usdCinco').text(ganhosemanaUsd.toFixed(2));
            var ganhoMesUsd = resulGanho * 30 * parseFloat(ethValueUSD);
            $('#mes_ganho_usdCinco').text(ganhoMesUsd.toFixed(2));
            var ganhoAnoUsd = resulGanho * 365 * parseFloat(ethValueUSD);
            $('#ano_ganho_usdCinco').text(ganhoAnoUsd.toFixed(2));
            var ganhoAnoUsd = resulGanho * 730 * parseFloat(ethValueUSD);
            $('#twoYear_ganho_usdCinco').text(ganhoAnoUsd.toFixed(2));
            /*BR*/
            var ganhoDiaBr = resulGanho * parseFloat(ethValueBr);
            $('#ganho_Dia_brCinco').text('R$: ' + ganhoDiaBr.toFixed(2));
            var ganhoSemanaBr = resulGanho * 7 * parseFloat(ethValueBr);
            $('#semana_ganho_brCinco').text('R$: ' + ganhoSemanaBr.toFixed(2));
            var ganhoMesBr = resulGanho * 30 * parseFloat(ethValueBr);
            $('#mes_ganho_brCinco').text('R$: ' + ganhoMesBr.toFixed(2));
            var ganhoAnoBr = resulGanho * 365 * parseFloat(ethValueBr);
            $('#ano_ganho_brCinco').text('R$: ' + ganhoAnoBr.toFixed(2));
            var ganhoTwoBr = resulGanho * 730 * parseFloat(ethValueBr);
            $('#twoYear_ganho_brCinco').text('R$: ' + ganhoTwoBr.toFixed(2));

        }
    });
}
